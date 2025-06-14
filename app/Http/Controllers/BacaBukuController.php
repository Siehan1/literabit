<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\History;
use App\Models\HasilKuis;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\models\misionAsignment;


class BacaBukuController extends Controller
{
    public function show($slug)
    {
        $buku = Buku::where('slug', $slug)->firstOrFail();
        $history = History::where('user_id', Auth::id())->where('buku_id', $buku->id)->first();
        $sudahKuis = HasilKuis::where('user_id', Auth::id())->where('buku_id', $buku->id)->exists();
        $sudahResume = Resume::where('user_id', Auth::id())->where('buku_id', $buku->id)->first();
        $lastPage = $history?->hal_terakhir ?? 1;

        return view('buku.bacaBuku', compact('buku', 'lastPage', 'sudahKuis', 'sudahResume'));
    }

    public function getPdf($slug)
    {
        $buku = Buku::where('slug', $slug)->firstOrFail();
        $path = storage_path("app/public/{$buku->pdf_path}");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function updateProgress(Request $request)
    {
        $data = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'halaman' => 'required|integer|min:1',
            'status' => 'nullable|in:reading,completed',
        ]);

        History::updateOrCreate(
            ['user_id' => Auth::id(), 'buku_id' => $data['buku_id']],
            ['hal_terakhir' => $data['halaman'], 'status' => $data['status'] ?? 'reading']
        );

        return response()->json(['message' => 'Progress saved']);
    }

    // Di controller atau service yang menangani penyelesaian buku


    public function completeBook(Request $request)
    {
        $user = Auth::user();

        // Cari misi membaca buku
        $readingMission = misionAsignment::where('user_id', $user->id)
            ->whereHas('dailyMission.template', function ($q) {
                $q->where('judul', 'LIKE', '%baca buku%');
            })
            ->first();

        if ($readingMission) {
            Log::info('Before Update:', [
                'mission' => $readingMission->toArray(),
                'target' => $readingMission->dailyMission->template->jumlah_target
            ]);

            $readingMission->increment('jumlah_selesai');

            Log::info('After Update:', $readingMission->fresh()->toArray());
        }
    }


    public function recordBookRead($userId, $bookId)
    {
        DB::beginTransaction();
        try {
            // Validasi input
            $userId = (int) $userId;
            $bookId = (int) $bookId;

            // Cek history baca buku
            $hasRead = History::where('user_id', $userId)
                ->where('buku_id', $bookId)
                ->exists();

            // Jika buku belum pernah dibaca, catat sebagai history baru
            if (!$hasRead) {
                History::create([
                    'user_id' => $userId,
                    'buku_id' => $bookId,
                    'status' => 'completed',
                    'completed_at' => now()
                ]);
            }

            // Dapatkan misi baca yang aktif
            // Trigger akan otomatis menangani is_done=0 untuk insert baru
            $assignments = misionAsignment::with('dailyMission.template')
                ->where('user_id', $userId)
                ->where('is_done', false)
                ->whereHas('dailyMission.template', fn($q) => $q->where('type', 'read'))
                ->get();

            $updatedMissions = [];
            $totalXpEarned = 0;

            foreach ($assignments as $assignment) {
                $target = $assignment->dailyMission->template->jumlah_target;

                // Hitung buku yang sudah dibaca untuk misi ini
                $booksRead = History::where('user_id', $userId)
                    ->where('status', 'completed')
                    ->where('created_at', '>=', $assignment->created_at)
                    ->distinct('buku_id')
                    ->count('buku_id');

                // Hitung progress
                $currentProgress = min($booksRead, $target);
                $isDone = $currentProgress >= $target;

                // Update jumlah selesai
                // Biarkan trigger AFTER_UPDATE yang menangani XP reward
                $assignment->jumlah_selesai = $currentProgress;

                // Hanya update is_done jika misi selesai
                // Trigger akan otomatis memberikan XP saat is_done berubah dari 0 ke 1
                if ($isDone) {
                    $assignment->is_done = true;
                }

                $assignment->save();

                // Dapatkan data terbaru setelah trigger dijalankan
                $assignment->refresh();

                $progressPercentage = $target > 0 ? min(100, ($assignment->jumlah_selesai / $target) * 100) : 0;

                $updatedMissions[] = [
                    'mission_id' => $assignment->id,
                    'title' => $assignment->dailyMission->template->judul,
                    'current_progress' => $assignment->jumlah_selesai,
                    'target' => $target,
                    'progress_percentage' => $progressPercentage,
                    'is_completed' => $assignment->is_done,
                    'reward_xp' => $assignment->dailyMission->template->xp_reward
                ];

                // XP reward sudah dihandle oleh trigger, cukup ambil dari user terbaru
                if ($assignment->is_done) {
                    $totalXpEarned += $assignment->dailyMission->template->xp_reward;
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => [
                    'has_read' => $hasRead,
                    'updated_missions' => $updatedMissions,
                    'total_xp_earned' => $totalXpEarned,
                    'current_xp' => User::find($userId)->xp // Ambil XP terbaru setelah trigger
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Gagal mencatat progress baca buku', [
                'user_id' => $userId,
                'book_id' => $bookId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan progress. Silakan coba lagi.'
            ], 500);
        }
    }

}

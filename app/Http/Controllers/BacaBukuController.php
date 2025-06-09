<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\History;
use App\Models\HasilKuis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\models\misionAsignment;


class BacaBukuController extends Controller
{
    public function show($slug)
    {
        $buku = Buku::where('slug', $slug)->firstOrFail();
        $history = History::where('user_id', Auth::id())->where('buku_id', $buku->id)->first();
        $sudahKuis = HasilKuis::where('user_id', Auth::id())->where('buku_id', $buku->id)->exists();
        $lastPage = $history?->hal_terakhir ?? 1;

        return view('buku.bacaBuku', compact('buku', 'lastPage', 'sudahKuis'));
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
        $user = auth()->user();

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
    try {
        // Validasi input
        $userId = (int)$userId;
        $bookId = (int)$bookId;
        
        // Cek apakah sudah ada history completed untuk buku ini
        $existingReading = History::where('user_id', $userId)
            ->where('buku_id', $bookId)
            ->where('status', 'completed')
            ->first();

        if ($existingReading) {
            return response()->json([
                'success' => false,
                'message' => 'Buku ini sudah tercatat sebagai selesai dibaca.'
            ], 409);
        }

        // Ambil progress terakhir atau buat baru
        $history = History::updateOrCreate(
            [
                'user_id' => $userId,
                'buku_id' => $bookId
            ],
            [
                'status' => 'completed',
                'hal_terakhir' => History::where('user_id', $userId)
                    ->where('buku_id', $bookId)
                    ->max('hal_terakhir') ?? 1
            ]
        );

        // Hitung buku yang sudah completed
        $booksRead = History::where('user_id', $userId)
            ->where('status', 'completed')
            ->distinct('buku_id')
            ->count('buku_id');

        // Update missions
        $updatedMissions = [];
        $assignments = misionAsignment::with('dailyMission.template')
            ->where('user_id', $userId)
            ->where('is_done', false)
            ->get();

        foreach ($assignments as $assignment) {
            if ($assignment->dailyMission?->template?->type === 'reading') {
                $target = $assignment->dailyMission->template->jumlah_target;
                $isDone = $booksRead >= $target;
                
                $assignment->update([
                    'jumlah_selesai' => $booksRead,
                    'is_done' => $isDone
                ]);

                $updatedMissions[] = [
                    'mission_id' => $assignment->id,
                    'progress' => min(100, ($booksRead / $target) * 100),
                    'is_completed' => $isDone
                ];
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'history' => $history,
                'books_read' => $booksRead,
                'updated_missions' => $updatedMissions
            ]
        ]);

    } catch (\Exception $e) {
        Log::error('Book read error', [
            'user' => $userId,
            'book' => $bookId,
            'error' => $e->getMessage()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'System error. Please try again.'
        ], 500);
    }
}


}

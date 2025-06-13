<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\misionDaily;
use App\Models\User;
use App\models\misionAsignment;
use App\Models\History;

class AsignmentMision extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user(); // Get authenticated user using Auth facade
        $today = now()->toDateString();

        // Dapatkan misi harian untuk tanggal hari ini
        $dailyMissions = misionDaily::whereDate('tanggal', $today)->get();

        // Buat assignment untuk setiap misi harian
        foreach ($dailyMissions as $daily) {
            misionAsignment::firstOrCreate([
                'user_id' => $user->id,
                'daily_id' => $daily->id,
            ], [
                'judul' => $daily->template->judul,
                'jumlah_selesai' => 0,
                'is_done' => false,
            ]);
        }

        // Dapatkan semua misi user dengan relasi
        $userMissions = misionAsignment::with([
            'dailyMission.template' // Gunakan nama relasi yang sudah ada (template)
        ])
            ->where('user_id', $user->id)
            ->whereHas('dailyMission', function ($q) use ($today) {
                $q->whereDate('tanggal', $today)
                    ->whereHas('template'); // Sesuai nama relasi di misionDaily
            })
            ->get();

        return view('beranda.beranda', [
            'userMissions' => $userMissions,
            'user' => $user
        ]);
    }

    public function assignToAllUsers()
    {
        $today = now()->toDateString();
        $dailyMissions = MisionDaily::whereDate('tanggal', $today)->get();
        $users = User::all();

        $assignmentCount = 0;

        foreach ($users as $user) {
            foreach ($dailyMissions as $mission) {
                $assignment = \App\Models\misionAsignment::firstOrCreate([
                    'user_id' => $user->id,
                    'daily_id' => $mission->id,
                ], [
                    'jumlah_selesai' => 0,
                    'is_done' => false,
                ]);

                if ($assignment->wasRecentlyCreated) {
                    $assignmentCount++;
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Assigned {$assignmentCount} new mission assignments to all users.",
            'assignments_created' => $assignmentCount,
            'total_users' => count($users),
            'missions_today' => count($dailyMissions),
        ]);
    }

public function create()
{
    $users = User::all();
    // Hanya ambil daily missions yang belum selesai
    $dailyMissions = MisionDaily::with('template')
        ->where('is_completed', false)
        ->get();
    
    return view('admin.mision.misionAsignment.storeAsignment', compact('users', 'dailyMissions'));
}

public function store(Request $request)
{
    $validate = $request->validate([
        'user_ids' => 'required|array',
        'user_ids.*' => 'exists:users,id',
        'daily_id' => [
            'required',
            'exists:daily_missions,id',
            // Tambahkan validasi untuk memastikan mission belum selesai
            function ($attribute, $value, $fail) {
                $mission = MisionDaily::find($value);
                if ($mission && $mission->is_completed) {
                    $fail('Mission yang sudah selesai tidak bisa dipilih.');
                }
            }
        ],
        'jumlah_selesai' => 'required|integer|min:0',
        'is_done' => 'required|boolean',
        'judul' => 'sometimes|string|max:255'
    ]);

    try {
        $dailyMission = MisionDaily::with('template')->find($validate['daily_id']);
        
        // Validasi tambahan di server side
        if ($dailyMission->is_completed) {
            return back()->withInput()
                ->with('error', 'Tidak bisa menambahkan assignment ke mission yang sudah selesai');
        }

        $createdAssignments = [];
        $existingAssignments = [];

        $judul = $validate['judul'] ?? $this->generateAssignmentTitle($dailyMission);

        foreach ($validate['user_ids'] as $userId) {
            $existing = misionAsignment::where('user_id', $userId)
                ->where('daily_id', $validate['daily_id'])
                ->first();

            if ($existing) {
                $existingAssignments[] = $existing;
                continue;
            }

            $assignment = misionAsignment::create([
                'user_id' => $userId,
                'daily_id' => $validate['daily_id'],
                'jumlah_selesai' => $validate['jumlah_selesai'],
                'is_done' => $validate['is_done'],
                'judul' => $judul
            ]);

            $createdAssignments[] = $assignment->load(['dailyMission.template', 'user']);
        }

        return redirect()->route('index.Asignment')
            ->with([
                'success' => 'Assignment berhasil dibuat',
                'created_assignments' => $createdAssignments,
                'existing_assignments' => $existingAssignments
            ]);
    } catch (\Exception $e) {
        dd($e->getMessage());
        return back()->withInput()
            ->with('error', 'Gagal membuat assignment: ' . $e->getMessage());
    }
}

    // Method untuk generate judul otomatis
    private function generateAssignmentTitle(MisionDaily $dailyMission): string
    {
        $templateJudul = $dailyMission->template->judul ?? 'Misi Harian';
        $tanggal = $dailyMission->tanggal?->format('d M Y') ?? now()->format('d M Y');

        return "Assignment {$templateJudul} - {$tanggal}";
    }

    // Menampilkan semua data mission assignment
    public function showAll()
    {
        $assignments = misionAsignment::with(['dailyMission.template', 'user'])->get();
        return view('admin.mision.misionAsignment.tableAsignment', compact('assignments'));
    }




}

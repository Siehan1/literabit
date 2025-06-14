<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Badge;
use App\Models\User;
use App\Models\History;
use App\Models\HasilKuis;
use App\Models\misionAsignment;
use App\Models\misionAsignment as ModelsMisionAsignment;

class achievmentsController extends Controller
{
    public function index()
    {
        return view('pencapaian.index');
    }




    public function showAchievments(Request $request)
    {
        $user = $request->user();

        // total buku selesai
        $bukuSelesai = History::where('user_id', $user->id)->where('status', 'completed')->count();

        // xp user
        $xpUser = $user->xp;

        $totalBadges = Badge::count();
        $unlockedBadges = $user->badges->count();
        $progress = $totalBadges > 0 ? round(($unlockedBadges / $totalBadges) * 100) : 0;

        // total kuis selesai
        $kuisSelesai = HasilKuis::where('user_id', $user->id)->count();

        // daily mission diselesaikan dalam 7 hari
        $mission = misionAsignment::where('user_id', $user->id)->where('is_done', 1)->whereDate('created_at', '>=', now()->subDays(7))->count();

        $badges = Badge::all()->map(function ($badge) use ($user) {
            return [
                'id' => $badge->id,
                'nama_badge' => $badge->nama_badge,
                'description' => $badge->description,
                'icon_path' => asset('storage/' . $badge->icon_path),
                'unlocked' => $user->badges->contains($badge->id)
            ];
        });

        return response()->json([
            'xp' => $xpUser,
            'badges' => $badges,
            'buku_selesai' => $bukuSelesai,
            'kuis_dikerjakan' => $kuisSelesai,
            'misi_selesai_mingguan' => $mission,
            'badge_progress'=>['total'=>$totalBadges,
            'unlocked'=>$unlockedBadges,
            'percent'=>$progress]
        ]);
    }
}

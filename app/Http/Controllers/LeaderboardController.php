<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('leaderboard.leaderboard', ['user_id' => $user->id]);
    }

    public function getLeaderboard()
{
    $result = DB::select('CALL GetLeaderboard()');

    $users = collect($result)->map(function ($user) {
        // Jika properti 'profil' tidak tersedia (misalnya karena tidak dipilih di SELECT), beri nilai default dulu
        $profil = property_exists($user, 'profil') && $user->profil
            ? $user->profil
            : null;

        // Buat URL gambar profil atau fallback
        $user->photo_url = $profil
            ? asset('storage/' . $profil)
            : asset('profile_penulis/pro1.svg');

        return $user;
    });

    return response()->json([
        'status' => 'success',
        'top_3' => $users->take(3)->values(),
        'top_10' => $users,
        'other_ranks' => $users->slice(3)->values(),
    ]);
}



}

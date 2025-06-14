<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index(){
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('leaderboard.leaderboard',['user_id'=>$user->id]);
    }

    public function getLeaderboard(){
        $result = DB::select('CALL GetLeaderboard()');
        
        $users = collect($result);

        // ambil top 3
        $topThree = $users->take(3)->values();

        // ambil rangking 4 sampai 10
        $others = $users->slice(3)->values();

        return response()->json([
            'status' => 'success',
            'top_3' => $topThree,
            'top_10' => $users,        // seluruh 10 besar jika dibutuhkan
            'other_ranks' => $others   // yang bukan top 3
        ]);
    }


}

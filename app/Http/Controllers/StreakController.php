<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Carbon;

class StreakController extends Controller
{
    public function streak(Request $request){
        // ambil user yang login
        $user = $request->user();

        // ambil data dari history
        $dates = History::where('user_id', $user->id)->selectRaw('DATE(created_at) as date')
        ->groupBy('date')
        ->orderByDesc('date')
        ->pluck('date')
        ->toArray();

        $streak = 0;
        $today = Carbon::today();
        $streakDates = [];

        foreach($dates as $date){
            $current = Carbon::parse($date);
            if($current->equalTo($today)){
                $streak++;
                $streakDates[] = $current->toDateString();
                $today->subDay();
            } elseif ($current->equalTo($today->copy()->subDay())) {
                $today->subDay();
                $streak++;
                $streakDates[] = $current->toDateString();
            } else {
                break;
            }
        }

        return response()->json([
            'streak'=> $streak,
            'last_active_date'=> $dates[0] ?? null,
            'date'=> $streakDates
        ]);
    }
}

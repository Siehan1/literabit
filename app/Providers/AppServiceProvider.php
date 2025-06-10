<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\levelTreshold;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\View\Components\utama\navsideRight;
use Illuminate\Support\Facades\Blade;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View::composer('components.utama.navside', function ($view) {
        // $userId = Auth::id();
        // // $user = Auth::user();
        // $user = User::find($userId);

        //     $currentThreshold = levelTreshold::where('level', $user->level + 1)->first();
        //     $nextThreshold = levelTreshold::where('level', $user->level + 2)->first();

        //     $progress = 0;

        //     if ($currentThreshold && $nextThreshold) {
        //         if ($user->xp > $currentThreshold->required_xp) {
        //             $progress = 0;
        //         } else {
        //             $xpForCurrentLevel = $user->xp - $currentThreshold->required_xp;
        //             $xpNeededForNextLevel = $nextThreshold->required_xp - $currentThreshold->required_xp;

        //             if ($xpNeededForNextLevel > 0) {
        //                 $progress = ($xpForCurrentLevel / $xpNeededForNextLevel) * 100;
        //                 $progress = min(max($progress, 0), 100);
        //             }
        //         }
        //     } else if ($currentThreshold && !$nextThreshold) {
        //         $progress = 100;
        //     }

        //     $nextLevel = levelTreshold::where('level', $user->level + 1)->first();
        //     if ($nextLevel && $user->xp >= $nextLevel->required_xp) {
        //         $user->level += 1;
        //         $user->save();
        //     }

        //     $view->with(compact('user', 'currentThreshold', 'nextThreshold', 'progress'));
        // });
        View::composer('components.utama.navside', function ($view) {
            $userId = Auth::id();
            // $user = Auth::user();
            $user = User::find($userId);

            if (!$user) {
                return; // jika belum login, hentikan composer
            }

            // Auto naik level jika XP cukup
            while (true) {
                $nextLevel = levelTreshold::where('level', $user->level + 1)->first();
                if (!$nextLevel || $user->xp < $nextLevel->required_xp)
                    break;

                $user->level += 1;
                $user->save();
            }

            // Hitung progress ke level berikutnya (setelah auto naik level)
            $currentThreshold = levelTreshold::where('level', $user->level)->first();
            $nextThreshold = levelTreshold::where('level', $user->level + 1)->first();

            $progress = 0;

            if ($currentThreshold && $nextThreshold) {
                $xpNow = $user->xp;
                $xpCurrentStart = $currentThreshold->required_xp;
                $xpNextStart = $nextThreshold->required_xp;

                $progress = ($xpNow - $xpCurrentStart) / ($xpNextStart - $xpCurrentStart) * 100;
                $progress = min(max($progress, 0), 100);
            } elseif ($currentThreshold && !$nextThreshold) {
                $progress = 100; // sudah level tertinggi
            }

            $view->with(compact('user', 'currentThreshold', 'nextThreshold', 'progress'));
        });

        // data untuk mission
        View::composer('components.utama.navside-right', function ($view) {
            $user = Auth::user();

            if (!$user) {
                return; // Jika user belum login, hentikan
            }

            $userMissions = \App\Models\MisionAsignment::with([
                'dailyMission.template',
                'user'
            ])
                ->where('user_id', $user->id)
                ->get()
                ->map(function ($mission) {
                    // Pastikan jumlah_selesai sama dengan target jika misi selesai
                    if ($mission->is_done) {
                        $mission->jumlah_selesai = $mission->dailyMission->template->jumlah_target;
                    }
                    return $mission;
                });

            $view->with('userMissions', $userMissions);
        });

    }
}

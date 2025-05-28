<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\levelTreshold;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\View\Components\utama\navsideRight;
use Illuminate\Support\Facades\Blade;

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
        View::composer('components.utama.navside', function ($view) {
            $user = Auth::user();
        
            $currentThreshold = levelTreshold::where('level', $user->level)->first();
            $nextThreshold = levelTreshold::where('level', $user->level + 1)->first();
        
            $progress = 0;
        
            if ($currentThreshold && $nextThreshold) {
                if ($user->xp < $currentThreshold->required_xp) {
                    $progress = 0;
                } else {
                    $xpForCurrentLevel = $user->xp - $currentThreshold->required_xp;
                    $xpNeededForNextLevel = $nextThreshold->required_xp - $currentThreshold->required_xp;
        
                    if ($xpNeededForNextLevel > 0) {
                        $progress = ($xpForCurrentLevel / $xpNeededForNextLevel) * 100;
                        $progress = min(max($progress, 0), 100);
                    }
                }
            } else if ($currentThreshold && !$nextThreshold) {
                $progress = 100;
            }
            $user = Auth::user();

            $nextLevel = \App\Models\levelTreshold::where('level', $user->level + 1)->first();
            if ($nextLevel && $user->xp >= $nextLevel->required_xp) {
                $user->level += 1;
                $user->save();
            }
        
            $view->with(compact('user', 'currentThreshold', 'nextThreshold', 'progress'));
        });

    }
}

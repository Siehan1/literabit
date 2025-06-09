<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class misionAsignment extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'daily_id',
        'jumlah_selesai',
        'is_done',
        'judul'
    ];

    protected $table = 'mission_assignments';

    public function dailyMission()
    {
        return $this->belongsTo(misionDaily::class, 'daily_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function calculateProgress()
    {

        $target = $this->dailyMission->template->jumlah_target;

        $progress = 0;

        if ($this->jumlah_selesai >= 0 && $target > 0) {
            $progress = ($this->jumlah_selesai / $target) * 100;
        }


        return min(100, $progress);
    }

    public function getProgressAttribute()
    {
        return $this->calculateProgress();
    }
}

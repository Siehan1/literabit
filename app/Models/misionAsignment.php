<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\misionDaily;

class misionAsignment extends Model
{
    protected $fillable = ['daily_mission_id', 'template_id', 'jumlah_selesai', 'is_done'];

    public function dailyMission(){
        return $this->belongsTo(misionDaily::class);
    }

    public function template(){
        return $this->belongTo(misionTemplate::class,'template_id');
    }
}

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

    public function dailyMission(){
        return $this->belongsTo(misionDaily::class, 'daily_id'); 
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id'); 

    }
}

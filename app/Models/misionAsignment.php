<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class misionAsignment extends Model
{
    use HasFactory; 

    
    protected $fillable = ['user_id', 'daily_id', 'jumlah_selesai', 'is_done'];

    protected $table = 'mission_assignments'; 

    public function dailyMission(){
        return $this->belongsTo(misionDaily::class, 'daily_id'); 
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id'); 
<<<<<<< HEAD
    }
    public function template(){
        return $this->belongsTo(misionTemplate::class,'template_id');
=======
>>>>>>> 5d58ca7 (mission tinggal ud)
    }
}

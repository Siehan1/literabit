<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class templateMision extends Model
{
    use HasFactory;

    // Ubah nama tabel dari 'templateMission' menjadi 'mission_templates'
    protected $table = 'mission_templates';
    protected $fillable = [
        'type',
        'deskripsi',
        'jumlah_target',
        'xp_reward',
    ];

    public function misionDaily(){
        return $this->hasMany(misionDaily::class);
    }
}

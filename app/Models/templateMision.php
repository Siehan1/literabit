<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class templateMision extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'deskripsi',
        'jumlah_target',
        'xp_reward',
    ];

    protected $table = 'mission_templates';
}

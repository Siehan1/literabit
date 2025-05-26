<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelTreshold extends Model
{
    protected $table = 'level_tresholds';
    protected $fillable = ['level', 'required_xp'];
}

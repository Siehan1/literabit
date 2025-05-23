<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelTreshold extends Model
{
    protected $fillable = ['level', 'required_xp'];
}

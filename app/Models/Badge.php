<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'nama_badge',
        'description',
        'icon_path',
    ];

    public function users(){
        return $this->belongsToMany(User::class,'user_badges')->withTimestamps();
    }
}

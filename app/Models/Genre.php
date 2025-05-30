<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_genre',
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class);
    }
}

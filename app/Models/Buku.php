<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'sinopsis',
        'penulis',
        'isi',
        'genre_id',
        'cover',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}

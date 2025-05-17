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
        'pdf_path',
        'genre_id',
        'cover_path',
        'level_required'
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

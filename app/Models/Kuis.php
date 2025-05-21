<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $fillable = [
        'buku_id', // Tambahkan baris ini
        'pertanyaan',
        // ... kolom lain yang diizinkan diisi massal ...
    ];

    // Atau jika Anda menggunakan $guarded dan ingin mengizinkan semua kecuali beberapa:
    // protected $guarded = []; // Array kosong berarti tidak ada yang dijaga (semua fillable)

    public function book()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    /**
     * Get the choices for the Kuis.
     */
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}

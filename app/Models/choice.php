<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'choice_text', // Tambahkan baris ini
        'is_correct',  // Tambahkan baris ini
        'kuis_id',     // Pastikan ini juga ada jika digunakan
        // ... kolom lain yang diizinkan diisi massal ...
    ];

    // Atau jika Anda menggunakan $guarded dan ingin mengizinkan semua kecuali beberapa:
    // protected $guarded = []; // Array kosong berarti tidak ada yang dijaga (semua fillable)

    /**
     * Get the kuis that owns the Choice.
     */
    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }
}

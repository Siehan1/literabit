<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all();

        for ($i = 1; $i <= 100; $i++) {
            $judul = "Judul Buku ke-$i";
            Buku::create([
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'sinopsis' => "Ini sinopsis dari buku ke-$i",
                'penulis' => "Penulis $i",
                'isi' => "Isi lengkap dari buku ke-$i",
                'genre_id' => $genres->random()->id,
                'cover' => null,
            ]);
        }
    }
}

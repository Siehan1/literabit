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

        for ($i = 1; $i <= 20; $i++) {
            $judul = "Judul Buku ke-$i";
            Buku::create([
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'sinopsis' => "Ini sinopsis dari buku ke-$i",
                'penulis' => "Penulis $i",
                'pdf_path' => "ini path ke - $i",
                'level_required' => rand(1, 5),
                'genre_id' => $genres->random()->id,
                'cover_path' => "ini cover ke - $i",
            ]);
        }
    }
}

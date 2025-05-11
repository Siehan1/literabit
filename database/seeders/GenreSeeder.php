<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = ['Petualangan', 'Fantasi', 'Edukasi', 'Misteri', 'Fabel', 'Komedi', 'Sejarah', 'Horor', 'Romansa', 'Motivasi'];
        foreach ($genres as $genre) {
            Genre::create(['nama_genre' => $genre]);
        }
    }
}

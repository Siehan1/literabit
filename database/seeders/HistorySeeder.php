<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\History;
use App\Models\User;
use App\Models\Buku;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $bukus = Buku::all();
        $statuses = ['dibaca', 'selesai', 'belum mulai'];

        for ($i = 1; $i <= 200; $i++) {
            History::create([
                'user_id' => $users->random()->id,
                'buku_id' => $bukus->random()->id,
                'hal_terakhir' => rand(1, 100),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}

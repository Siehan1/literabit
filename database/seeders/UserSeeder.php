<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'username' => "user$i",
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'), // gunakan bcrypt
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'username' => "admin$i",
                'name' => "Admin $i",
                'email' => "admin$i@example.com",
                'is_admin' => 1,
                'password' => Hash::make('password'), // gunakan bcrypt
            ]);
        }
        User::create([
            'username'  => "shaehyan",
            'name' => "Shaehyan",
            'email' => "shaehyan@gmail.com",
            'is_admin' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}

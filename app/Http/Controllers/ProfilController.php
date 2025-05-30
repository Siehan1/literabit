<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        // Dummy Data (nanti ganti dengan data dari DB)
        $user = Auth::user(); // kalau pakai auth
        $data = [
            'username' => $user->name ?? 'Achmad',
            'email' => $user->email ?? 'achmad@example.com',
            'join_date' => 'Mei 2025',
            'level' => 3,
            'xp' => 120,
            'buku_dibaca' => 12,
            'badges' => ['Top Skor', 'Konsisten 7 Hari', 'Pembaca Hebat'],
        ];

        return view('profil.index', $data);
    }
}

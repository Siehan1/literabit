<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        // Dummy Data (nanti ganti dengan data dari DB)
        $user = Auth::user(); // kalau pakai auth
        $totalBuku = History::where('user_id', Auth::id())->count();
        $data = [
            'username' => $user->name ?? 'Achmad',
            'email' => $user->email ?? 'achmad@example.com',
            'join_date' => 'Mei 2025',
            'level' => 3,
            'xp' => 120,
            'buku_dibaca' => 12,
            'badges' => ['Top Skor', 'Konsisten 7 Hari', 'Pembaca Hebat'],
        ];

        return view('profil.index', compact('data', 'totalBuku'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('profil')->with(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Hapus file lama jika ada
        if ($user->profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profil)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profil);
        }

        // Simpan file baru
        $path = $request->file('avatar')->store('avatars', 'public');

        // Update kolom 'profil' di database
        $user->update([
            'profil' => $path,
        ]);

        return response()->json([
            'success' => true,
            'profil_path' => $path,
            'profil_url' => asset('storage/' . $path),
            'message' => 'Foto profil berhasil diperbarui.'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\JawabanKuis;
use App\Models\HasilKuis;


class KuisController extends Controller
{
    public function tampilSoal($id_buku, $nomor)
    {
        if (session('lives') !== null && session('lives') <= 0) {
            session()->forget('lives'); // hapus nyawa
            session()->forget('kuis_jawaban'); // kalau kamu simpan jawaban di session (optional)
            return redirect()->route('kuis.gagal', ['id_buku' => $id_buku]);
        }

        // Hitung jumlah soal
        $totalSoal = Soal::where('id_buku', $id_buku)->count();

        // Ambil soal ke-n
        $soal = Soal::where('id_buku', $id_buku)->skip($nomor - 1)->first();

        // Jika soal tidak ditemukan (mungkin nomor terlalu besar), redirect ke hasil kuis
        if (!$soal) {
            return redirect()->route('kuis.hasil', ['id_buku' => $id_buku]);
        }

        // Set default nyawa jika belum ada
        if (!session()->has('lives')) {
            session(['lives' => 5]);
        }

        // Hitung progress bar (dalam %)
        $progress = ($nomor / $totalSoal) * 100;

        return view('kuis.soal', [
            'soal' => $soal,
            'nomor' => $nomor,
            'id_buku' => $id_buku,
            'lives' => session('lives'),
            'progress' => $progress,
        ]);
    }

    public function submitJawaban(Request $request)
    {
        $userId = auth()->id(); // kalau gak login, bisa null
        $benar = filter_var($request->benar, FILTER_VALIDATE_BOOLEAN); // true/false

        JawabanKuis::create([
            'user_id' => $userId,
            'id_buku' => $request->id_buku,
            'nomor' => $request->nomor,
            'jawaban_user' => $request->jawaban_user,
            'benar' => $benar,
        ]);

        // Kurangi nyawa kalau jawaban salah
        if (!$benar) {
            session(['lives' => session('lives') - 1]);
        }

        return response()->json(['status' => 'ok']);
    }

    public function tampilHasil($id_buku)
    {
        $userId = auth()->id(); // bisa null kalau belum login

        $benarCount = JawabanKuis::where('id_buku', $id_buku)
            ->where('user_id', $userId)
            ->where('benar', true)
            ->count();

        $xp = $benarCount * 10;

        // Optional: simpan ke DB total XP
        // HasilKuis::create([ ... ])

        // Bersihin session kuis
        session()->forget('lives');

        return view('kuis.hasil', ['xp' => $xp]);
    }


    public function gagal($id_buku)
    {
        // Reset lives & hapus jawaban sebelumnya
        session()->put('lives', 5);
        JawabanKuis::where('id_buku', $id_buku)->delete();

        return view('kuis.gagal', [
            'id_buku' => $id_buku
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\JawabanKuis;
use App\Models\HasilKuis;
use App\Models\Buku;
use App\Models\Kuis;
use App\Models\User;
use App\Models\Choice;
use Illuminate\Support\Facades\Auth;


class KuisController extends Controller
{
    public function index($slug){
        $buku = Buku::where('slug', $slug)->first();
        session()->forget('lives');
        session()->forget('kuis_jawaban');
        return view('kuis.intro', compact('buku'));
    }
    public function tampilSoal($slug, $nomor)
    {
        $buku = Buku::where('slug', $slug)->first();
        
        if (session('lives') !== null && session('lives') <= 0) {
            session()->forget('lives'); // hapus nyawa
            session()->forget('kuis_jawaban'); // kalau kamu simpan jawaban di session (optional)
            return redirect()->route('kuis.gagal', ['slug' => $slug]);
        }

        // Hitung jumlah soal
        $totalSoal = Kuis::where('buku_id', $buku->id)->count();

        // Ambil soal ke-n
        $soal = Kuis::with('choices')->where('buku_id', $buku->id)->skip($nomor - 1)->first();
        $choices = $soal->choices;

        // Jika soal tidak ditemukan (mungkin nomor terlalu besar), redirect ke hasil kuis
        if (!$soal) {
            return redirect()->route('kuis.hasil', ['slug' => $slug]);
        }
        
        // Set default nyawa jika belum ada
        if (!session()->has('lives')) {
            session(['lives' => 5]);
        }

        // Hitung progress bar (dalam %)
        
        $progress = (($nomor - 1) / $totalSoal) * 100;

        return view('kuis.soal', [
            'soal' => $soal,
            'totalSoal' => $totalSoal,
            'nomor' => $nomor,
            'slug' => $slug,
            'lives' => session('lives'),
            'progress' => $progress,
            'choices' => $choices,
        ]);
    }

    public function prosesJawaban(Request $request)
    {
        $isCorrect = $request->input('is_correct');
        $slug = $request->input('slug');
        $nomor = $request->input('nomor');

        $buku = Buku::where('slug', $slug)->first();
        $soal = Kuis::with('choices')->where('buku_id', $buku->id)->skip($nomor)->first();

        // Jika soal tidak ditemukan (mungkin nomor terlalu besar), redirect ke hasil kuis
        // Simpan ke session
        session()->push('kuis_jawaban', [
            'nomor' => $request->input('nomor'),
            'is_correct' => $isCorrect,
        ]);
        
        if (!$soal) {
            return redirect()->route('kuis.hasil', ['slug' => $slug]);
        }
        // Kurangi nyawa kalau jawaban salah
        if (!$isCorrect || $isCorrect == 0) {
            $lives = session('lives', 5);
            $lives--;
            session(['lives' => $lives]);

            if ($lives <= 0) {
                session()->forget('lives');
                return redirect()->route('kuis.gagal', ['slug' => $slug]);
            }
        }


        return redirect()->route('kuis.soal', [
            'slug' => $slug,
            'nomor' => $nomor + 1
        ]);
    }

    // public function submitJawaban(Request $request)
    // {
    //     $userId = auth()->id(); // kalau gak login, bisa null
    //     $benar = filter_var($request->benar, FILTER_VALIDATE_BOOLEAN); // true/false

    //     JawabanKuis::create([
    //         'user_id' => $userId,
    //         'id_buku' => $request->id_buku,
    //         'nomor' => $request->nomor,
    //         'jawaban_user' => $request->jawaban_user,
    //         'benar' => $benar,
    //     ]);

    //     // Kurangi nyawa kalau jawaban salah
    //     if (!$benar) {
    //         session(['lives' => session('lives') - 1]);
    //     }

    //     return response()->json(['status' => 'ok']);
    // }

    public function tampilHasil($slug)
    {
        $userId = Auth::id(); // bisa null kalau belum login
        $buku = Buku::where('slug', $slug)->first();
        $user = User::where('id', Auth::id());
        dd($user->id);

        // $benarCount = JawabanKuis::where('id_buku', $id_buku)
        //     ->where('user_id', $userId)
        //     ->where('benar', true)
        //     ->count();

        $jawaban = session('kuis_jawaban', []);
        $jumlahBenar = collect($jawaban)->where('is_correct', 1)->count();

        $xp = $jumlahBenar * 10;

        // Optional: simpan ke DB total XP
        HasilKuis::create([
            'user_id' => $userId,
            'buku_id' => $buku->id,
            'total_xp' => $xp,
        ]);

        // Bersihin session kuis
        session()->forget('lives');

        return view('kuis.hasil', ['xp' => $xp]);
    }


    // public function gagal($id_buku)
    // {
    //     // Reset lives & hapus jawaban sebelumnya
    //     session()->put('lives', 5);
    //     JawabanKuis::where('id_buku', $id_buku)->delete();

    //     return view('kuis.gagal', [
    //         'id_buku' => $id_buku
    //     ]);
    // }
}

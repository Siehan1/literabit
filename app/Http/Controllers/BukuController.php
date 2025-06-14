<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Genre;
use App\Models\History;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Spatie\PdfToImage\Pdf;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::with('genre')->latest()->get();
        return view('index', compact('bukus'));
    }

    public function beranda(Request $request)
    {
        $query = Buku::with('genre')->latest();
        $keyword = "";

        
        // Jika ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')->where('level_required', '<=', Auth::user()->level)
                  ->orWhere('penulis', 'like', '%' . $request->search . '%')
                  ->where('level_required', '<=', Auth::user()->level);
            });
        }

        $bukus = $query->get();

        $histories = History::where('user_id', Auth::id())->get();
        // $dibacaSlugs = Buku::whereIn('id', $histories->pluck('buku_id'))->pluck('slug');
        $dibacaSlugs = History::with('buku')->where('user_id', Auth::id())->get()->pluck('buku.slug');
        $selesaiSlugs = History::with('buku')->where('user_id', Auth::id())->where('status', 'completed')->get()->pluck('buku.slug');
        // $selesaiSlugs = Buku::whereIn('id', $histories->pluck('buku_id'))->where('status', 'completed')->pluck('slug');
        
        if ($request->has('search') && $request->search != ''){
            return view('beranda.search', compact('bukus', 'dibacaSlugs', 'keyword'));
        }
        return view('beranda.beranda', compact('bukus', 'dibacaSlugs', 'keyword'));
    }

    public function showBuku(){
        $bukus = Buku::with('genre')->get();
        return view('admin.buku.tableBuku', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('admin.buku.uploadbuku', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required|max:255|unique:bukus',
            'penulis' => 'required|max:255',
            'genre' => 'required',
            'level' => 'required',
            'sinopsis' => 'required',
            'pdf_file' => 'required|mimes:pdf|max:10000'
        ]);
        $slug = Str::slug($request['judul']);
        $file = $request->file('pdf_file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('buku', $filename, 'public');

        $path = Storage::disk('public')->path("buku/{$filename}");

        if (!file_exists($path)) {
            \Illuminate\Support\Facades\Log::error("File tidak ditemukan setelah disimpan: $path");
            return back()->withErrors(['msg' => 'File PDF tidak ditemukan setelah disimpan: ' . $path]);
        }

        $pathPdf = storage_path("app/public/buku/{$filename}");
        $outputPath = public_path("storage/cover/{$filename}.jpg");

        // Ghostscript command untuk convert halaman pertama PDF ke JPEG
        $command = "gswin64c -sDEVICE=jpeg -o \"$outputPath\" -sPageList=1 -dJPEGQ=80 -r150 \"$pathPdf\"";
        exec($command, $output, $result);

        if ($result !== 0) {
            return back()->withErrors(['msg' => 'Gagal generate thumbnail. Ghostscript error code: ' . $result]);
        }

        Buku::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'sinopsis' => $request->sinopsis,
            'penulis' => $request->penulis,
            'genre_id' => $request->genre,
            'pdf_path' => "buku/{$filename}",
            'cover_path' => "cover/{$filename}.jpg",
            'level_required' => $request->level,
        ]);

        return redirect()->route('tableBuku')->with('success', 'Buku berhasil diupload.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Cari data buku berdasarkan slug
        $bukus = Buku::with('genre')->latest()->get();
        $genres = Genre::all();
        return view('admin.buku.editBuku', compact('bukus','genres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $buku = Buku::where('slug', $slug)->firstOrFail();
        $genres = Genre::all();
        // dd($buku);

        return view('admin.buku.editBuku', compact('buku', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'genre' => 'required|exists:genres,id',
            'level' => 'required',
        ]);

        // Ambil buku berdasarkan slug
        $buku = Buku::where('slug', $slug)->firstOrFail();

        // Update data dasar
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->sinopsis = $request->sinopsis;
        $buku->genre_id = $request->genre;
        $buku->level_required = $request->level;

        // Update slug jika judul berubah
        $buku->slug = Str::slug($request->judul);

        $buku->save();

        return redirect()->route('tableBuku')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // Cari data buku berdasarkan slug
        $buku = Buku::where('slug', $slug)->firstOrFail();

        Storage::disk('public')->delete($buku->pdf_path);
        Storage::disk('public')->delete($buku->cover_path);

        // Hapus data dari database
        $buku->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus.');
    }
}
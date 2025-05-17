<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use App\Models\Buku;
use Illuminate\Support\Str;

class adminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.dashboard.admin', compact('users'));
    }
    public function showBuku(){
        $bukus = Buku::all();
        return view('admin.buku.tableBuku', compact('bukus'));
    }
    public function showUpload(){
        $bukus = Buku::all();
        return view('admin.buku.uploadbuku', compact('bukus'));
    }
    public function upload(Request $request){
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
            \Log::error("File tidak ditemukan setelah disimpan: $path");
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

        return redirect()->route('upload')->with('success', 'Buku berhasil diupload.');
    }
}

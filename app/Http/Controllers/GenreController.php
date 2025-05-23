<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.tableGenre', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.genre.tambahGenre');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'genre' => 'Required|unique:genres,nama_genre',
        ]);
        Genre::create([
            'nama_genre' => $request->genre,
        ]);
        return redirect()->route('tableGenre')->with('success', 'Genre Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genre = Genre::where('id', $id)->firstOrFail();
        return view('admin.genre.editGenre', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'genre' => 'required',
        ]);

        // Ambil buku berdasarkan slug
        $genre = Genre::where('id', $id)->firstOrFail();

        // Update data dasar
        $genre->nama_genre = $request->genre;

        $genre->save();

        return redirect()->route('tableGenre')->with('success', 'Genre berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data buku berdasarkan slug
        $genre = Genre::where('id', $id)->firstOrFail();

        // Hapus data dari database
        $genre->delete();

        return redirect()->back()->with('success', 'Genre berhasil dihapus.');
    }
}

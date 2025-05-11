<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = [
            [
                'cover' => 'buku/image1.png',
                'judul' => 'Si cemong coak',
                'penulis' => 'Tere Liye',
                'profile' => 'profile_penulis/pro1.svg',
                'genre' => 'adventure'
            ],
            [
                'cover' => 'buku/image2.png',
                'judul' => 'Buku Dua',
                'penulis' => 'Tere Liye',
                'profile' => 'profile_penulis/pro1.svg',
                'genre' => 'adventure'
            ],
            [
                'cover' => 'buku/image3.png',
                'judul' => 'Buku Tiga',
                'penulis' => 'Tere Liye',
                'profile' => 'profile_penulis/pro1.svg',
                'genre' => 'adventure'
            ],
            [
                'cover' => 'buku/image4.png',
                'judul' => 'Buku Empat',
                'penulis' => 'Tere Liye',
                'profile' => 'profile_penulis/pro1.svg',
                'genre' => 'adventure'
            ],
            [
                'cover' => 'buku/image5.png',
                'judul' => 'Buku Lima',
                'penulis' => 'Tere Liye',
                'profile' => 'profile_penulis/pro1.svg',
                'genre' => 'adventure'
            ],
            [
                'cover' => 'buku/image6.png',
                'judul' => 'Buku Enam',
                'penulis' => 'Tere Liye',
                'profile' => 'profile_penulis/pro1.svg',
                'genre' => 'adventure'
            ],
            [
                'cover' => 'buku/image7.png',
                'judul' => 'Buku Tujuh',
                'penulis' => 'Tere Liye',
                'profile' => 'profile_penulis/pro1.svg',
                'genre' => 'adventure'
            ]
        ];
        return view('index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

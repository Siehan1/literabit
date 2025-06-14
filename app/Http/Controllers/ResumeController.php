<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $buku = Buku::where('slug', $slug)->first();
        return view('resume.resume', compact('buku'));
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
    public function store(Request $request, $slug)
    {
        $request->validate([
            'resume' => 'Required',
        ]);
        $buku = Buku::where('slug', $slug)->first();
        Resume::create([
            'buku_id' => $buku->id,
            'user_id' => Auth::id(),
            'resume' => $request->resume,
        ]);

        return redirect()->route('buku.beranda')->with('success', 'Selamat! Kamu sudah membuat resume!');
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

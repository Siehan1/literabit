<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil history membaca user beserta data bukunya
        $histories = History::with('buku')
            ->where('user_id', $userId)->where('status', 'reading')
            ->latest() // supaya urutan terbaru muncul dulu
            ->take(3)   // ambil 5 buku terakhir dibaca
            ->get();
        $bukusDone = History::with('buku')
            ->where('user_id', $userId)->where('status', 'completed')
            ->latest() // supaya urutan terbaru muncul dulu
            ->take(3)   // ambil 5 buku terakhir dibaca
            ->get();
        return view('histori.index', compact('histories', 'bukusDone'));
        // return view('histori.index');
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

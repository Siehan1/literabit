<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\History;
use App\Models\HasilKuis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BacaBukuController extends Controller
{
    public function show($slug)
    {
        $buku = Buku::where('slug', $slug)->firstOrFail();
        $history = History::where('user_id', Auth::id())->where('buku_id', $buku->id)->first();
        $sudahKuis = HasilKuis::where('user_id', Auth::id())->where('buku_id', $buku->id)->exists();
        $lastPage = $history?->hal_terakhir ?? 1;

        return view('buku.bacaBuku', compact('buku', 'lastPage', 'sudahKuis'));
    }

    public function getPdf($slug)
    {
        $buku = Buku::where('slug', $slug)->firstOrFail();
        $path = storage_path("app/public/{$buku->pdf_path}");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function updateProgress(Request $request)
    {
        $data = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'halaman' => 'required|integer|min:1',
            'status' => 'nullable|in:reading,completed',
        ]);

        History::updateOrCreate(
            ['user_id' => Auth::id(), 'buku_id' => $data['buku_id']],
            ['hal_terakhir' => $data['halaman'], 'status' => $data['status'] ?? 'reading']
        );

        return response()->json(['message' => 'Progress saved']);
    }
}

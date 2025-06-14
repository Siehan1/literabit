<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Badge;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class badgesController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('admin.badges.badgesTable', compact('badges'));
    }

    public function create()
    {
        return view('admin.badges.uploadBadges');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_badge' => 'required|max:255',
            'description' => 'required|max:255',
            'icon_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);
        // $icon_path = $request->file('icon_path')->store('badges', 'public');
        $icon_path = $request->file('icon_path');
        $icon_name = time() . '.' . $icon_path->getClientOriginalExtension();
        $icon_path->storeAs('badges', $icon_name, 'public');
        $icon_path = "badges/{$icon_name}";

        Badge::create([
            'nama_badge' => $validate['nama_badge'],
            'description' => $validate['description'],
            'icon_path' => $icon_path
        ]);
        return redirect()->route('tableBadges')->with('success', 'Badges uploaded successfully');
    }

    // public function read(){
    //     $badges = Badge::all();
    //     return view()
    // }
    public function destroy($id)
    {
        $badge = Badge::where('id', $id)->firstOrFail();

        Storage::disk('public')->delete($badge->icon_path);

        // Hapus data dari database
        $badge->delete();

        return redirect()->back()->with('success', 'Badge berhasil dihapus.');
    }

    public function edit($id)
    {
        $badge = Badge::where('id', $id)->firstOrFail();

        return view('admin.badges.editBadge', compact('badge'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_badge' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $badge = Badge::where('id', $id)->firstOrFail();
        // $icon_path = $request->file('icon_path');
        // $icon_name = time() . '.' . $icon_path->getClientOriginalExtension();
        // $icon_path->storeAs('badges',$icon_name,'public');
        // $icon_path = "badges/{$icon_name}";
        if ($request->hasFile('icon_path')) {
            if ($badge->icon_path && Storage::disk('public')->exists($badge->icon_path)) {
                Storage::disk('public')->delete($badge->icon_path);
            }
            $icon_path = $request->file('icon_path');
            $icon_name = time() . '.' . $icon_path->getClientOriginalExtension();
            $icon_path->storeAs('badges', $icon_name, 'public');
            $icon_path = "badges/{$icon_name}";
            $badge->icon_path = $icon_path;
        }

        // Update data dasar
        $badge->nama_badge = $request->nama_badge;
        $badge->description = $request->description;

        $badge->save();

        return redirect()->route('tableBadges')->with('success', 'Badge berhasil diperbarui!');
    }

    public function terimaBadge()
{
    $userId = Auth::id();

    // 1. Total buku selesai
    $totalDone = DB::table('histories')
        ->where('user_id', $userId)
        ->where('status', 'done')
        ->count();

    // 2. Buku selesai dalam 7 hari terakhir
    $recentDone = DB::table('histories')
        ->where('user_id', $userId)
        ->where('status', 'done')
        ->where('updated_at', '>=', Carbon::now()->subDays(7))
        ->count();

    // 3. Total halaman dari kolom total_pages (langsung dari histories)
    $totalPages = DB::table('histories')
        ->where('user_id', $userId)
        ->where('status', 'done')
        ->sum('hal_terakhir');

    // 4. Tentukan badge yang layak
    $badges = [];

    if ($recentDone >= 3) {
        $badges[] = 'Pecinta Buku Mingguan';
    }

    if ($totalDone >= 10) {
        $badges[] = 'Kutu Buku';
    }

    if ($totalPages >= 500) {
        $badges[] = 'Penjelajah Halaman';
    }

    if ($totalPages >= 1000) {
        $badges[] = 'Petualang Buku';
    }

    return response()->json([
        'status' => 'success',
        'badges' => $badges
    ]);
}
}

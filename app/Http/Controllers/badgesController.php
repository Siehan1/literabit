<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Badge;

class badgesController extends Controller
{
    public function indexUpload(){
        return view('admin.badges.uploadBadges');
    }

    public function indexBadges(){
        return view('admin.badges.badgesTable');
    }

    public function showBadges(){
        $badges = Badge::all();
        return view('admin.badges.badgesTable', compact('badges'));
    }

    public function store(Request $request){
        $validate = $request->validate([
            'nama_badge' => 'required|max:255',
            'description' => 'required|max:255',
            'icon_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // $icon_path = $request->file('icon_path')->store('badges', 'public');
        $icon_path = $request->file('icon_path');
        $icon_name = time() . '.' . $icon_path->getClientOriginalExtension();
        $icon_path->storeAs('badges',$icon_name,'public');
        $icon_path = "badges/{$icon_name}";

        Badge::create([
            'nama_badge' => $validate['nama_badge'],
            'description' => $validate['description'],
            'icon_path' => $icon_path
        ]);
        return  redirect()->route('tableBadges')->with('success', 'Badges uploaded successfully');
    }

    // public function read(){
    //     $badges = Badge::all();
    //     return view()
    // }
}

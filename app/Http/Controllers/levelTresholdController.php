<?php

namespace App\Http\Controllers;

use App\Models\levelTreshold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class levelTresholdController extends Controller
{
    public function index(){
        $levelTreshodls = levelTreshold::orderBy('level')->get();
        return view('admin.levelTreshold.tableLevel', compact('levelTreshodls'));
    }

    public function create(){
        return view('admin.levelTreshold.uploadLevel');
    }

    public function store(Request $request){
        $validate = $request->validate([
            'level' => 'required|integer',
            'required_xp' =>'required|integer',
        ]);

        levelTreshold::create($request->all());
        return redirect()->route('tableLevel')->with('success', 'Level Treshold uploaded successfully');
    }

    public function edit($id){
        $levelTreshodls = levelTreshold::findOrFail($id);
        return view('admin.levelTreshold.editLevel', compact('levelTreshodls'));
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
            'level' => 'required|integer',
            'required_xp' =>'required|integer',
        ]);

        $levelTreshold = levelTreshold::findOrFail($id);
        $levelTreshold->update($request->all());
        // Ganti nama route di sini
        return redirect()->route('tableLevel')->with('success', 'Level Treshold updated successfully');

    }

    public function destroy(levelTreshold $levelTreshold){
        $levelTreshold->delete();
        return redirect()->route('tableLevel')->with('success', 'Template deleted successfully');
    }

    public function levelUp()
{
    $user = Auth::user();
    $currentThreshold = levelTreshold::where('level', $user->level)->first();
    $nextThreshold = levelTreshold::where('level', $user->level + 1)->first();

    $progress = 0;
    if ($currentThreshold && $nextThreshold) {
        $xpForCurrentLevel = $user->exp - $currentThreshold->xp_required;
        $xpNeededForNextLevel = $nextThreshold->xp_required - $currentThreshold->xp_required;
        if ($xpNeededForNextLevel > 0) {
             $progress = ($xpForCurrentLevel / $xpNeededForNextLevel) * 100;
        }
    } else if ($currentThreshold && !$nextThreshold) {
        // If user is at max level
        $progress = 100;
    }

    return view('beranda.beranda', compact('user', 'currentThreshold', 'nextThreshold', 'progress'));
}

}

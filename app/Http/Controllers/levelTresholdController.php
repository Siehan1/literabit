<?php

namespace App\Http\Controllers;

use App\Models\levelTreshold;
use Illuminate\Http\Request;

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
        // Ganti nama route di sini
        return redirect()->route('tableLevel')->with('success', 'Level Treshold uploaded successfully');
    }

    public function edit(levelTreshold $levelTreshodls){
        return view('admin.levelTreshold.editLevel', compact('levelTresholds'));
    }

    public function update(Request $request, levelTreshold $levelTreshodls){
        $validate = $request->validate([
            'level' => 'required|integer',
            'required_xp' =>'required|integer',
        ]);

        $levelTreshodls->update($request->all());
        // Ganti nama route di sini
        return redirect()->route('tableLevel')->with('success', 'Level Treshold updated successfully');

    }

    // Ganti nama variabel dari $levelTreshodl menjadi $levelTreshold
    public function destroy(levelTreshold $levelTreshold){
        $levelTreshold->delete();
        return redirect()->route('tableLevel')->with('success', 'Level Treshold deleted successfully');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\templateMision;

class misionTemplate extends Controller
{
    public function index(){
        $template = templateMision::all();
        return view('admin.mision.templateMision.tableMision',compact('template'));
    }

    public function create(){
        return view('admin.mision.templateMision.storeTemplate');
    }

    public function store(Request $request){
        $request->validate([
            'type' => 'required|in:read,quiz',
            'deskripsi' => 'required|string',
            'jumlah_target' => 'required|integer|min:1',
            'xp_reward' => 'required|integer|min:0',
        ]);

        // Karena nama input field sekarang 'jumlah_target', $request->all() akan menyertakannya
        templateMision::create($request->all());

        return redirect()->route('missionTemplate.index')->with('success', 'Template created successfully');
<<<<<<< HEAD
    }

    public function destroy(templateMision $template){
        $template->delete();
        return redirect()->route('missionTemplate.index')->with('success', 'Template deleted successfully');
    }

    public function edit($id){
        $template = templateMision::findOrFail($id);
        return view('admin.mision.templateMision.editTemplate', compact('template'));
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
            'type' =>'required|in:read,quiz',
            'deskripsi' =>'required|string',
            'jumlah_target' =>'required|integer|min:1',
            'xp_reward' =>'required|integer|min:0',
        ]);
        $template = templateMision::findOrFail($id);
        $template->update($request->all());
        return redirect()->route('missionTemplate.index')->with('success', 'Template updated successfully');
=======
>>>>>>> 5d58ca7 (mission tinggal ud)
    }

    public function destroy(templateMision $template){
        $template->delete();
        return redirect()->route('missionTemplate.index')->with('success', 'Template deleted successfully');
    }

    public function edit($id){
        $template = templateMision::findOrFail($id);
        return view('admin.mision.templateMision.editTemplate', compact('template'));
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
            'type' =>'required|in:read,quiz',
            'deskripsi' =>'required|string',
            'jumlah_target' =>'required|integer|min:1',
            'xp_reward' =>'required|integer|min:0',
        ]);
        $template = templateMision::findOrFail($id);
        $template->update($request->all());
        return redirect()->route('missionTemplate.index')->with('success', 'Template updated successfully');
    }
}



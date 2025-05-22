<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\misionDaily;
use App\Models\templateMision;
use App\Models\misionAsignment;
use App\Models\User;

class dailyMision extends Controller
{
    public function index()
    {
        $misions = misionDaily::with('template')->get(); 
        return view('admin.mision.dailyMision.tableDaily', compact('misions'));
    }

    public function create()
    {
        $templates = templateMision::all();
        return view('admin.mision.dailyMision.storeDaily', compact('templates'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Ubah 'template_misions' menjadi 'mission_templates'
            'template_id' => 'required|exists:mission_templates,id',
            'tanggal' => 'required|date',
        ]);

        $mision = misionDaily::create($validatedData);

        return redirect()->route('tableDaily')
                        ->with('success', 'Daily mission created successfully');
    }

    public function destroy($id)
    {
        $mission = misionDaily::findOrFail($id);
        $mission->delete();
        return redirect()->route('tableDaily')
                        ->with('success', 'Daily mission deleted successfully');
    }

<<<<<<< HEAD
    public function edit($id)
    {
        $mission = misionDaily::findOrFail($id);
        $templates = templateMision::all();
        return view('admin.mision.dailyMision.editDaily', compact('mission', 'templates'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'template_id' => 'required|exists:mission_templates,id',
            'tanggal' => 'required|date',
            'is_completed' => 'boolean',
        ]);
        $mission = misionDaily::findOrFail($id);
        $mission->update($validatedData);
        return redirect()->route('tableDaily')
                        ->with('success', 'Daily mission updated successfully');
    }

=======
>>>>>>> 5d58ca7 (mission tinggal ud)
}

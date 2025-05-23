<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kuis;
use App\Models\Choice;

class quizController extends Controller
{
    public function create(){
        $books = Buku::all();
        return view('admin.kuis.uploadKuis', compact('books'));
    }

    public function store(Request $request){
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'pertanyaan' => 'required|string|max:255',
            'choices' => 'required|array|min:2', // Minimal 2 pilihan
            'choices.*.choice_text' => 'required|string|max:255',
            // Hapus validasi 'choices.*.is_correct' => 'boolean', karena form tidak mengirim ini
            'correct_choice_index' => 'required|integer|min:0|max:' . (count($request->choices ?? []) - 1), // Validasi index jawaban benar
        ]);

        // Hapus pengecekan $correctCount berdasarkan 'is_correct' di array choices
        // Karena kita menggunakan 'correct_choice_index' dari radio button

        // Buat Kuis baru
        $kuis = Kuis::create([
            'buku_id' => $request->buku_id,
            'pertanyaan' => $request->pertanyaan,
        ]);

        // Buat Choices untuk Kuis ini
        foreach ($request->choices as $index => $choiceData) {
            // Tentukan is_correct berdasarkan index yang dipilih di radio button
            $isCorrect = ($index == $request->correct_choice_index);
            $kuis->choices()->create([
                'choice_text' => $choiceData['choice_text'],
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('tableKuis')->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function index()
    {
        $kuises = Kuis::with('book')->get();
        return view('admin.kuis.tableKuis', compact('kuises'));
    }

    public function destroy($id){
        $kuis = Kuis::where('id', $id)->firstOrFail();
        Choice::where('kuis_id', $kuis->id)->delete();

        // $choice->delete();
        $kuis->delete();

        return redirect()->back()->with('success', 'Kuis Berhasil Dihapus!');
    }

    public function edit($id){
        $kuis = Kuis::where('id', $id)->firstOrFail();
        $bukus = Buku::all();
        $choice = Choice::where('kuis_id', $kuis->id);

        return view('admin.kuis.editKuis', compact('kuis', 'bukus', 'choice'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'pertanyaan' => 'required|string',
            'choices' => 'required|array|min:2',
            'choices.*.choice_text' => 'required|string',
            'correct_choice_index' => 'required|integer',
        ]);

        $kuis = Kuis::findOrFail($id);
        $kuis->update([
            'buku_id' => $request->buku_id,
            'pertanyaan' => $request->pertanyaan,
        ]);

        // Hapus semua choice lama
        $kuis->choices()->delete();

        // Simpan choice baru
        foreach ($request->choices as $index => $choiceData) {
            $kuis->choices()->create([
                'choice_text' => $choiceData['choice_text'],
                'is_correct' => ($index == $request->correct_choice_index),
            ]);
        }

        return redirect()->route('tableKuis')->with('success', 'Kuis berhasil diperbarui.');
}

}

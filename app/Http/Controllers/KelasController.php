<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index() {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function create() {
        return view('kelas.create');
    }

    public function store(Request $request) {
        // validasi input
        $request->validate([
            'nama_kelas' => 'required',
            'instruktur' => 'required',
            'deskripsi' => 'nullable'
        ]);

        // simpen database
        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas) {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas) {
        // validasi data yg uda ada
        $request->validate([
            'nama_kelas' => 'required',
            'instruktur' => 'required'
        ]);

        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kelas) {
        $kelas->delete();
        // pendaftaran di kelas ini otomatis kehapus jg
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}

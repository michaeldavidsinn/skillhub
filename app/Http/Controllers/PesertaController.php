<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;

class PesertaController extends Controller
{
    public function index() {
        $peserta = Peserta::all();
        return view('peserta.index', compact('peserta'));
    }

    public function create() {
        return view('peserta.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:peserta',
            'no_hp' => 'required'
        ]);
        Peserta::create($request->all());
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan');
    }

    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);

        return view('peserta.show', compact('peserta'));
    }

    public function edit(Peserta $peserta) {
        return view('peserta.edit', compact('peserta'));
    }

    public function update(Request $request, Peserta $peserta) {
        $peserta->update($request->all());
        return redirect()->route('peserta.index');
    }

    public function destroy($id)
    {
        try {
            // cari data manual biar pasti ketemu
            $peserta = Peserta::findOrFail($id);

            // coba hapus
            $peserta->delete();

            // kalau berhasil, balik ke index
            return redirect()->route('peserta.index')->with('success', 'Data berhasil dihapus!');

        } catch (\Illuminate\Database\QueryException $e) {

            // JIKA GAGAL (Kena Foreign Key), akan muncul pesan ini
            return redirect()->route('peserta.index')->with('error', 'Gagal menghapus! Peserta ini masih terdaftar di Kelas. Hapus dulu pendaftarannya, atau pastikan database support Cascade.');

        } catch (\Exception $e) {

            // error lain
            return redirect()->route('peserta.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}

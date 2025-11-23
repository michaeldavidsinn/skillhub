<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

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
        try {
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email|unique:peserta',
                'no_hp' => 'required'
            ]);

            Peserta::create($request->all());

            return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan');

        } catch (QueryException $e) {
            // Error Database (misal koneksi putus / duplikat data lolos validasi)
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data! Pastikan email belum terdaftar.');
        } catch (\Exception $e) {
            // Error Umum
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function edit(Peserta $peserta) {
        return view('peserta.edit', compact('peserta'));
    }

    public function update(Request $request, Peserta $peserta) {
        try {
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required'
            ]);

            $peserta->update($request->all());
            return redirect()->route('peserta.index')->with('success', 'Data berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function show($id) {
        try {
            $peserta = Peserta::findOrFail($id);
            return view('peserta.show', compact('peserta'));
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Data peserta tidak ditemukan!');
        }
    }

    public function destroy($id) {
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->delete(); // cascade akan bekerja di sini
            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus');

        } catch (QueryException $e) {
            // menangkap error jika Cascade gagal
            return redirect()->route('peserta.index')->with('error', 'Gagal menghapus! Data ini masih berelasi dengan data lain.');
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}
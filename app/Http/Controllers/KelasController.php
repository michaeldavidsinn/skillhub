<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule; // Pastikan ini ada

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
        try {

            $request->validate([
                'nama_kelas' => 'required|string|max:100',
                'instruktur' => 'required|string|max:100',
                'deskripsi'  => 'nullable|string',
            ]);

            // cari data yang sama persis
            $cekDuplikat = Kelas::where('nama_kelas', $request->nama_kelas)
                                ->where('instruktur', $request->instruktur)
                                ->exists(); // Hasilnya TRUE atau FALSE

            if ($cekDuplikat) {
                // 'withInput' agar tulisan yang udah diketik user ga ilang
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal! Kelas dengan nama dan instruktur tersebut SUDAH ADA.');
            }

            Kelas::create($request->all());

            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal tambah kelas: ' . $e->getMessage());
        }
    }

    public function show($id) {
        try {
            $kelas = Kelas::with('peserta')->findOrFail($id);
            return view('kelas.show', compact('kelas'));
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Kelas tidak ditemukan');
        }
    }

    public function edit(Kelas $kelas) {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas) {
        try {
            $request->validate([
                'nama_kelas' => 'required|string|max:100',
                'instruktur' => 'required|string|max:100',
                'deskripsi'  => 'nullable|string',
            ]);

            // cari data kembar, TAPI ID-nya bukan ID sendiri
            $cekDuplikat = Kelas::where('nama_kelas', $request->nama_kelas)
                                ->where('instruktur', $request->instruktur)
                                ->where('id', '!=', $kelas->id) // abaikan diri sendiri
                                ->exists();

            if ($cekDuplikat) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal! Kelas dengan nama dan instruktur tersebut SUDAH ADA.');
            }

            $kelas->update($request->all());

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update kelas: ' . $e->getMessage());
        }
    }

    public function destroy(Kelas $kelas) {
        try {
            $kelas->delete();
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->route('kelas.index')->with('error', 'Gagal hapus kelas! Masih ada peserta terdaftar.');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Terjadi kesalahan sistem.');
        }
    }
}
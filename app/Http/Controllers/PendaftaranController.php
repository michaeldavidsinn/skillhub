<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index() {
        // Menampilkan data relasi
        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('kelas', 'pendaftaran.kelas_id', '=', 'kelas.id')
            ->select('pendaftaran.id', 'peserta.nama as nama_peserta', 'kelas.nama_kelas', 'pendaftaran.created_at')
            ->orderBy('pendaftaran.created_at', 'desc') // biar yang muncul paling atas yg terbaru
            ->get();

        return view('pendaftaran.index', compact('pendaftaran'));
    }

    public function create() {
        $peserta = Peserta::all();
        $kelas = Kelas::all();
        return view('pendaftaran.create', compact('peserta', 'kelas'));
    }

    public function store(Request $request) {
        $request->validate([
            'peserta_id' => 'required',
            'kelas_id' => 'required'
        ]);

        $peserta = Peserta::find($request->peserta_id);

        // cek apakah sudah terdaftar (Validasi Logika)
        if($peserta->kelas->contains($request->kelas_id)) {
            return back()->with('error', 'Peserta sudah terdaftar di kelas ini!');
        }

        // simpen relaso
        $peserta->kelas()->attach($request->kelas_id);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran Berhasil');
    }

    public function destroy($id) {
        DB::table('pendaftaran')->where('id', $id)->delete();
        return redirect()->route('pendaftaran.index');
    }
}

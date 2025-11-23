<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index() {
        try {
            $pendaftaran = DB::table('pendaftaran')
                ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                ->join('kelas', 'pendaftaran.kelas_id', '=', 'kelas.id')
                ->select(
                    'pendaftaran.id',
                    'peserta.nama as nama_peserta',
                    'kelas.nama_kelas',
                    'pendaftaran.created_at'
                )
                ->orderBy('pendaftaran.created_at', 'desc')
                ->get();

            return view('pendaftaran.index', compact('pendaftaran'));

        } catch (\Exception $e) {
            // jika query gagal (misal nama tabel salah)
            return back()->with('error', 'Gagal memuat data transaksi.');
        }
    }

    public function create() {
        $peserta = Peserta::all();
        $kelas = Kelas::all();
        return view('pendaftaran.create', compact('peserta', 'kelas'));
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'peserta_id' => 'required',
                'kelas_id' => 'required'
            ]);

            $peserta = Peserta::findOrFail($request->peserta_id);

            // cek Duplikasi
            // "Apakah peserta ini sudah mengambil kelas ini sebelumnya?"
            if($peserta->kelas->contains($request->kelas_id)) {
                return back()->with('error', 'Peserta ini SUDAH terdaftar di kelas tersebut!');
            }

            $peserta->kelas()->attach($request->kelas_id);

            return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran Berhasil');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    public function destroy($id) {
        try {
            DB::table('pendaftaran')->where('id', $id)->delete();
            return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran dibatalkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membatalkan pendaftaran.');
        }
    }
}
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Pendaftaran Kelas</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('pendaftaran.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold">1. Pilih Peserta</label>
                        <select name="peserta_id" class="form-select form-select-lg" required>
                            <option value="">-- Cari Nama Peserta --</option>
                            @foreach($peserta as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->email }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Pastikan peserta sudah terdaftar di menu Peserta.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">2. Pilih Kelas Tujuan</label>
                        <select name="kelas_id" class="form-select form-select-lg" required>
                            <option value="">-- Cari Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }} - {{ $k->instruktur }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan Transaksi</button>
                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-light border">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
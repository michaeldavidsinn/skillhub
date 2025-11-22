@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Tambah Kelas Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" required placeholder="Contoh: Web Programming">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Instruktur Pengajar</label>
                        <input type="text" name="instruktur" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Kelas</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
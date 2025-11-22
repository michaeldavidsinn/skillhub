@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Edit Data Kelas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" value="{{ $kelas->nama_kelas }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Instruktur Pengajar</label>
                        <input type="text" name="instruktur" class="form-control" value="{{ $kelas->instruktur }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $kelas->deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success text-white">Update Kelas</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
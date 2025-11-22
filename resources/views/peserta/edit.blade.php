@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Edit Data Peserta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $peserta->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $peserta->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ $peserta->no_hp }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success text-white">Update Data</button>
                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
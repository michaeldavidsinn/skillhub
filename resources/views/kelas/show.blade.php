@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Kelas</h5>
                <a href="{{ route('kelas.index') }}" class="btn btn-light btn-sm">Kembali</a>
            </div>
            <div class="card-body">

                <div class="mb-4">
                    <h2 class="fw-bold text-success">{{ $kelas->nama_kelas }}</h2>
                    <h5 class="text-muted">Instruktur: {{ $kelas->instruktur }}</h5>
                    <p class="mt-3 p-3 bg-light rounded border">{{ $kelas->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-secondary mb-0">Daftar Peserta di Kelas Ini</h5>
                    <span class="badge bg-secondary">{{ $kelas->peserta->count() }} Orang</span>
                </div>

                @if($kelas->peserta->isEmpty())
                    <div class="alert alert-warning">Belum ada peserta yang mendaftar di kelas ini.</div>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelas->peserta as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
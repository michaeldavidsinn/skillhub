@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Peserta</h5>
                    <a href="{{ route('peserta.index') }}" class="btn btn-light btn-sm">Kembali</a>
                </div>
                <div class="card-body">

                    <div class="mb-4">
                        <h2 class="fw-bold">{{ $peserta->nama }}</h2>
                        <p class="text-muted mb-1"><i class="bi bi-envelope"></i> Email: {{ $peserta->email }}</p>
                        <p class="text-muted"><i class="bi bi-phone"></i> No HP: {{ $peserta->no_hp }}</p>
                        <p class="text-muted">
                            <i class="bi bi-clock"></i> Terdaftar sejak:
                            {{ $peserta->created_at ? $peserta->created_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>

                    <hr>
                    <h5 class="fw-bold text-secondary mb-3">Kelas yang Diikuti</h5>

                    @if($peserta->kelas->isEmpty())
                        <div class="alert alert-warning">Peserta ini belum mengikuti kelas apapun.</div>
                    @else
                        <div class="list-group">
                            @foreach($peserta->kelas as $k)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $k->nama_kelas }}</h6>
                                        <small class="text-muted">Instruktur: {{ $k->instruktur }}</small>
                                    </div>
                                    <span class="badge bg-primary">Aktif</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary">Data Peserta</h5>
        <a href="{{ route('peserta.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Peserta
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Kontak</th>
                    <th>Kelas yang Diikuti</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peserta as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ $p->nama }}</td>
                    <td>
                        <div>{{ $p->email }}</div>
                        <small class="text-muted">{{ $p->no_hp }}</small>
                    </td>
                    <td>
                        <!-- relasi many to many -->
                        @if($p->kelas->isEmpty())
                            <span class="badge bg-secondary">Belum ada kelas</span>
                        @else
                            @foreach($p->kelas as $k)
                                <span class="badge bg-info text-dark mb-1">{{ $k->nama_kelas }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td class="text-center">
                        <form action="{{ route('peserta.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">

                            <a href="{{ route('peserta.show', $p->id) }}" class="btn btn-info btn-sm text-white">Detail</a>
                            <a href="{{ route('peserta.edit', $p->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Data peserta belum ada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
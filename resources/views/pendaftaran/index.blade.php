@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-primary">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 text-primary fw-bold">Transaksi Pendaftaran</h5>
            <small class="text-muted">Daftar peserta yang mengambil kelas</small>
        </div>
        <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Daftarkan Peserta
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tanggal Daftar</th>
                    <th>Nama Peserta</th>
                    <th>Kelas Diambil</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $item)
                <tr>
                    <td>#{{ $item->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                    <td class="fw-bold">{{ $item->nama_peserta }}</td>
                    <td>
                        <span class="badge bg-success text-white" style="font-size: 0.9rem;">
                            {{ $item->nama_kelas }}
                        </span>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('pendaftaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Batalkan pendaftaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i> Batalkan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">
                        <p class="text-muted mb-0">Belum ada data pendaftaran.</p>
                        <a href="{{ route('pendaftaran.create') }}" class="text-decoration-none">Klik di sini untuk mendaftarkan peserta</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-success">Data Kelas Kursus</h5>
        <a href="{{ route('kelas.create') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Kelas
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Instruktur</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $index => $k)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ $k->nama_kelas }}</td>
                    <td>{{ $k->instruktur }}</td>
                    <td>{{ $k->deskripsi }}</td>
                    <td class="text-center">
                        <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">

                            <a href="{{ route('kelas.show', $k->id) }}" class="btn btn-info btn-sm text-white">Detail</a>
                            <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada kelas dibuka.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Dosen</h2>
        <a href="{{ route('dosen.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIDN</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dosens as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>{{ $dosen->telepon ?? '-' }}</td>
                            <td>
                                <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus dosen ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data dosen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

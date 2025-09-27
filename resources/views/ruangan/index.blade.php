@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Ruangan</h1>
        <a href="{{ route('ruangan.create') }}" class="btn btn-primary mb-3">+ Tambah Ruangan</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ruangans as $ruangan)
                    <tr>
                        <td>{{ $ruangan->nama }}</td>
                        <td>{{ $ruangan->lokasi }}</td>
                        <td>{{ $ruangan->kapasitas }}</td>
                        <td>
                            <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus ruangan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

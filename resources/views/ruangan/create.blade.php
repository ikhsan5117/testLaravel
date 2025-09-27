@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Ruangan</h1>

        <form action="{{ route('ruangan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control">
            </div>

            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection

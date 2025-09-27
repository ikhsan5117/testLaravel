@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Ruangan</h1>

        <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $ruangan->nama }}" required>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="{{ $ruangan->lokasi }}">
            </div>

            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" value="{{ $ruangan->kapasitas }}">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection

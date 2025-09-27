@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Ruangan</h1>

        <p><strong>Nama:</strong> {{ $ruangan->nama }}</p>
        <p><strong>Lokasi:</strong> {{ $ruangan->lokasi }}</p>
        <p><strong>Kapasitas:</strong> {{ $ruangan->kapasitas }}</p>

        <a href="{{ route('ruangan.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection

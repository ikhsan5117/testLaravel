<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card Form -->
            <div class="card shadow-lg rounded-4">
                <div class="card-header text-center bg-primary text-white rounded-top-4">
                    <h4>Tambah Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/mahasiswa">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prodi</label>
                            <input type="text" name="prodi" class="form-control" placeholder="Masukkan Prodi">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ruangan</label>
                            <input type="text" name="ruangan" class="form-control" placeholder="Masukkan Ruangan">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card List -->
            <div class="card mt-4 shadow-lg rounded-4">
                <div class="card-header text-center bg-success text-white rounded-top-4">
                    <h4>List Mahasiswa</h4>
                </div>
                <div class="card-body">
                    @if($data->count() > 0)
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Prodi</th>
                                    <th>Ruangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $mhs)
                                    <tr>
                                        <td>{{ $mhs->nama }}</td>
                                        <td>{{ $mhs->nim }}</td>
                                        <td>{{ $mhs->prodi }}</td>
                                        <td>{{ $mhs->ruangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted text-center">Belum ada data mahasiswa.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS (opsional, untuk komponen interaktif) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

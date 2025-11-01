<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
        <h2 class="text-xl font-semibold mb-4">E-KYC - Langkah 4: Data Domisili & Tambahan</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc ml-4 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ekyc.step4.store') }}" method="POST">
            @csrf

            {{-- Alamat Domisili --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Alamat Domisili Lengkap</label>
                <textarea name="alamat_domisili" rows="3" class="w-full border-gray-300 rounded-md p-2" placeholder="Masukkan alamat lengkap">{{ old('alamat_domisili', $data->alamat_domisili ?? '') }}</textarea>
            </div>

            {{-- Provinsi --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Provinsi</label>
                <select name="provinsi" class="w-full border-gray-300 rounded-md p-2" onchange="updateKota()">
                    <option value="">-- Pilih Provinsi --</option>
                    <option value="Jawa Barat" {{ old('provinsi', $data->provinsi ?? '') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                    <option value="Jawa Tengah" {{ old('provinsi', $data->provinsi ?? '') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                    <option value="Jawa Timur" {{ old('provinsi', $data->provinsi ?? '') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                </select>
            </div>

            {{-- Kota/Kabupaten --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Kota/Kabupaten</label>
                <select name="kota_kabupaten" class="w-full border-gray-300 rounded-md p-2" onchange="updateKecamatan()">
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                    @if(old('provinsi', $data->provinsi ?? '') == 'Jawa Barat')
                        <option value="Bandung" {{ old('kota_kabupaten', $data->kota_kabupaten ?? '') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    @elseif(old('provinsi', $data->provinsi ?? '') == 'Jawa Tengah')
                        <option value="Semarang" {{ old('kota_kabupaten', $data->kota_kabupaten ?? '') == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                    @elseif(old('provinsi', $data->provinsi ?? '') == 'Jawa Timur')
                        <option value="Surabaya" {{ old('kota_kabupaten', $data->kota_kabupaten ?? '') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                    @endif
                </select>
            </div>

            {{-- Kecamatan --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Kecamatan</label>
                <select name="kecamatan" class="w-full border-gray-300 rounded-md p-2">
                    <option value="">-- Pilih Kecamatan --</option>
                    @if(old('kota_kabupaten', $data->kota_kabupaten ?? '') == 'Bandung')
                        <option value="Coblong" {{ old('kecamatan', $data->kecamatan ?? '') == 'Coblong' ? 'selected' : '' }}>Coblong</option>
                    @elseif(old('kota_kabupaten', $data->kota_kabupaten ?? '') == 'Semarang')
                        <option value="Semarang Utara" {{ old('kecamatan', $data->kecamatan ?? '') == 'Semarang Utara' ? 'selected' : '' }}>Semarang Utara</option>
                    @elseif(old('kota_kabupaten', $data->kota_kabupaten ?? '') == 'Surabaya')
                        <option value="Genteng" {{ old('kecamatan', $data->kecamatan ?? '') == 'Genteng' ? 'selected' : '' }}>Genteng</option>
                    @endif
                </select>
            </div>

            {{-- Kode Pos --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Kode Pos</label>
                <input type="number" name="kode_pos" value="{{ old('kode_pos', $data->kode_pos ?? '') }}" class="w-full border-gray-300 rounded-md p-2" maxlength="6" placeholder="Masukkan kode pos (max 6 digit)">
            </div>

            {{-- Nama Ibu Kandung --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Ibu Kandung</label>
                <input type="text" name="nama_ibu_kandung" value="{{ old('nama_ibu_kandung', $data->nama_ibu_kandung ?? '') }}" class="w-full border-gray-300 rounded-md p-2" placeholder="Masukkan nama ibu kandung">
            </div>

            {{-- Sumber Informasi --}}
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Referensi / Sumber Informasi Pendaftaran</label>
                <select name="sumber_informasi" class="w-full border-gray-300 rounded-md p-2">
                    <option value="">-- Pilih Sumber Informasi --</option>
                    <option value="sosmed" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'sosmed' ? 'selected' : '' }}>Sosial Media</option>
                    <option value="kerabat" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'kerabat' ? 'selected' : '' }}>Kerabat</option>
                    <option value="informasi_kampus" {{ old('sumber_informasi', $data->sumber_informasi ?? '') == 'informasi_kampus' ? 'selected' : '' }}>Informasi Kampus</option>
                </select>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('ekyc.step3') }}" class="text-sm text-gray-500 hover:text-gray-700"> <- Kembali ke Step 3</a>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded hover:from-blue-600 hover:to-purple-700">Selesai & Kirim</button>
            </div>
        </form>
    </div>

    <script>
        function updateKota() {
            const provinsi = document.querySelector('[name="provinsi"]').value;
            const kotaSelect = document.querySelector('[name="kota_kabupaten"]');
            const kecamatanSelect = document.querySelector('[name="kecamatan"]');

            // Reset options
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

            if (provinsi === 'Jawa Barat') {
                kotaSelect.innerHTML += '<option value="Bandung">Bandung</option>';
            } else if (provinsi === 'Jawa Tengah') {
                kotaSelect.innerHTML += '<option value="Semarang">Semarang</option>';
            } else if (provinsi === 'Jawa Timur') {
                kotaSelect.innerHTML += '<option value="Surabaya">Surabaya</option>';
            }
        }

        function updateKecamatan() {
            const kota = document.querySelector('[name="kota_kabupaten"]').value;
            const kecamatanSelect = document.querySelector('[name="kecamatan"]');

            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

            if (kota === 'Bandung') {
                kecamatanSelect.innerHTML += '<option value="Coblong">Coblong</option>';
            } else if (kota === 'Semarang') {
                kecamatanSelect.innerHTML += '<option value="Semarang Utara">Semarang Utara</option>';
            } else if (kota === 'Surabaya') {
                kecamatanSelect.innerHTML += '<option value="Genteng">Genteng</option>';
            }
        }
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah E-KYC Registration') }}
            </h2>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Buat registrasi E-KYC baru untuk mahasiswa
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <form method="POST" action="{{ route('ekyc.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Step 1: Data Pribadi -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Step 1: Data Pribadi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border-gray-300 rounded-md p-2" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">NIK</label>
                                    <input type="text" name="nik" value="{{ old('nik') }}" class="w-full border-gray-300 rounded-md p-2" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full border-gray-300 rounded-md p-2" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Alamat</label>
                                    <textarea name="alamat" class="w-full border-gray-300 rounded-md p-2" rows="3">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Upload Dokumen -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Step 2: Upload Dokumen</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Foto KTP</label>
                                    <input type="file" name="file_ktp" accept="image/*" class="w-full border-gray-300 rounded-md p-2" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Foto KK</label>
                                    <input type="file" name="file_kk" accept="image/*" class="w-full border-gray-300 rounded-md p-2" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Foto Ijazah</label>
                                    <input type="file" name="file_ijazah" accept="image/*" class="w-full border-gray-300 rounded-md p-2" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Foto Selfie</label>
                                    <input type="file" name="file_selfie" accept="image/*" class="w-full border-gray-300 rounded-md p-2" required>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Riwayat Pendidikan -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Step 3: Riwayat Pendidikan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Asal SD</label>
                                    <input type="text" name="asal_sd" value="{{ old('asal_sd') }}" class="w-full border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Asal SMP</label>
                                    <input type="text" name="asal_smp" value="{{ old('asal_smp') }}" class="w-full border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Asal SMA</label>
                                    <input type="text" name="asal_sma" value="{{ old('asal_sma') }}" class="w-full border-gray-300 rounded-md p-2">
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Data Tambahan -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Step 4: Data Tambahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Alamat Domisili</label>
                                    <textarea name="alamat_domisili" class="w-full border-gray-300 rounded-md p-2" rows="3">{{ old('alamat_domisili') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Provinsi</label>
                                    <input type="text" name="provinsi" value="{{ old('provinsi') }}" class="w-full border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kota/Kabupaten</label>
                                    <input type="text" name="kota_kabupaten" value="{{ old('kota_kabupaten') }}" class="w-full border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kecamatan</label>
                                    <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" class="w-full border-gray-300 rounded-md p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kode Pos</label>
                                    <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" class="w-full border-gray-300 rounded-md p-2" maxlength="6">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Nama Ibu Kandung</label>
                                    <input type="text" name="nama_ibu_kandung" value="{{ old('nama_ibu_kandung') }}" class="w-full border-gray-300 rounded-md p-2">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-1">Sumber Informasi</label>
                                    <select name="sumber_informasi" class="w-full border-gray-300 rounded-md p-2">
                                        <option value="">Pilih sumber informasi</option>
                                        <option value="sosmed" {{ old('sumber_informasi') == 'sosmed' ? 'selected' : '' }}>Sosial Media</option>
                                        <option value="kerabat" {{ old('sumber_informasi') == 'kerabat' ? 'selected' : '' }}>Kerabat</option>
                                        <option value="informasi_kampus" {{ old('sumber_informasi') == 'informasi_kampus' ? 'selected' : '' }}>Informasi Kampus</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('ekyc.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-md hover:from-blue-600 hover:to-purple-700 transition duration-200">
                                Simpan E-KYC
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

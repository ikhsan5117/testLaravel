<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ===== Form Tambah Mahasiswa ===== --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Tambah Mahasiswa</h3>

                    {{-- Menampilkan error global --}}
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('mahasiswa.store') }}">
                        @csrf

                        <div class="mb-2">
                            <label for="nama" class="sr-only">Nama</label>
                            <input id="nama" type="text" name="nama" placeholder="Nama"
                                   value="{{ old('nama') }}"
                                   required
                                   class="border border-gray-300 rounded-md w-full mb-2 p-2">
                            @error('nama')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="nim" class="sr-only">NIM</label>
                            <input id="nim" type="text" name="nim" placeholder="NIM"
                                   value="{{ old('nim') }}"
                                   required
                                   class="border border-gray-300 rounded-md w-full mb-2 p-2">
                            @error('nim')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prodi" class="sr-only">Prodi</label>
                            <input id="prodi" type="text" name="prodi" placeholder="Prodi"
                                   value="{{ old('prodi') }}"
                                   required
                                   class="border border-gray-300 rounded-md w-full mb-2 p-2">
                            @error('prodi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>

            {{-- ===== List Mahasiswa ===== --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">List Mahasiswa</h3>

                    <table class="table-auth w-full border">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="border px-4 py-2 w-16 text-center">No</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">NIM</th>
                                <th class="border px-4 py-2">Prodi</th>
                                <th class="border px-4 py-2 w-32 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $mhs)
                                <tr>
                                    <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $mhs->nama }}</td>
                                    <td class="border px-4 py-2">{{ $mhs->nim }}</td>
                                    <td class="border px-4 py-2">{{ $mhs->prodi }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                           class="inline-block px-3 py-1 bg-yellow-500 text-white rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Hapus data ini?')"
                                                    class="px-3 py-1 bg-red-600 text-white rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada data mahasiswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Jika $data paginated --}}
                    @if(method_exists($data, 'links'))
                        <div class="mt-4">
                            {{ $data->links() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

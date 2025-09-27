<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- ====== Form Tambah Mahasiswa ====== --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-lg mb-4">Tambah Mahasiswa</h3>
                           <from method="POST" action="{{ route('mahasiswa.store') }}">
                            @csrf
                            <input type="text" name="nama" placeholder="Nama" 
                                    class="border-gray-300 rounded-md w-full">
                            <input type="text" name="nim" placeholder="NIM" 
                                    class="border-gray-300 rounded-md w-full">
                            <button type="submit" class="py-4 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>

                {{-- ====== List Mahasiswa ====== --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-lg mb-4">List Mahasiswa</h3>
                        <table class="table-auth w-full border">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="border px-4 py-2">Nama</th>
                                    <th class="border px-4 py-2">NIM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $mhs)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $mhs->nama }}</td>
                                        <td class="border px-4 py-2">{{ $mhs->nim }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
                        
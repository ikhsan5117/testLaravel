<x-app-layout>
    <h2 class="text-2xl font-semibold mb-6 border-b pb-3">
        Detail eKYC {{ $data->user->name ?? '-' }}
    </h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Status Information --}}
    @if(in_array($data->status, ['accepted', 'rejected']))
        <div class="mb-6 {{ $data->status === 'accepted' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    @if($data->status === 'accepted')
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium {{ $data->status === 'accepted' ? 'text-green-800' : 'text-red-800' }}">
                        Registration {{ ucfirst($data->status) }}
                    </h3>
                    <div class="mt-2 text-sm {{ $data->status === 'accepted' ? 'text-green-700' : 'text-red-700' }}">
                        <p>This E-KYC registration has been {{ $data->status === 'accepted' ? 'approved' : 'rejected' }} by the administrator.</p>
                        @if($data->updated_at)
                            <p class="mt-1">Processed on: {{ $data->updated_at->format('d M Y \a\t H:i') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ================ Data Pribadi ================ --}}
    <section>
        <h3 class="text-lg font-semibold mb-4"> Data Pribadi</h3>
        <div class="space-y-3">
            @foreach ([
                'Nama Lengkap' => $data->nama,
                'NIK' => $data->nik,
                'Tanggal Lahir' => $data->tanggal_lahir,
                'Alamat' => $data->alamat
            ] as $label => $value)
                <div class="flex items-start">
                    <label class="w-48 text-sm font-medium text-gray-700 mt-1">{{ $label }}</label>
                    @if (Str::contains(strtolower($label), 'alamat'))
                        <textarea rows="2" readonly class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">{{ $value }}</textarea>
                    @else
                        <input type="text" readonly value="{{ $value }}" class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================ Data Pendidikan ================ --}}
    <section class="mt-8 border-t pt-6">
        <h3 class="text-lg font-semibold mb-4"> Data Pendidikan</h3>
        <div class="space-y-3">
            @foreach ([
                'Asal SD' => $data->asal_sd,
                'Asal SMP' => $data->asal_smp,
                'Asal SMA' => $data->asal_sma
            ] as $label => $value)
                <div class="flex items-start">
                    <label class="w-48 text-sm font-medium text-gray-700 mt-1">{{ $label }}</label>
                    <input type="text" readonly value="{{ $value }}" class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================ Dokumen eKYC ================ --}}
    <section class="mt-8 border-t pt-6">
        <h3 class="text-lg font-semibold mb-4"> Dokumen eKYC</h3>
        <div class="flex flex-wrap gap-6">
            @foreach ([
                'file_ktp' => 'KTP',
                'file_selfie' => 'Selfie',
                'file_kk' => 'Kartu Keluarga',
                'file_ijazah' => 'Ijazah'
            ] as $field => $label)
                @if ($data->$field)
                    <div class="flex flex-col items-center w-[110px]">
                        <p class="text-xs font-medium mb-1">{{ $label }}</p>
                        <a href="{{ asset('storage/'.$data->$field) }}" target="_blank">
                            <img src="{{ asset('storage/'.$data->$field) }}" class="w-[90px] h-[70px] object-cover border rounded-md shadow-sm hover:shadow-lg transition">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    

    {{-- ================ Alamat Domisili ================ --}}
    <section class="mt-8 border-t pt-6">
        <h3 class="text-lg font-semibold mb-4"> Alamat Domisili</h3>
        <div class="space-y-3">
            @foreach ([
                'Alamat Domisili' => $data->alamat_domisili,
                'Provinsi' => $data->provinsi,
                'Kota/Kabupaten' => $data->kota_kabupaten,
                'Kecamatan' => $data->kecamatan,
                'Kode Pos' => $data->kode_pos,
                'Nama Ibu Kandung' => $data->nama_ibu_kandung,
                'Referensi Sumber' => $data->sumber_informasi
            ] as $label => $value)
                <div class="flex items-start">
                    <label class="w-48 text-sm font-medium text-gray-700 mt-1">{{ $label }}</label>
                    @if (Str::contains(strtolower($label), 'alamat'))
                        <textarea rows="2" readonly class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">{{ $value }}</textarea>
                    @else
                        <input type="text" readonly value="{{ $value }}" class="flex-1 border border-gray-300 rounded-md p-2 text-sm bg-gray-50">
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================ Status Verifikasi ================ --}}
    <section class="mt-10 border-t pt-6">
        <h3 class="text-lg font-semibold mb-4"> Status Verifikasi</h3>
        <form action="{{ route('admin.ekyc.verify', $data->id) }}" method="POST" class="flex items-center gap-4">
            @csrf
            <label class="w-48 text-sm font-medium text-gray-700">Ubah Status</label>
            <select name="status" class="flex-1 border border-gray-300 rounded-md p-2 text-sm">
                <option value="accepted" {{ $data->status == 'accepted' ? 'selected' : '' }}> Diterima</option>
                <option value="submitted" {{ $data->status == 'submitted' ? 'selected' : '' }}> Menunggu Verifikasi</option>
                <option value="draft" {{ $data->status == 'draft' ? 'selected' : '' }}> Draft</option>
                <option value="rejected" {{ $data->status == 'rejected' ? 'selected' : '' }}> ❌ Ditolak</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                Simpan
            </button>
            <a href="{{ route('admin.ekyc.index') }}" class="text-sm text-gray-600 hover:underline ml-auto">
                Kembali
            </a>
        </form>
    </section>

</x-app-layout>

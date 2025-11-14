<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkycRegistration;
use Illuminate\Support\Facades\Auth;

class EkycController extends Controller
{
    public function index()
    {
        // Only allow admin to access
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $ekycRegistrations = EkycRegistration::with('user')->latest()->paginate(10);

        return view('ekyc.index', compact('ekycRegistrations'));
    }

    public function create()
    {
        // Only allow admin to access
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('ekyc.create');
    }

    public function store(Request $request)
    {
        // Only allow admin to access
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:ekyc_registrations,nik',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'file_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_ijazah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'asal_sd' => 'nullable|string|max:255',
            'asal_smp' => 'nullable|string|max:255',
            'asal_sma' => 'nullable|string|max:255',
            'alamat_domisili' => 'required|string',
            'provinsi' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:6',
            'nama_ibu_kandung' => 'required|string|max:255',
            'sumber_informasi' => 'required|in:sosmed,kerabat,informasi_kampus',
        ]);

        // Handle file uploads
        $filePaths = [];
        $files = ['file_ktp', 'file_kk', 'file_ijazah', 'file_selfie'];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $filePaths[$file] = $request->file($file)->store('ekyc', 'public');
            }
        }

        // Create E-KYC registration
        EkycRegistration::create([
            'user_id' => Auth::id(), // Admin creating it
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'file_ktp' => $filePaths['file_ktp'] ?? null,
            'file_kk' => $filePaths['file_kk'] ?? null,
            'file_ijazah' => $filePaths['file_ijazah'] ?? null,
            'file_selfie' => $filePaths['file_selfie'] ?? null,
            'asal_sd' => $request->asal_sd,
            'asal_smp' => $request->asal_smp,
            'asal_sma' => $request->asal_sma,
            'alamat_domisili' => $request->alamat_domisili,
            'provinsi' => $request->provinsi,
            'kota_kabupaten' => $request->kota_kabupaten,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'nama_ibu_kandung' => $request->nama_ibu_kandung,
            'sumber_informasi' => $request->sumber_informasi,
            'status' => 'submitted', // Admin created, mark as submitted
        ]);

        return redirect()->route('ekyc.index')->with('success', 'E-KYC registration berhasil dibuat!');
    }

    public function step1()
    {
        // Ambil data draft user jika sudah ada
        $ekyc = EkycRegistration::where('user_id', Auth::id())
                            // ->where('status', 'draft')
                            ->first();

        // Simpan session agar bisa lanjut ke step berikutnya
        if ($ekyc) {
            session(['ekyc_id' => $ekyc->id]);
        }

        return view('ekyc.step1', compact('ekyc'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:ekyc_registrations,nik',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        $ekyc = EkycRegistration::where('user_id', Auth::id())->first();

        if (!$ekyc) {
            $ekyc = new EkycRegistration();
            $ekyc->user_id = Auth::id();
        }

        $ekyc->nama = $request->nama;
        $ekyc->nik = $request->nik;
        $ekyc->tanggal_lahir = $request->tanggal_lahir;
        $ekyc->alamat = $request->alamat;
        $ekyc->status = 'draft';
        $ekyc->save();

        return redirect()->route('ekyc.step2');
    }

    public function step2()
    {
        $data = EkycRegistration::where('user_id', Auth::id())->first();
        return view('ekyc.step2', compact('data'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'file_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = EkycRegistration::where('user_id', Auth::id())->first();

        if (!$data) {
            return redirect()->route('ekyc.step1')->with('error', 'Lengkapi step 1 terlebih dahulu');
        }

        // Handle file uploads
        if ($request->hasFile('file_ktp')) {
            $data->file_ktp = $request->file('file_ktp')->store('ekyc', 'public');
        }

        if ($request->hasFile('file_selfie')) {
            $data->file_selfie = $request->file('file_selfie')->store('ekyc', 'public');
        }

        $data->save();

        return redirect()->route('ekyc.step3');
    }

    public function showStep3()
    {
        $data = \App\Models\EkycRegistration::where('user_id', Auth::id())->first();
        return view('ekyc.step3', compact('data'));
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'asal_sd' => 'nullable|string|max:255',
            'asal_smp' => 'nullable|string|max:255',
            'asal_sma' => 'nullable|string|max:255',
            'file_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_ijazah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = EkycRegistration::where('user_id', Auth::id())->first();

        if (!$data) {
            return redirect()->route('ekyc.step1')->with('error', 'Lengkapi step 1 terlebih dahulu');
        }

        $data->asal_sd = $request->asal_sd;
        $data->asal_smp = $request->asal_smp;
        $data->asal_sma = $request->asal_sma;

        // Handle file uploads
        if ($request->hasFile('file_kk')) {
            $data->file_kk = $request->file('file_kk')->store('ekyc', 'public');
        }

        if ($request->hasFile('file_ijazah')) {
            $data->file_ijazah = $request->file('file_ijazah')->store('ekyc', 'public');
        }

        $data->save();

        return redirect()->route('ekyc.step4');
    }

    public function showStep4()
    {
        $data = \App\Models\EkycRegistration::where('user_id', Auth::id())->first();
        return view('ekyc.step4', compact('data'));
    }

    public function storeStep4(Request $request)
    {
        $request->validate([
            'alamat_domisili' => 'required|string',
            'provinsi' => 'required|string',
            'kota_kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kode_pos' => 'required|string|max:6',
            'nama_ibu_kandung' => 'required|string|max:255',
            'sumber_informasi' => 'required|in:sosmed,kerabat,informasi_kampus',
        ]);

        $data = \App\Models\EkycRegistration::where('user_id', Auth::id())->first();

        $data->alamat_domisili = $request->alamat_domisili;
        $data->provinsi = $request->provinsi;
        $data->kota_kabupaten = $request->kota_kabupaten;
        $data->kecamatan = $request->kecamatan;
        $data->kode_pos = $request->kode_pos;
        $data->nama_ibu_kandung = $request->nama_ibu_kandung;
        $data->sumber_informasi = $request->sumber_informasi;

            $data->status = 'submitted';
            $data->save();
        
        return redirect()->route('ekyc.step5')->with('success', 'Registrasi aKYC Anda telah selesai!');
    }

    public function step5()
    {
        $data = EkycRegistration::where('user_id', Auth::id())->first();
        if (!$data) {
            return redirect()->route('ekyc.step1')->with('error', 'Data eKYC tidak ditemukan');
        }

        //Pastikan hanya user dengan status yang bisa melihat halaman ini
        if ($data->status !== 'submitted') {
            return redirect()->route('ekyc.step4')->with('error', 'Lengkapi langkah sebelumnya terlebih dahulu sebelum menyelesaikan eKYC');
    }
        return view('ekyc.step5', compact('data'));
    }
}
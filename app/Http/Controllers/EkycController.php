<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkycRegistration;
use Illuminate\Support\Facades\Auth;

class EkycController extends Controller
{
    public function step1()
    {
        // Ambil data draft user jika sudah ada
        $ekyc = EkycRegistration::where('user_id', Auth::id())
                            ->where('status', 'draft')
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
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        $ekyc = EkycRegistration::updateOrCreate(
            [
                'id' => session('ekyc_id'), 
                'user_id' => Auth::id(),
            ],
            [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'status' => 'draft',
            ]
        );

        // Simpan ID E-KYC di session
        session(['ekyc_id' => $ekyc->id]);

        return redirect()->route('ekyc.step2')->with('success', 'Data pribadi disimpan, Silakan lanjut ke langkah berikutnya.');
    }

    public function step2()
    {
        $data = EkycRegistration::where('user_id', auth()->id())->first();
        return view('ekyc.step2', compact('data'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'file_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'file_selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $ekyc = EkycRegistration::firstOrCreate(['user_id' => auth()->id()]);

        if ($request->hasFile('file_ktp')) {
           $validated['file_ktp'] = $request->file('file_ktp')->store('ekyc', 'public');
        }

        if ($request->hasFile('file_selfie')) {
            $validated['file_selfie'] = $request->file('file_selfie')->store('ekyc', 'public');
        }

        $ekyc->update($validated);

        return redirect()->route('ekyc.step3')->with('success', 'Step 2 tersimpan.');
        // return back()->with('success', 'Data tersimpan.');
    }

    public function showStep3()
    {
        $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();
        return view('ekyc.step3', compact('data'));
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'asal_sd' => 'nullable|string|max:255',
            'asal_smp' => 'nullable|string|max:255',
            'asal_sma' => 'nullable|string|max:255',
            'file_kk' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'file_ijazah' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();

        $data->asal_sd = $request->asal_sd;
        $data->asal_smp = $request->asal_smp;
        $data->asal_sma = $request->asal_sma;

        if ($request->hasFile('file_kk')) {
            $data->file_kk = $request->file('file_kk')->store('ekyc', 'public');
        }

        if ($request->hasFile('file_ijazah')) {
            $data->file_ijazah = $request->file('file_ijazah')->store('ekyc', 'public');
        }

        $data->save();

        return redirect()->route('ekyc.step4')->with('success', 'Data pendidikan berhasil tersimpan, silakan lanjut ke langkah berikutnya.');
    }

    public function showStep4()
    {
        $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();
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

        $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();

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
        $data = EkycRegistration::where('user_id', auth()->id())->first();
        if (!$data) {
            return redirect()->route('ekyc.step1')->with('error', 'Data eKYC tidak ditemukan');
        }

        //Pastikan hanya user dengan status yang bisa melihat halaman ini
        if ($data->status !== 'submitted') {
            return redirect()->route('ekyc.step4')->with('error', 'Lengkapi langkah sebelumnya terlebih dahulu sebelum menyelesaikan eKYC');
    }a
        return view('ekyc.step5', compact('data'));
    }
}
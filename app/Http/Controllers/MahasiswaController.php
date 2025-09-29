<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // Menampilkan daftar mahasiswa
    public function index()
    {
        $data = Mahasiswa::all();
        return view('mahasiswa.index', compact('data'));
    }

    // Menyimpan mahasiswa baru
    public function store(Request $request)
    {
        Mahasiswa::create($request->only('nama','nim','prodi'));

        return redirect()->back()->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // Menampilkan form edit mahasiswa
    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'prodi' => 'required',
        ]);
        $mhs = Mahasiswa::findOrFail($id);

        $mhs->update($request->only('nama','nim','prodi'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // Menghapus mahasiswa
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}

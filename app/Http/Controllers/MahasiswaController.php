<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    // Menampilkan daftar mahasiswa
    public function index()
    {
        $data = Mahasiswa::all();
        return view('mahasiswa.index', compact('data'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }


    // Menyimpan mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim',
            'prodi' => 'required',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->back()->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mhs'));
    }


    // Menampilkan form edit mahasiswa
    public function edit(string $id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, string $id)
    {

        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'prodi' => 'required',
        ]);
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update($request->all());

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // Menghapus mahasiswa
    public function destroy(string $id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}

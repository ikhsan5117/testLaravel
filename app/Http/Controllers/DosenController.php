<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Tampilkan daftar dosen.
     */
    public function index()
    {
        $data = Dosen::all();
        return view('dosen.index', compact('data'));
    }

    /**
     * Simpan dosen baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nidn'  => 'required|string|max:50|unique:dosens,nidn',
            'email' => 'required|email|unique:dosens,email',
            'telepon' => 'nullable|string|max:20',
        ]);

        Dosen::create($request->only(['nama','nidn','email','telepon']));

        return redirect()->route('dosen.index')
                         ->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Form edit dosen.
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update data dosen.
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'nidn'  => 'required|string|max:50|unique:dosens,nidn,' . $dosen->id,
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'telepon' => 'nullable|string|max:20',
        ]);

        $dosen->update($request->only(['nama','nidn','email','telepon']));

        return redirect()->route('dosen.index')
                         ->with('success', 'Data dosen berhasil diupdate.');
    }

    /**
     * Hapus dosen.
     */
    public function destroy($id)
    {
        Dosen::destroy($id);
        return redirect()->route('dosen.index')
                         ->with('success', 'Dosen berhasil dihapus.');
    }
}
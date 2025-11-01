<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::all();
        return view('matkul.index', compact('matkuls'));
    }

    public function create()
    {
        return view('matkul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'kode_matkul' => 'required|string|max:10|unique:matkuls',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        Matkul::create($request->all());

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(Matkul $matkul)
    {
        return view('matkul.show', compact('matkul'));
    }

    public function edit(Matkul $matkul)
    {
        return view('matkul.edit', compact('matkul'));
    }

    public function update(Request $request, Matkul $matkul)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'kode_matkul' => 'required|string|max:10|unique:matkuls,kode_matkul,' . $matkul->id,
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $matkul->update($request->all());

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}

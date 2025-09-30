<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Redirect;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosens,nidn',
            'email' => 'nullable|email|max:255|unique:dosens,email',
            'telepon' => 'nullable|string|max:15',
        ]);

        Dosen::create($request->all());
        return redirect()->route('dosen.index')
                         ->with('success', 'Dosen berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.show', compact('dosen'));
    }

    public function edit(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosens,nidn,' . $dosen->id,
            'email' => 'nullable|email|max:255|unique:dosens,email,' . $dosen->id,
            'telepon' => 'nullable|string|max:15',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());

        return redirect()->route('dosen.index')
                         ->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.index')
                         ->with('success', 'Dosen berhasil dihapus.');
    }

}

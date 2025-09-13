<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    public function index() 
    {
        $data = Mahasiswa::all();
        return view('mahasiswa.index', compact('data'));
    }

    public function store(Request $request) 
    {
        // dd($request->nim); // ini buat debug, bisa dihapus kalau sudah oke
        Mahasiswa::create($request->only('nama','nim', 'prodi', 'ruangan'));
        return redirect()->back();
    }
}

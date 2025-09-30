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

    public function store(Request $request)
    {
        Dosen::create($request->only('nama','nidn','email','telepon'));
        return redirect()->back();
    }
}

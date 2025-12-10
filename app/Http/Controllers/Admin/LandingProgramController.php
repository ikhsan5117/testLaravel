<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingProgram;
use Illuminate\Http\Request;

class LandingProgramController extends Controller
{
    public function index(Request $request)
    {
        // Handle POST requests for updates (when form submits to index route)
        if ($request->isMethod('post') && $request->has('id')) {
            return $this->update($request, $request->id);
        }

        $programs = LandingProgram::orderBy('position')->get();
        return view('admin.landing.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.landing.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
            'position' => 'required|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/programs', 'public');
        }

        LandingProgram::create($data);

        return redirect()->route('admin.landing.programs.index')->with('success', 'Program added');
    }

    public function edit($id)
    {
        $program = LandingProgram::findOrFail($id);
        return view('admin.landing.program.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = LandingProgram::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
            'position' => 'required|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/programs', 'public');
        }

        $program->update($data);

        return redirect()->route('admin.landing.programs.index')->with('success', 'Program updated');
    }

    public function destroy($id)
    {
        LandingProgram::destroy($id);

        return back()->with('success', 'Program removed');
    }
}

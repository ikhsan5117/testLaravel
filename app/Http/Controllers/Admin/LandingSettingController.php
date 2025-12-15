<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{

    public function index()
    {
        $settings = LandingSetting::orderBy('key')->get();
        return view('admin.landing.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'type' => 'required|string|in:text,image,url,json',
            'value' => 'nullable',
            'status' => 'required|boolean'
        ]);

        $value = $request->value;

        if ($request->type === 'image' && $request->hasFile('value')) {
            $value = $request->file('value')->store('landing', 'public');
        }

        LandingSetting::create([
            'key' => $request->key,
            'value' => $value,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.landing.settings.index')->with('success', 'Setting created successfully');
    }

    public function edit($id)
    {
        $setting = LandingSetting::findOrFail($id);
        return view('admin.landing.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = LandingSetting::findOrFail($id);

        $request->validate([
            'key' => 'required|string',
            'type' => 'required|string|in:text,image,url,json',
            'value' => 'nullable',
            'status' => 'required|boolean'
        ]);

        $value = $request->value;

        if ($request->type === 'image' && $request->hasFile('value')) {
            $value = $request->file('value')->store('landing', 'public');
        }

        $setting->update([
            'key' => $request->key,
            'value' => $value,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.landing.settings.index')->with('success', 'Setting updated successfully');
    }
}
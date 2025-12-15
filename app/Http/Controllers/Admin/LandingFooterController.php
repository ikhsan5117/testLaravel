<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingFooterLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingFooterController extends Controller
{
/**
* Display a listing of the footer links.
*/
public function index()
{
$links = LandingFooterLink::orderBy('position')->get();
return view('admin.landing.footer.index', compact('links'));
}

/**
* Show form to create a new footer link.
*/
public function create()
{
return view('admin.landing.footer.create');
}

/**
* Store new footer link..
*/
public function store(Request $request)
{
$request->validate([
'label' => 'required|string|max:100',
'url' => 'nullable|string|max:255',
'position' => 'nullable|integer|min:1',
'group' => 'nullable|string|max:50',
'status' => 'required|boolean'
]);

$position = $request->position ?? (LandingFooterLink::max('position') + 1);

LandingFooterLink::create([
'label' => $request->label,
'url' => $request->url,
'position' => $position,
'group' => $request->group,
'status' => $request->status,
]);

return redirect()->route('admin.landing.footer.index')
->with('success', 'Footer link berhasil ditambahkan.');
}

/**
 * Show form to edit a footer link.
 */
public function edit($id)
{
    $footer = LandingFooterLink::findOrFail($id);
    return view('admin.landing.footer.edit', compact('footer'));
}

/**
 * Update footer link.
 */
public function update(Request $request, $id)
{
    $request->validate([
        'label' => 'required|string|max:100',
        'url' => 'nullable|string|max:255',
        'position' => 'required|integer|min:1',
        'group' => 'nullable|string|max:50',
        'status' => 'required|boolean',
    ]);

    $footer = LandingFooterLink::findOrFail($id);
    $footer->update([
        'label' => $request->label,
        'url' => $request->url,
        'position' => $request->position,
        'group' => $request->group,
        'status' => $request->status,
    ]);

    // Clear cache
    Cache::forget('landing_footer');

    return redirect()->route('admin.landing.footer.index')
        ->with('success', 'Footer link berhasil diperbarui.');
}

/**
 * Delete footer link.
 */
public function destroy($id)
{
    $footer = LandingFooterLink::findOrFail($id);
    $footer->delete();

    return redirect()->route('admin.landing.footer.index')
        ->with('success', 'Footer link berhasil dihapus.');
}

/**
 * Reorder footer links.
 */
public function reorder(Request $request)
{
    $ids = $request->input('ids', []);
    foreach ($ids as $position => $id) {
        LandingFooterLink::where('id', $id)->update(['position' => $position + 1]);
    }

    return response()->json(['success' => true]);
}

/**
 * Toggle status of footer link.
 */
public function toggleStatus($id)
{
    $footer = LandingFooterLink::findOrFail($id);
    $footer->status = !$footer->status;
    $footer->save();

    return response()->json(['success' => true, 'status' => $footer->status]);
}
}

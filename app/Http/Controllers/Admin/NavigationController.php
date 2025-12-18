<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Navigation;
use App\Models\PageType;

class NavigationController extends Controller
{
    /**
     * List all navigations (parents and children)
     */
    public function index(Request $request)
    {
        $parentId = $request->get('parent', 0);

        $navigations = Navigation::withCount('children')
            ->with('pageType')
            ->where('parent_id', $parentId)
            ->orderBy('position')
            ->get();

        $parent = null;

        if ($parentId != 0) {
            $parent = Navigation::findOrFail($parentId);
        }

        return view('admin.navigations.index', compact(
            'navigations',
            'parent'
        ));
    }



    public function create()
    {
        $parents = Navigation::where('parent_id', 0)->get();
        $pageTypes = PageType::all();
        return view('admin.navigations.create', compact('parents', 'pageTypes'));
    }

    /**
     * Store new navigation
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:navigations,slug',
            'parent_id' => 'nullable|integer',
            'position'  => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'page_type_id' => 'nullable|exists:page_types,id',
        ]);

        Navigation::create($request->all());

        return redirect()->route('admin.navigations.index')->with('success', 'Navigation created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Navigation $navigation)
    {
        $parents = Navigation::where('parent_id', 0)->where('id', '!=', $navigation->id)->get();
        $pageTypes = PageType::all();
        return view('admin.navigations.edit', compact('navigation', 'parents', 'pageTypes'));
    }

    /**
     * Update navigation
     */
    public function update(Request $request, Navigation $navigation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:navigations,slug,' . $navigation->id,
            'parent_id' => 'nullable|integer',
            'position'  => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'page_type_id' => 'nullable|exists:page_types,id',
        ]);

        $navigation->update($request->all());

        return redirect()->route('admin.navigations.index')->with('success', 'Navigation updated successfully.');
    }

    /**
     * Delete navigation
     */
    public function destroy(Navigation $navigation)
    {
        // Optional: delete children too
        $navigation->children()->delete();
        $navigation->delete();

        return redirect()->route('admin.navigations.index')->with('success', 'Navigation deleted successfully.');
    }
}

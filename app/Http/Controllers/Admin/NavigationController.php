<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Models\PageType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NavigationController extends Controller
{
    public function index(Request $request)
    {
        $parentId = $request->get('parent', 0);

        $navigations = Navigation::withCount('children')
            ->with('pageType')
            ->where('parent_id', $parentId)
            ->orderBy('position')
            ->get();

        $parent = $parentId ? Navigation::find($parentId) : null;

        return view('admin.navigations.index', compact('navigations', 'parent'));
    }

    /**
     * Show the form for creating a new navigation.
     */
    public function create(Request $request)
    {
        $parentId = $request->get('parent', 0);
        $parent = $parentId ? Navigation::find($parentId) : null;

        $allNavigations = Navigation::orderBy('title')->get(); // for parent dropdown
        $pageTypes = PageType::all();

        // Calculate next position
        $nextPosition = Navigation::where('parent_id', $parentId)->max('position') + 1 ?? 1;

        return view('admin.navigations.create', compact('parent', 'allNavigations', 'pageTypes', 'nextPosition'));
    }

    /**
     * Store a newly created navigation in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:navigations,slug',
            'short_content' => 'nullable|string',
            'main_content' => 'nullable|string',
            'parent_id' => 'required|integer',
            'position' => 'required|integer',
            'is_active' => 'required|boolean',
            'page_type_id' => 'required|exists:page_types,id',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        Navigation::create($validated);

        return redirect()->route('admin.navigations.index', ['parent' => $validated['parent_id']])
            ->with('success', 'Navigation created successfully.');
    }

    /**
     * EDIT - Show edit form
     */
    public function edit(Navigation $navigation)
    {
        $pageTypes = PageType::where('is_active', 1)->get();

        // For parent selection: only top-level navigations except current
        $parents = Navigation::where('id', '!=', $navigation->id)
            ->get();

        return view('admin.navigations.edit', compact('navigation', 'pageTypes', 'parents'));
    }

    /**
     * UPDATE - Save changes
     */
    public function update(Request $request, Navigation $navigation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'required|integer',
            'page_type_id' => 'nullable|integer|exists:page_types,id',
            'is_active' => 'required|boolean',
            'short_content' => 'nullable|string',
            'main_content' => 'nullable|string',
        ]);

        $navigation->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'parent_id' => $request->parent_id,
            'page_type_id' => $request->page_type_id,
            'short_content' => $request->short_content,
            'main_content' => $request->main_content,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admin.navigations.index', ['parent' => $request->parent_id])
            ->with('success', 'Navigation updated successfully.');
    }

    /**
     * DESTROY
     */
    public function destroy(Navigation $navigation)
    {
        $parentId = $navigation->parent_id;

        // Delete children first
        $navigation->children()->delete();

        $navigation->delete();

        return redirect()
            ->route('admin.navigations.index', ['parent' => $parentId])
            ->with('success', 'Navigation deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Category',
            'categories' => Category::latest()->get()
        ];

        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create Category',
        ];

        return view('category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'icon' => 'required|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);
        $validated['icon'] = $request->file('icon')->store('category', 'public');
        $validated['slug'] = Str::slug($request->name);
        Category::create($validated);
        return redirect()->route('category.index')->with('success', successCreateMessage());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = [
            'title' => 'Edit Category',
            'category' => $category
        ];

        return view('category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' .  $category->id,
            'icon' => 'sometimes|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);

        if ($request->file('icon')) {
            $path = $request->file('icon')->store('category', 'public');
            $validated['icon'] = $path;
            if ($category->icon) {
                if (Storage::disk('public')->exists($category->icon)) {
                    Storage::disk('public')->delete($category->icon);
                }
            }
        }

        $validated['slug'] = Str::slug($request->name);
        $category->update($validated);
        return redirect()->route('category.index')->with('success', successUpdateMessage());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        if ($category->icon) {
            if (Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
        }
        return redirect()->route('category.index')->with('success', successDeleteMessage());
    }
}

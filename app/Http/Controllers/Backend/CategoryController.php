<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $categories = Category::latest()->get();
        return view('backend.pages.category.index', compact('categories'));
    }

    public function create()
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        return view('backend.pages.category.create');
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = uniqid() . '.' . $extension;
            $image->move(public_path('backend/categories'), $imageName);
            $validated['image'] = 'backend/categories/' . $imageName;
        }

        Category::create($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        return view('backend.pages.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = uniqid() . '.' . $extension;

            $image->move(public_path('backend/categories'), $imageName);

            $validated['image'] = 'backend/categories/' . $imageName;
        }

        $category->update($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }

    /**
     * ALL ACTIVE CATEGORIES
     */
    public function allCategories()
    {
        $categories = Category::where('is_active', 1)
            ->select('id','name','slug','image','description')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
    }
}

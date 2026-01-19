<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->get();
        return view('backend.pages.subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('backend.pages.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:subcategories,name',
            'image' => 'nullable|image',
        ]);

        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->description = $request->description;
        $subcategory->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subcategories', 'public');
            $subcategory->image = $imagePath;
        }

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::where('is_active', true)->get();
        return view('backend.pages.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:subcategories,name,' . $subcategory->id,
            'image' => 'nullable|image',
        ]);

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->description = $request->description;
        $subcategory->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subcategories', 'public');
            $subcategory->image = $imagePath;
        }

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->back()->with('success', 'Subcategory deleted.');
    }
}

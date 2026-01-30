<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyTypeController extends Controller
{
    public function index()
    {
        $propertytype = PropertyType::latest()->get();
        return view('backend.pages.propertytype.index', compact('propertytype'));
    }

    public function create()
    {
        return view('backend.pages.propertytype.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:property_types,name',
        ]);

        $propertytype = new PropertyType();
        $propertytype->name = $request->name;
        $propertytype->slug = Str::slug($request->name);
        $propertytype->is_active = $request->has('is_active');

        $propertytype->save();

        return redirect()->route('admin.propertytype.index')->with('success', 'Property Type created successfully.');
    }

    public function edit(PropertyType $propertytype)
    {
        return view('backend.pages.propertytype.edit', compact('propertytype'));
    }

    public function update(Request $request, PropertyType $propertytype)
    {
        $request->validate([
            'name' => 'required|unique:property_types,name,' . $propertytype->id,
        ]);

        $propertytype->name = $request->name;
        $propertytype->slug = Str::slug($request->name);
        $propertytype->is_active = $request->has('is_active');

        $propertytype->save();

        return redirect()->route('admin.propertytype.index')->with('success', 'Property Type updated successfully.');
    }

    public function destroy(PropertyType $propertytype)
    {
        $propertytype->delete();
        return redirect()->back()->with('success', 'Property Type deleted.');
    }
}

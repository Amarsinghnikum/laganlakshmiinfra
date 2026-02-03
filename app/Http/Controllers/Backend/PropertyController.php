<?php

namespace App\Http\Controllers\Backend;

use App\Models\Property;
use App\Models\Category;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index()
    {
        // $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $properties = Property::with(['category'])
            ->latest('created_at')
            ->get();
        return view('backend.pages.properties.index', compact('properties'));
    }

    public function getPropertytypes(Request $request)
    {
        $propertytypes = PropertyType::whereIn('category_id', $request->category_ids)->get();

        return response()->json($propertytypes);
    }

    public function create()
    {
        // $this->checkAuthorization(auth()->user(), ['dashboard.view']);

        $categories = Category::all();

        $property = new \stdClass();
        $property->category_id = [];
        $property->_id = [];

        $propertyTypes = PropertyType::all();

        return view('backend.pages.properties.create', compact('categories', 'property', 'propertyTypes'));
    }

    public function store(Request $request)
    {
        try {
            // $this->checkAuthorization(auth()->user(), ['dashboard.view']);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'property_for' => 'required|in:sell,rent',
                'property_type_id' => 'required|exists:property_types,id',
                'price' => 'required|numeric|min:0',
                'area_sqft' => 'nullable|numeric|min:0',
                'bedrooms' => 'nullable|integer|min:0',
                'bathrooms' => 'nullable|integer|min:0',
                'balconies' => 'nullable|integer|min:0',
                'floor' => 'nullable|integer|min:0',
                'total_floors' => 'nullable|integer|min:0',
                'property_age' => 'nullable|integer|min:0',
                'furnishing_status' => 'nullable|in:unfurnished,semi-furnished,fully-furnished',
                'facing' => 'nullable|in:north,south,east,west',
                'availability_status' => 'nullable|in:available,sold,rented',
                'status' => 'nullable|in:pending,approved,rejected',
                'description' => 'nullable|string',
                'main_image' => 'nullable|image|max:20480',
                'gallery_images.*' => 'nullable|image|max:20480',
            ]);

            $validated['is_active'] = $request->has('is_active');

            if ($request->hasFile('catalogue_pdf')) {
                $file = $request->file('catalogue_pdf');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/properties/pdfs'), $filename);
                $validated['catalogue_pdf'] = 'backend/properties/pdfs/' . $filename;
            }

            if ($request->hasFile('main_image')) {
                $image = $request->file('main_image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('backend/properties'), $filename);
                $validated['main_image'] = 'backend/properties/' . $filename;
            }

            if ($request->hasFile('gallery_images')) {
                $gallery = [];
                foreach ($request->file('gallery_images') as $image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('backend/properties/gallery'), $filename);
                    $gallery[] = 'backend/properties/gallery/' . $filename;
                }
                $validated['gallery_images'] = json_encode($gallery);
            }

            Property::create($validated);

            return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            dd('Error: ' . $e->getMessage());
        }
    }

    public function edit(Property $property)
    {
        // $this->checkAuthorization(auth()->user(), ['dashboard.view']);

        $categories = Category::all();
        $propertytypes = PropertyType::all();

        return view('backend.pages.properties.edit', compact('property', 'categories', 'propertytypes'));
    }

    public function update(Request $request, Property $property)
    {
        try {
            // $this->checkAuthorization(auth()->user(), ['dashboard.view']);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'property_for' => 'required|in:sell,rent',
                'property_type_id' => 'required|exists:property_types,id',
                'price' => 'required|numeric|min:0',
                'area_sqft' => 'nullable|numeric|min:0',
                'bedrooms' => 'nullable|integer|min:0',
                'bathrooms' => 'nullable|integer|min:0',
                'balconies' => 'nullable|integer|min:0',
                'floor' => 'nullable|integer|min:0',
                'total_floors' => 'nullable|integer|min:0',
                'property_age' => 'nullable|integer|min:0',
                'furnishing_status' => 'nullable|in:unfurnished,semi-furnished,fully-furnished',
                'facing' => 'nullable|in:north,south,east,west',
                'availability_status' => 'nullable|in:available,sold,rented',
                'status' => 'nullable|in:pending,approved,rejected',
                'description' => 'nullable|string',
                'main_image' => 'nullable|image|max:20480',
                'gallery_images.*' => 'nullable|image|max:20480',
            ]);

            $validated['is_active'] = $request->has('is_active');

            if ($request->hasFile('catalogue_pdf')) {
                $file = $request->file('catalogue_pdf');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('backend/properties/pdfs'), $filename);
                $validated['catalogue_pdf'] = 'backend/properties/pdfs/' . $filename;
            } else {
                $validated['catalogue_pdf'] = $property->catalogue_pdf;
            }

            if ($request->hasFile('main_image')) {
                $image = $request->file('main_image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('backend/properties'), $filename);
                $validated['main_image'] = 'backend/properties/' . $filename;
            } else {
                $validated['main_image'] = $property->main_image;
            }

            if ($request->hasFile('gallery_images')) {
                $gallery = [];
                foreach ($request->file('gallery_images') as $image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('backend/properties/gallery'), $filename);
                    $gallery[] = 'backend/properties/gallery/' . $filename;
                }
                $validated['gallery_images'] = json_encode($gallery);
            } else {
                $validated['gallery_images'] = $property->gallery_images;
            }

            $property->update($validated);

            return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            dd('Error: ' . $e->getMessage());
        }
    }

    protected function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Property::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    protected function generateUniqueSku($sku)
    {
        $sku = strtoupper(Str::slug($sku));
        $originalSku = $sku;
        $count = 1;

        while (Property::where('sku', $sku)->exists()) {
            $sku = $originalSku . '-' . $count;
            $count++;
        }

        return $sku;
    }

    public function destroy(Property $property)
    {
        // $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $property->delete();
        return back()->with('success', 'Property deleted.');
    }

    public function details($slug)
    {
        $property = Property::where('slug', $slug)->firstOrFail();
        $categoryIds = json_decode($property->category_id, true) ?? [];
        $categories = Category::whereIn('id', $categoryIds)->get();
        $subcategoryIds = json_decode($property->subcategory_id, true) ?? [];
        $subcategories = Subcategory::whereIn('id', $subcategoryIds)->get();
       $relatedProperties = Property::where(function ($q) use ($categoryIds) {
                foreach ($categoryIds as $catId) {
                    $q->orWhere('category_id', 'like', "%$catId%");
                }
            })
            ->where('id', '!=', $property->id)
            ->whereNotNull('main_image')
            ->where('main_image', '!=', '')
            ->latest()
            ->take(9)
            ->get();

        $cleanDescription = $property->description;
        $cleanDescription = strip_tags($cleanDescription);
        $cleanDescription = preg_replace('/[#*`_>~\-]+/', '', $cleanDescription);
        $cleanDescription = preg_replace('/[\r\n]+/', ' ', $cleanDescription);
        $cleanDescription = preg_replace('/\s+/', ' ', $cleanDescription);
        $cleanDescription = trim($cleanDescription);

        if (mb_strlen($cleanDescription) > 200) {
            $cleanDescription = mb_substr($cleanDescription, 0, 200) . '...';
        }

        $keywordsArray = explode(',', $property->keywords);
        $keywordsArray = array_map('trim', $keywordsArray);
        $selectedKeywords = array_slice($keywordsArray, 0, 2);
        $keywordsString = implode(' | ', $selectedKeywords);

        $pageTitle = $property->name;
        if (!empty($keywordsString)) {
            $pageTitle .= ' | ' . $keywordsString;
        }

        // if (strlen($pageTitle) > 60) {
        //     $pageTitle = substr($pageTitle, 0, 57) . '...';
        // }

        Log::info('Property Viewed:', [
            'property_name' => $property->name,
            'slug' => $property->slug,
            'ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'time' => now()->toDateTimeString()
        ]);

        return view('frontend.properties.details', [
            'property' => $property,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'pageTitle' => $pageTitle,
            'pageDescription' => $cleanDescription,
            'pageKeywords' => $property->keywords,
            'relatedProperties' => $relatedProperties
        ]);
    }

    public function propertiesFrontend(Request $request)
    {
        $query = Property::query()
            ->where('is_active', true)
            ->whereNotNull('main_image')
            ->where('main_image', '<>', '')
            ->latest('updated_at')
            ->with('category');

        if ($request->filled('search')) {
            $search = strtolower(trim($request->search));
            $search = preg_replace('/[^a-z0-9]+/', ' ', $search);
            $search = trim($search);

            $query->whereRaw("
                TRIM(
                    REGEXP_REPLACE(
                        LOWER(name),
                        '[^a-z0-9]+',
                        ' '
                    )
                ) LIKE ?
            ", ["%{$search}%"]);
        }
        
        if ($request->filled('category')) {
            $query->whereJsonContains('category_id', (string)$request->category);
        }

        if ($request->filled('availability') && is_array($request->availability)) {
            $query->where(function ($q) use ($request) {
                if (in_array('in_stock', $request->availability)) {
                    $q->orWhere('quantity', '>', 0);
                }
                if (in_array('out_of_stock', $request->availability)) {
                    $q->orWhere('quantity', '=', 0);
                }
            });
        }

       if ($request->filled('discount') && is_array($request->discount)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->discount as $discount) {
                    $q->orWhereRaw('((price - offer_price) / price) * 100 >= ?', [(int) $discount]);
                }
            });
        }

        if ($request->filled('sort') && is_array($request->sort)) {
            foreach ($request->sort as $sortOption) {
                if ($sortOption === 'low_high') {
                    $query->orderByRaw('CASE WHEN offer_price IS NOT NULL AND offer_price > 0 THEN offer_price ELSE price END ASC');
                } elseif ($sortOption === 'high_low') {
                    $query->orderByRaw('CASE WHEN offer_price IS NOT NULL AND offer_price > 0 THEN offer_price ELSE price END DESC');
                } elseif ($sortOption === 'newest') {
                    $query->orderBy('created_at', 'desc');
                }
            }
        } else {
            $query->latest();
        }

        $properties = $query->get();

        $properties->transform(function ($property) {
            $property->category_name = optional($property->category)->name;
            return $property;
        });

        if ($request->ajax()) {
            $view = view('frontend.properties.list', ['properties' => $properties])->render();
            return response()->json([
                'html' => $view,
                'totalProperties' => $properties->count(),
            ]);
        }

        $categories = Category::all();
        return view('frontend.properties.index', [
            'properties' => $properties,
            'categories' => $categories,
            'totalProperties'   => $properties->count(),
            'pageTitle' => 'Browse Our Properties',
            'pageDescription' => 'Explore a wide range of smart automation properties tailored to your needs.'
        ]);
    }

}

<?php

namespace App\Http\Controllers\Backend;

use App\Models\Property;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $properties = Property::with(['category'])
            ->latest('created_at')
            ->get();
        return view('backend.pages.properties.index', compact('properties'));
    }

    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::whereIn('category_id', $request->category_ids)->get();

        return response()->json($subcategories);
    }

    public function create()
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);

        $categories = Category::all();

        $property = new \stdClass();
        $property->category_id = [];
        $property->subcategory_id = [];

        return view('backend.pages.properties.create', compact('categories', 'property'));
    }

    public function store(Request $request)
    {
        try {
            $this->checkAuthorization(auth()->user(), ['dashboard.view']);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'sku' => 'required|string|max:100',
                'quantity' => 'required|numeric',
                'price' => 'required|numeric',
                'offer_price' => 'required|numeric',
                'min_qty_for_discount' => 'nullable|numeric|min:0',
                'discount_amount' => 'nullable|numeric|min:0',
                'category_id' => 'required|array',
                'category_id.*' => 'exists:categories,id',
                'subcategory_id' => 'nullable|array',
                'subcategory_id.*' => 'exists:subcategories,id',
                'description' => 'nullable|string',
                'short_description' => 'nullable|string',
                'keywords' => 'nullable|string',
                'main_image' => 'nullable|image|max:20480',
                'gallery_images.*' => 'nullable|image|max:20480',
                'catalogue_pdf' => 'nullable|file|mimes:pdf|max:20480',
            ]);

            $validated['slug'] = $this->generateUniqueSlug($request->name);
            $validated['sku'] = $this->generateUniqueSku($request->sku);
            $validated['category_id'] = json_encode($request->category_id);
            $validated['subcategory_id'] = json_encode($request->subcategory_id);
            $validated['short_description'] = $request->short_description;
            $validated['description'] = $request->description;
            $validated['keywords'] = $request->keywords;
            $validated['is_active'] = $request->has('is_active');
            $validated['is_featured'] = $request->has('is_featured');
            $validated['min_qty_for_discount'] = $request->min_qty_for_discount;
            $validated['discount_amount'] = $request->discount_amount;

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
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
        $property->category_id = json_decode($property->category_id, true);
        $property->category_id = is_array($property->category_id) ? $property->category_id : [$property->category_id];
        $property->subcategory_id = json_decode($property->subcategory_id, true);
        $property->subcategory_id = is_array($property->subcategory_id) ? $property->subcategory_id : [$property->subcategory_id];

        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('backend.pages.properties.edit', compact('property', 'categories', 'subcategories'));
    }

    public function update(Request $request, Property $property)
    {
        try {
            $this->checkAuthorization(auth()->user(), ['dashboard.view']);
  
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'sku' => 'required|string|max:100',
                'price' => 'required',
                'quantity' => 'required',
                'offer_price' => 'required',
                'min_qty_for_discount' => 'nullable|numeric|min:0',
                'discount_amount' => 'nullable|numeric|min:0',
                'category_id' => 'required|array',
                'category_id.*' => 'exists:categories,id',
                'subcategory_id' => 'nullable|array',
                'subcategory_id.*' => 'exists:subcategories,id',
                'description' => 'nullable|string',
                'short_description' => 'nullable|string',
                'keywords' => 'nullable|string',
                'main_image' => 'nullable|image|max:20480',
                'gallery_images.*' => 'nullable|image|max:20480',
            ]);

            if ($request->sku !== $property->sku) {
                $validated['sku'] = $this->generateUniqueSku($request->sku);
            } else {
                $validated['sku'] = $property->sku;
            }
        //   dd($request->min_qty_for_discount);
            $validated['category_id'] = json_encode($request->category_id);
            $validated['subcategory_id'] = json_encode($request->subcategory_id);
            $validated['short_description'] = $request->short_description;
            $validated['description'] = $request->description;
            $validated['keywords'] = $request->keywords;
            $validated['is_active'] = $request->has('is_active');
            $validated['is_featured'] = $request->has('is_featured');

            $validated['min_qty_for_discount'] = $request->min_qty_for_discount;
            $validated['discount_amount'] = $request->discount_amount;

            if ($request->hasFile('catalogue_pdf')) {
                $image = $request->file('catalogue_pdf');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('backend/properties/pdfs'), $filename);
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
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);
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
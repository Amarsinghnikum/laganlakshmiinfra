<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Get all listings with pagination and filters
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Property::with(['propertyType', 'state', 'city']);

        // Filter by property_type_id
        if ($request->filled('property_type_id')) {
            $query->where('property_type_id', $request->property_type_id);
        }

        // Filter by state_id
        if ($request->filled('state_id')) {
            $query->where('dynamic_data->state_id', $request->state_id);
        }

        // Filter by city_id
        if ($request->filled('city_id')) {
            $query->where('dynamic_data->city_id', $request->city_id);
        }

        // Filter by min_price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter by max_price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $listings = $query->paginate($perPage);

        // Transform the collection to add image URL
        $listings->getCollection()->transform(function ($property) {
            $property->main_image_url = $this->getImageUrl($property->dynamic_data['main_image'] ?? null);
            $property->gallery_images_urls = $this->getGalleryImagesUrls($property->dynamic_data['gallery_images'] ?? []);
            return $property;
        });

        return response()->json([
            'status' => true,
            'message' => 'Listings retrieved successfully',
            'data' => $listings
        ]);
    }

    /**
     * Get single listing by ID
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $property = Property::with(['propertyType', 'state', 'city'])->find($id);

        if (!$property) {
            return response()->json([
                'status' => false,
                'message' => 'Listing not found',
                'data' => null
            ], 404);
        }

        // Add image URLs
        $property->main_image_url = $this->getImageUrl($property->dynamic_data['main_image'] ?? null);
        $property->gallery_images_urls = $this->getGalleryImagesUrls($property->dynamic_data['gallery_images'] ?? []);

        return response()->json([
            'status' => true,
            'message' => 'Listing retrieved successfully',
            'data' => $property
        ]);
    }

    /**
     * Get featured/active listings
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function featured(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $listings = Property::with(['propertyType', 'state', 'city'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Transform the collection to add image URL
        $listings->getCollection()->transform(function ($property) {
            $property->main_image_url = $this->getImageUrl($property->dynamic_data['main_image'] ?? null);
            $property->gallery_images_urls = $this->getGalleryImagesUrls($property->dynamic_data['gallery_images'] ?? []);
            return $property;
        });

        return response()->json([
            'status' => true,
            'message' => 'Featured listings retrieved successfully',
            'data' => $listings
        ]);
    }

    /**
     * Get image URL from path
     * 
     * @param string|null $path
     * @return string|null
     */
    private function getImageUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return asset($path);
    }

    /**
     * Get gallery images URLs
     * 
     * @param array $images
     * @return array
     */
    private function getGalleryImagesUrls($images)
    {
        if (empty($images)) {
            return [];
        }

        return array_map(function ($image) {
            return $this->getImageUrl($image);
        }, $images);
    }
}

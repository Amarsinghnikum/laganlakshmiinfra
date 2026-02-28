<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Get all states
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStates()
    {
        $states = State::orderBy('name', 'ASC')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'States retrieved successfully',
            'data' => $states
        ]);
    }

    /**
     * Get all cities
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities()
    {
        $cities = City::with('state')->orderBy('name', 'ASC')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Cities retrieved successfully',
            'data' => $cities
        ]);
    }

    /**
     * Get cities by state
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCitiesByState($id)
    {
        $state = State::find($id);
        
        if (!$state) {
            return response()->json([
                'status' => false,
                'message' => 'State not found',
                'data' => null
            ], 404);
        }

        $cities = City::where('state_id', $id)->orderBy('name', 'ASC')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Cities retrieved successfully',
            'data' => $cities
        ]);
    }

    /**
     * Get single city with state details
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCity($id)
    {
        $city = City::with('state')->find($id);
        
        if (!$city) {
            return response()->json([
                'status' => false,
                'message' => 'City not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'City retrieved successfully',
            'data' => $city
        ]);
    }

    /**
     * Get single state with cities
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getState($id)
    {
        $state = State::with('cities')->find($id);
        
        if (!$state) {
            return response()->json([
                'status' => false,
                'message' => 'State not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'State retrieved successfully',
            'data' => $state
        ]);
    }

    /**
     * Get all property types
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPropertyTypes()
    {
        $propertyTypes = PropertyType::where('is_active', true)->orderBy('name', 'ASC')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Property types retrieved successfully',
            'data' => $propertyTypes
        ]);
    }

    /**
     * Get single property type
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPropertyType($id)
    {
        $propertyType = PropertyType::find($id);
        
        if (!$propertyType) {
            return response()->json([
                'status' => false,
                'message' => 'Property type not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Property type retrieved successfully',
            'data' => $propertyType
        ]);
    }
}

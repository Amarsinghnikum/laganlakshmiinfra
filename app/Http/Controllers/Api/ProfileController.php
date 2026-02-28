<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Get authenticated user profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => true,
            'message' => 'Profile retrieved successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'profile_completed' => $user->profile_completed ?? false,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]);
    }

    /**
     * Update authenticated user profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|min:10|max:15|unique:users,phone,' . $user->id,
            'current_password' => 'sometimes|string|required_with:new_password',
            'new_password' => 'sometimes|string|min:8|different:current_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Update basic profile fields
            if ($request->filled('name')) {
                $user->name = $request->name;
            }

            if ($request->filled('email')) {
                $user->email = $request->email;
            }

            if ($request->filled('phone')) {
                $user->phone = $request->phone;
            }

            // Handle password change
            if ($request->filled('current_password') && $request->filled('new_password')) {
                // Verify current password
                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Current password is incorrect',
                    ], 422);
                }

                $user->password = Hash::make($request->new_password);
            }

            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'profile_completed' => $user->profile_completed ?? false,
                    'updated_at' => $user->updated_at,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Profile update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update profile. Please try again.',
            ], 500);
        }
    }

    /**
     * Get user properties (listings created by the user)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myProperties(Request $request)
    {
        $user = $request->user();

        $properties = \App\Models\Property::where('user_id', $user->id)
            ->with(['propertyType', 'state', 'city'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Transform the collection to add image URL
        $properties->getCollection()->transform(function ($property) {
            $property->main_image_url = $this->getImageUrl($property->dynamic_data['main_image'] ?? null);
            return $property;
        });

        return response()->json([
            'status' => true,
            'message' => 'User properties retrieved successfully',
            'data' => $properties
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
}

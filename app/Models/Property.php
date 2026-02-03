<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'property_for',
        'property_type_id',
        'price',
        'area_sqft',
        'bedrooms',
        'bathrooms',
        'balconies',
        'floor',
        'total_floors',
        'property_age',
        'furnishing_status',
        'facing',
        'availability_status',
        'status',
        'description',
        'main_image',
        'gallery_images',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'gallery_images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function propertytype()
{
    return $this->belongsToMany(PropertyType::class, 'property_property_type', 'product_id', 'property_type_id');
}

}

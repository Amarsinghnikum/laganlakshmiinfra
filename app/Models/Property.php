<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'keywords',
        'quantity',
        'price',
        'offer_price',
        'min_qty_for_discount',
        'discount_amount',
        'catalogue_pdf',
        'is_active',
        'is_featured',
        'category_id',
        'property_type_id',
        'main_image',
        'gallery_images',
        'tags',
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

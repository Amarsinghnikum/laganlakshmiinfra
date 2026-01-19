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
        'subcategory_id',
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

    public function subcategories()
{
    return $this->belongsToMany(Subcategory::class, 'product_subcategory', 'product_id', 'subcategory_id');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'property_type_id',
        'price',
        'dynamic_data',
        'status',
    ];

    protected $casts = [
        'dynamic_data' => 'array',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

     public function state()
    {
        return $this->belongsTo(State::class, 'dynamic_data->state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'dynamic_data->city_id', 'id');
    }
}

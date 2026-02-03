<?php

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyTypes = [
            ['name' => 'Apartment / Flat', 'slug' => 'apartment-flat', 'is_active' => true],
            ['name' => 'Independent House', 'slug' => 'independent-house', 'is_active' => true],
            ['name' => 'Villa', 'slug' => 'villa', 'is_active' => true],
            ['name' => 'Plot / Land', 'slug' => 'plot-land', 'is_active' => true],
            ['name' => 'Office Space', 'slug' => 'office-space', 'is_active' => true],
            ['name' => 'Shop', 'slug' => 'shop', 'is_active' => true],
            ['name' => 'Warehouse', 'slug' => 'warehouse', 'is_active' => true],
        ];

        foreach ($propertyTypes as $type) {
            PropertyType::create($type);
        }
    }
}

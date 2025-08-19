<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\PropertyType;
use App\Models\PropertyTypeArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property_ids = PropertyType::pluck('id')->toArray();
        $countries = Country::with('city')->get();

        foreach($countries as $country){
            foreach($country->city as $city){
                $property_type_area = new PropertyTypeArea();
                $property_type_area->property_type_id = array_rand($property_ids);
                $property_type_area->country_id = $country->id;
                $property_type_area->city_id = $city->id;
                $property_type_area->save();
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $country = Country::where('name', 'Türkiye')
            ->whereHas('cities', function ($query) {
                $query->whereHas('districts');
            })->with('cities.districts')->first();


        for ($i = 0; $i < 50; $i++) {
            $city = $country->cities()->whereHas('districts')->inRandomOrder()->first();
            $district = $city->districts()->inRandomOrder()->first();
            $property = Property::factory()->make([
                'country_id' => $country->id,
                'city_id' => $city->id,
                'district_id' => $district->id,
            ]);
            $property->save();
        }


        for ($i = 0; $i < 10; $i++) {
            $city = $country->cities()->whereHas('districts')->inRandomOrder()->first();
            $district = $city->districts()->inRandomOrder()->first();
            $property = Property::factory()->featured()->make([
                'country_id' => $country->id,
                'city_id' => $city->id,
                'district_id' => $district->id,
            ]);
            $property->save();
        }
        for ($i = 10; $i < 100; $i++) {
            $city = $country->cities()->whereHas('districts')->inRandomOrder()->first();
            $district = $city->districts()->inRandomOrder()->first();
            $property = Property::factory()->approved()->make([
                'country_id' => $country->id,
                'city_id' => $city->id,
                'district_id' => $district->id,
            ]);
            $property->save();
        }


        for ($i = 10; $i < 10; $i++) {
            $city = $country->cities()->whereHas('districts')->inRandomOrder()->first();
            $district = $city->districts()->inRandomOrder()->first();
            $property = Property::factory()->pending()->make([
                'country_id' => $country->id,
                'city_id' => $city->id,
                'district_id' => $district->id,
            ]);
            $property->save();
        }


    }
}

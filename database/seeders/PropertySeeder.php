<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = \App\Models\Property::factory(100)->make();
        foreach ($properties as $property) {
            $this->_associateRandomAddress($property);
        }

        $featured = \App\Models\Property::factory(10)->featured()->make();
        foreach ($featured as $property) {
            $this->_associateRandomAddress($property);
        }

        $approved = \App\Models\Property::factory(10)->approved()->make();
        foreach ($approved as $property) {
            $this->_associateRandomAddress($property);
        }

        $pending = \App\Models\Property::factory(10)->pending()->make();
        foreach ($pending as $property) {
            $this->_associateRandomAddress($property);
        }

    }

    private function _associateRandomAddress(Property $property)
    {
        try {
            $country = \App\Models\Country::query()->whereHas('cities.districts')->inRandomOrder()->first();

            $city = $country->cities()->whereHas('districts')->inRandomOrder()->first();

            $district = $city->districts()->inRandomOrder()->first();

            $property->country()->associate($country);
            $property->city()->associate($city);

            $property->district()->associate($district);
            $property->save();
        } catch (\Exception $exception) {

        }

    }
}

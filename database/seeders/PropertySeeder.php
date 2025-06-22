<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $property = \App\Models\Property::factory(100)->create();

        $featured = \App\Models\Property::factory(10)->featured()->create();

        $approved = \App\Models\Property::factory(10)->approved()->create();

        $pending = \App\Models\Property::factory(10)->pending()->create();

    }
}

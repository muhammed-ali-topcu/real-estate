<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property = \App\Models\Property::factory()->create();

        $featured = \App\Models\Property::factory()->featured()->create();

        $approved = \App\Models\Property::factory()->approved()->create();

        $pending = \App\Models\Property::factory()->count(5)->pending()->create();

    }
}

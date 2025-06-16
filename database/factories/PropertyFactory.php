<?php

namespace Database\Factories;

use App\Enums\PropertyListingTypes;
use App\Enums\PropertyStatuses;
use App\Enums\PropertyTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $propertyTypes = PropertyTypes::all();
        $listingTypes = PropertyListingTypes::all();
        $statuses = PropertyStatuses::all();

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraphs(3, true),
            'property_type' => $this->faker->randomElement($propertyTypes),
            'listing_type' => $this->faker->randomElement($listingTypes),
            'price' => $this->faker->numberBetween(50000, 5000000),
            'rooms' => $this->faker->numberBetween(1, 10),
            'bathrooms' => $this->faker->numberBetween(1, 5),
            'area' => $this->faker->numberBetween(50, 1000),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'status' => $this->faker->randomElement(array: $statuses),
            'featured' => $this->faker->boolean(20), // 20% chance of being featured
            'year_built' => $this->faker->numberBetween(1950, date('Y')),
            'approved_at' => $this->faker->optional(0.8)->dateTimeThisYear, // 80% chance of being approved
            'approved_by' => \App\Models\User::factory(),
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear,
        ];
    }

    /**
     * Configure the model factory to create a featured property.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }

    /**
     * Configure the model factory to create an approved property.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PropertyStatuses::APPROVED->value,
            'approved_at' => now(),
            'approved_by' => \App\Models\User::factory(),
        ]);
    }

    /**
     * Configure the model factory to create a pending property.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PropertyStatuses::PENDING->value,
            'approved_at' => null,
            'approved_by' => null,
        ]);
    }
}

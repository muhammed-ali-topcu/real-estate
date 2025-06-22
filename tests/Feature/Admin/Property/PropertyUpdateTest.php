<?php

namespace Tests\Feature\Admin\Property;

use App\Enums\PropertyListingTypes;
use App\Enums\PropertyRooms;
use App\Enums\PropertyStatuses;
use App\Enums\PropertyTypes;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Property;

test('admin can update a property', function () {

    // Create necessary related models
    $country = Country::factory()->create();
    $city = City::factory()->create(['country_id' => $country->id]);
    $district = District::factory()->create(['city_id' => $city->id]);

    $property = Property::factory()->create();

    $response = setubAdmin()
        ->get(route('admin.properties.edit', parameters: $property))
        ->assertStatus(200);

    $payload = [
        'title' => 'Test Property',
        'description' => 'This is a test property',
        'address' => '123 Test Street',
        'property_type' => PropertyTypes::APARTMENT->value,
        'listing_type' => PropertyListingTypes::SALE->value,
        'price' => 100000,
        'rooms' => PropertyRooms::ROOM_1_PLUS_1->value,
        'area' => 100,
        'status' => PropertyStatuses::PENDING->value,
        'country_id' => $country->id,
        'city_id' => $city->id,
        'district_id' => $district->id,
    ];

    $response = setubAdmin()
        ->put(route('admin.properties.update', $property), $payload);

    // Assert we were redirected to the properties index
    $response->assertRedirect(route('admin.properties.index'));

    // Assert the property was created in the database
    $this->assertDatabaseHas('properties', $payload);
});

test('property updating fails with invalid data', function () {

    $property = Property::factory()->create();

    $payload = [
        'title' => 'Test Property',
        'description' => 'This is a test property',
        'address' => '123 Test Street',
        'property_type' => 'sss',
        'listing_type' => 'sssfdsfs',
        'price' => -4654,
        'rooms' => 'sss flsdkjf lksd',
        'area' => 'jflds',
        'status' => 'sss',

    ];

    $response = setubAdmin()
        ->put(route('admin.properties.update', $property), $payload);

    // Assert we see validation errors
    $response->assertSessionHasErrors([
        'price',
        'area',
        'country_id',
        'city_id',
        'district_id',
        'property_type',
        'listing_type',
        'rooms',
        'status',
    ]);
});

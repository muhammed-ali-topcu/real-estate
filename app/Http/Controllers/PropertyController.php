<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::query()
            ->approved()
            ->with('media')
            ->with('country')
            ->with('city')
            ->with('district')
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(function ($property) {
                return [
                    'id' => $property->id,
                    'title' => $property->title,
                    'price' => $property->price,
                    'property_type' => $property->property_type,
                    'listing_type' => $property->listing_type,
                    'rooms' => $property->rooms,
                    'country' => $property->country->name,
                    'city' => $property->city->name,
                    'district' => $property->district->name,
                    'first_image_url' => $property->getFirstMediaUrl('images') ?? null,
                ];
            });



        return Inertia::render('properties/Index', [
            'properties' => $properties,
        ]);
    }

    public function show(Property $property)
    {
        return Inertia::render('properties/Show', [
            'property' => $property->load('media'),
        ]);
    }
}

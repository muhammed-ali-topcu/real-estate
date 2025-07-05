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

            ->when(request('keyword'), function ($query, $keyword) {
                $keyword = strtolower($keyword);
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$keyword}%"]);
            })
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
            'filters' => request()->only(['keyword']),
        ]);
    }

    public function show(Property $property)
    {
        $property->load(['media', 'country', 'city', 'district']);

        return Inertia::render('properties/Show', [
            'property' => [
                'id' => $property->id,
                'title' => $property->title,
                'price' => $property->price,
                'property_type' => $property->property_type,
                'listing_type' => $property->listing_type,
                'rooms' => $property->rooms,
                'country' => $property->country,
                'city' => $property->city,
                'district' => $property->district,
                'description' => $property->description,
                'images' => $property->getMedia('images')->map(fn($image) => $image->getUrl()),
                'first_image_url' => $property->getFirstMediaUrl('images') ?? null,
            ],
        ]);
    }
}

<?php
namespace App\Http\Controllers\Admin;

use App\Enums\PropertyListingTypes;
use App\Enums\PropertyStatuses;
use App\Enums\PropertyTypes;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index()
    {

        $query = Property::query();

        $query->when(request('search'), function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        });

        $query->when(request('property_type'), function ($query) {
            $query->where('property_type', request('property_type'));
        });
        $query->when(request('listing_type'), function ($query) {
            $query->where('listing_type', request('listing_type'));
        });
        $query->when(request('status'), function ($query) {
            $query->where('status', request('status'));
        });
        $query->when(request('min_price'), function ($query) {
            $query->where('price', '>=', (float)request('min_price'));
        });
        $query->when(request('max_price'), function ($query) {
            $query->where('price', '<=', (float)request('max_price'));
        });
       

        $properties = $query->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(
                fn($property) => [
                    'id'            => $property->id,
                    'title'=>Str::limit($property->title, 20, '...'),
                    'price'         => $property->price,
                    'status'        => $property->status,
                    'property_type' => $property->property_type,
                    'listing_type'  => $property->listing_type,
                    'bedrooms'      => $property->bedrooms,
                    'admin_notes'   => $property->admin_notes,
                    'approved_at'   => $property->approved_at,
                    'approved_by'   => $property->approved_by,
                    'created_at'    => $property->created_at->format('Y-m-d H:i:s'),
                ],
            );

        return inertia('admin/properties/Index', [
            'properties'    => $properties,
            'propertyTypes' => PropertyTypes::all(),
            'listingTypes'  => PropertyListingTypes::all(),
            'statuses'      => PropertyStatuses::all(),
            'filters'       => request()->only(['search', 'property_type', 'listing_type', 'status', 'min_price', 'max_price']),
        ]);
    }

    public function create()
    {
        return inertia('admin/properties/Create');
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\PropertyListingTypes;
use App\Enums\PropertyRooms;
use App\Enums\PropertyStatuses;
use App\Enums\PropertyTypes;
use Illuminate\Foundation\Http\FormRequest;

class PropertyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'address'       => 'required|string',
            'property_type' => 'required|string|in:' . implode(',', PropertyTypes::all()),
            'listing_type'  => 'required|string|in:' . implode(',', PropertyListingTypes::all()),
            'price'         => 'required|numeric',
            'rooms'         => 'required|string|in:' . implode(',', PropertyRooms::all()),
            'area'          => 'required|numeric',
            'status'        => 'required|string|in:' . implode(',', PropertyStatuses::all()),
        ];
    }
}

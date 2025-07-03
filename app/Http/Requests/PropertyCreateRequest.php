<?php

namespace App\Http\Requests;

use App\Enums\PropertyListingTypes;
use App\Enums\PropertyRooms;
use App\Enums\PropertyStatuses;
use App\Enums\PropertyTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'property_type' => 'required|string|in:' . implode(',', PropertyTypes::all()),
            'listing_type' => 'required|string|in:' . implode(',', PropertyListingTypes::all()),
            'price' => 'required|numeric|gt:0',
            'rooms' => 'required|string|in:' . implode(',', PropertyRooms::all()),
            'area' => 'required|numeric|gt:0',
            'status' => 'required|string|in:' . implode(',', PropertyStatuses::all()),
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'city_id' => ['required', Rule::exists('cities', 'id')->where('country_id', $this->country_id)],
            'district_id' => ['required', Rule::exists('districts', 'id')->where('city_id', $this->city_id)],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',



        ];
    }
}

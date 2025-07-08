<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class AddressController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('admin/properties/Addres');
    }

    public function getCountries(): JsonResponse
    {
        $countries = Country::all()->transform(function ($country) {
            return [
                'id' => $country->id,
                'name' => $country->name,
            ];
        });

        return response()->json([
            'countries' => $countries,
        ]);
    }

    public function getCities(Request $request, Country $country): JsonResponse
    {
        $cities = $country->cities()->get()->transform(function ($city) {
            return [
                'id' => $city->id,
                'name' => $city->name,
            ];
        });

        return response()->json([
            'cities' => $cities,
        ]);
    }

    public function getDistricts(Request $request, City $city): JsonResponse
    {
        $districts = $city->districts()->get()->transform(function ($district) {
            return [
                'id' => $district->id,
                'name' => $district->name,
            ];
        });

        return response()->json([
            'districts' => $districts,
        ]);
    }
}

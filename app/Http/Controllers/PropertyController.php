<?php

namespace App\Http\Controllers;

use App\Enums\PropertyTypes;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {

        dd(PropertyTypes::all());
        dd('jfldsf');



        return inertia('admin/properties/index');
    }

    public function create()
    {
        return inertia('admin/properties/create');
    }

}

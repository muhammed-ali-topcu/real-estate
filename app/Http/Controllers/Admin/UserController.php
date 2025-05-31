<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users= User::query()->latest()->get();

        return Inertia::render('admin/users/Index',compact('users'));
    }
}

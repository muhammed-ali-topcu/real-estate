<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->with('roles')->latest()
            ->paginate(10)
            ->through(fn($user) => [
                'id'     => $user->id,
                'name'   => $user->name,
                'email'  => $user->email,
                'status' => $user->is_active ? __('Active') : __('Inactive'),
            ]);


        return Inertia::render('admin/users/Index', compact('users'));
    }

    public function edit(User $user)
    {
        return Inertia::render('admin/users/Edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', __('User deleted successfully'));
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with('roles')
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'status'     => $user->is_active ? __('Active') : __('Inactive'),
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            ]);

        return Inertia::render('admin/users/Index', [
            'users'   => $users,
            'filters' => request()->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/users/Create');
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.users.index')->with('success', __('User created successfully'));
    }

    public function edit(User $user)
    {
        return Inertia::render('admin/users/Edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->back()->with('success', __('User updated successfully'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', __('User deleted successfully'));
    }


}

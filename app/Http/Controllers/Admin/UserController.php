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
use Spatie\Permission\Models\Role;

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
                'roles'      => $user->roles->pluck('name')->implode(', '),
                'can_be_impersonated' => $user->canBeImpersonated(),
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            ]);

        return Inertia::render('admin/users/Index', [
            'users'   => $users,
            'filters' => request()->only(['search']),
        ]);
    }

    public function create()
    {
        $roles = RolesEnum::cases();
        return Inertia::render('admin/users/Create', compact('roles'));
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);
        return redirect()->route('admin.users.index')->with('success', __('User created successfully'));
    }

    public function edit(User $user)
    {
        $roles = RolesEnum::cases();
        $user->load('roles');

        return Inertia::render('admin/users/Edit', [
            'roles' => $roles,
            'user'  => [
                'id'        => $user->id,
                'name'      => $user->name,
                'is_active' => $user->is_active,
                'email'     => $user->email,
                'roles'     => $user->roles->pluck('name')->toArray(),
            ],
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->boolean('is_active');
        if ($request->boolean('change_password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->syncRoles($request->roles);
        return redirect()->back()->with('success', __('User updated successfully'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', __('User deleted successfully'));
    }


}

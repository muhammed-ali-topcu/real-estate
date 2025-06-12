<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums\PermissionsEnum;


Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:' . \App\Enums\RolesEnum::ADMIN->value])->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('users.index')->can(PermissionsEnum::LIST_USERS->value);
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->can(PermissionsEnum::CREATE_USERS->value);
    Route::post('users', [UserController::class, 'store'])->name('users.store')->can(PermissionsEnum::CREATE_USERS->value);
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->can(PermissionsEnum::EDIT_USERS->value);
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->can(PermissionsEnum::EDIT_USERS->value);
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->can(PermissionsEnum::DELETE_USERS->value);

});


Route::middleware(['auth', 'verified', 'role:' . \App\Enums\RolesEnum::ADMIN->value])->group(function () {

});
Route::impersonate();

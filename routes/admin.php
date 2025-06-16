<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PropertyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums\PermissionsEnum;



Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:' . \App\Enums\RolesEnum::ADMIN->value])->group(function () {

    //users
    Route::get('users', [UserController::class, 'index'])->name('users.index')->can(PermissionsEnum::LIST_USERS->value);
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->can(PermissionsEnum::CREATE_USERS->value);
    Route::post('users', [UserController::class, 'store'])->name('users.store')->can(PermissionsEnum::CREATE_USERS->value);
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->can(PermissionsEnum::EDIT_USERS->value);
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->can(PermissionsEnum::EDIT_USERS->value);
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->can(PermissionsEnum::DELETE_USERS->value);

    // properties
    Route::get('properties', [PropertyController::class, 'index'])->name('properties.index')->can(PermissionsEnum::LIST_PROPERTIES->value);
    Route::get('properties/create', [PropertyController::class, 'create'])->name('properties.create')->can(PermissionsEnum::CREATE_PROPERTIES->value);
    Route::post('properties', [PropertyController::class, 'store'])->name('properties.store')->can(PermissionsEnum::CREATE_PROPERTIES->value);
    Route::get('properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit')->can(PermissionsEnum::EDIT_PROPERTIES->value);
    Route::put('properties/{property}', [PropertyController::class, 'update'])->name('properties.update')->can(PermissionsEnum::EDIT_PROPERTIES->value);
    Route::delete('properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy')->can(PermissionsEnum::DELETE_PROPERTIES->value);
});




Route::middleware(['auth', 'verified', 'role:' . \App\Enums\RolesEnum::ADMIN->value])->group(function () {

});
Route::impersonate();

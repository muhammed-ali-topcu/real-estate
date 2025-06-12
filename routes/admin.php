<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified','role:'.\App\Enums\RolesEnum::ADMIN->value])->group(function () {
    Route::resource('users',UserController::class);
});


Route::middleware(['auth', 'verified','role:'.\App\Enums\RolesEnum::ADMIN->value])->group(function () {

});
Route::impersonate();

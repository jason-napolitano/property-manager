<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// users
Route::resource('users', Controllers\UserController::class);
Route::get('users/{user}/properties', [Controllers\UserController::class, 'properties'])->name('users.properties');
Route::put('users/{user}/restore', [Controllers\UserController::class, 'restore'])
    ->withTrashed()->name('users.restore');

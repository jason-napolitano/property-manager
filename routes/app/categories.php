<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// users
Route::resource('categories', Controllers\CategoryController::class);
Route::put('categories/{category}/restore', [Controllers\CategoryController::class, 'restore'])
    ->withTrashed()->name('categories.restore');

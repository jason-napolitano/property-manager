<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// users
Route::resource('properties', Controllers\PropertyController::class);

Route::put('properties/{property}/restore', [Controllers\PropertyController::class, 'restore'])
    ->withTrashed()->name('properties.restore');

Route::get('properties/{property}/projects', [Controllers\PropertyController::class, 'projects'])
    ->withTrashed()->name('properties.projects');

Route::get('properties/{property}/buildings', [Controllers\PropertyController::class, 'buildings'])
    ->withTrashed()->name('properties.buildings');

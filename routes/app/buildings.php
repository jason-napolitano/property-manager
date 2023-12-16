<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::resource('buildings', Controllers\BuildingController::class);

Route::put('buildings/{building}/restore', [Controllers\BuildingController::class, 'restore'])
    ->withTrashed()->name('buildings.restore');

Route::get('buildings/{building}/projects', [Controllers\BuildingController::class, 'projects'])
    ->withTrashed()->name('buildings.projects');

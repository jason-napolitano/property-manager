<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// users
Route::resource('projects', Controllers\ProjectController::class);
Route::put('projects/{project}/restore', [Controllers\ProjectController::class, 'restore'])
    ->withTrashed()->name('projects.restore');

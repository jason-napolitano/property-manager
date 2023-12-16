<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// users
Route::resource('tasks', Controllers\TaskController::class);
Route::put('tasks/{task}/restore', [Controllers\TaskController::class, 'restore'])
    ->withTrashed()->name('tasks.restore');

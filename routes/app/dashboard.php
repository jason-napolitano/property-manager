<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('')->uses(DashboardController::class)->name('dashboard.index');

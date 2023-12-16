<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::resource('login', Controllers\Auth\AuthenticatedSessionController::class);
Route::resource('register', Controllers\Auth\RegisteredUserController::class);

Route::middleware('auth')->group(static function () {
    Route::post('logout', [Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('login.destroy');
});

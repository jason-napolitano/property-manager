<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', [FrontendController::class, 'home'])->name('home.index');
Route::get('about', [FrontendController::class, 'about'])->name('about.index');
Route::get('legal', [FrontendController::class, 'legal'])->name('legal.index');
Route::get('contact', [FrontendController::class, 'contact'])->name('contact.index');
Route::get('services', [FrontendController::class, 'services'])->name('services.index');
Route::get('charity', [FrontendController::class, 'charity'])->name('charity.index');

Route::middleware('auth')->group(function () {
    Route::get('@{user}', [UserController::class, 'show'])->name('users.profile');
});

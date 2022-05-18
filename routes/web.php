<?php

use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TripRegisterController;
use App\Http\Controllers\TripsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Homepagina
Route::view('/', 'index')->name('home');

// Reizen Routes
Route::middleware('auth')->group(function () {
    Route::resource('trips', TripsController::class)->middleware('auth');
    Route::post('trips/{trip}/register', [TripRegisterController::class, 'register'])->name('trips.register');
    Route::get('trips/{trip}/unregister', [TripRegisterController::class, 'unregister'])->name('trips.unregister');
});

// Authenticatie Routes
Route::view('login', 'auth.login')->name('login')->middleware('guest');
Route::post('login', LoginController::class)->name('login.post')->middleware('guest');
Route::get('logout', LogoutController::class)->name('logout')->middleware('auth');
// Admin Login Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('login', 'auth.admin.login')->name('login')->middleware('guest');
    Route::post('login', AdminLoginController::class)->name('login.post')->middleware('guest');
});

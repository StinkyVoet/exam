<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
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

Route::view('/', 'index')->name('home');
Route::resource('trips', TripsController::class)->middleware('auth');

// Authenticatie Routes
Route::view('/login', 'auth.login')->name('login')->middleware('guest');
Route::post('login', LoginController::class)->name('login.post')->middleware('guest');
Route::get('/logout', LogoutController::class)->name('logout')->middleware('auth');

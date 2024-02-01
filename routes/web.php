<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hotels\HotelsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//hotels
Route::get('hotels/rooms/{id}', [HotelsController::class, 'rooms'])->name('hotel.rooms');

Route::get('hotels/rooms-details/{id}', [HotelsController::class, 'roomDetails'])->name('hotel.rooms.details');

Route::post('hotels/rooms-booking/{id}', [HotelsController::class, 'roomBooking'])->name('hotel.rooms.booking');

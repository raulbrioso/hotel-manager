<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('hotels', HotelController::class)->middleware('auth');
Route::resource('rooms', RoomController::class)->middleware('auth');

Route::get('rooms/reservation/{id}', 'RoomController@reservation')->name('rooms.reservation');
Route::post('rooms/reservationstore', 'RoomController@reservationstore');
Route::post('rooms/checkout', 'RoomController@checkout')->name('rooms.checkout');

Route::get('/home', 'HomeController@index')->name('home');

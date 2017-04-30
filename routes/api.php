<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Api\UserController@login');
Route::post('/register', 'Api\UserController@save');

Route::post('/reservation', 'Api\ReservationController@save');
Route::get('/my_reservations/{user_id}', 'Api\ReservationController@all');

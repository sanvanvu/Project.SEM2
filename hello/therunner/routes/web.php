<?php

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

Route::get('/', 'FrontendController@welcome');
Route::get('index.html', 'FrontendController@welcome');
Route::get('logicalchallenges.html', 'FrontendController@logical_rooms');


Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');



//connect controller with tables
Route::resource('room', 'RoomController');
Route::resource('discount_code', 'CodeController');
Route::resource('book', 'BookController');
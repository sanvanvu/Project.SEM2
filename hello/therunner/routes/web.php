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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');



//connect controller with tables
Route::resource('room', 'RoomController');
Route::resource('discount_code', 'CodeController');
Route::resource('book', 'BookController');
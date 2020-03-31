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

Route::get('/', 'frontendController@welcome');
Route::get('index.html', 'frontendController@welcome');
Route::get('logicalchallenges.html', 'frontendController@logical_rooms')->name('room.logic');
Route::get('horrorchallenges.html', 'frontendController@horror_rooms')->name('room.horror');
Route::get('allchallenges.html', 'frontendController@all_rooms')->name('room.all');
Route::get('cancel.html', 'frontendController@cancel')->name('user.cancel');
Route::get('cancel_form.html', 'frontendController@cancel_form');
Route::get('room.html', 'frontendController@room');
Route::get('book.html', 'BookController@create');


Route::group(['middleware' => 'auth'], function(){
      Route::resource('room', 'RoomController');
      Route::resource('discount_code', 'CodeController');
      Route::resource('book', 'BookController');
      Route::resource('time_list', 'timeController');
});

Route::get('checkout.html', 'frontendController@check_out');

// use App\Mail\Checkoutmail;
// use Illuminate\Support\Facades\Mail;

// Route::get('/email', function(){
//   Mail::to('quanlmth1812005@fpt.edu.vn')->send(new Checkoutmail());
//   return new Checkoutmail();
// });

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

//connect controller with tables
// // Route::resource('room', 'RoomController');
// // Route::resource('discount_code', 'CodeController');
// // Route::resource('book', 'BookController');
// Route::resource('time_list', 'timeController');
Route::resource('fe', 'frontendController');

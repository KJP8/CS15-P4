<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/admin-home', 'AdminHomeController@show')->name('admin.show');

Route::get('/user-home/{id?}', 'UserHomeController@show')->name('users.show');

Route::post('/books', 'UserHomeController@store')->name('users.store');


Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');

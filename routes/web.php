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

Route::get('/user-home/{id}', 'UserHomeController@show')->name('users.show');

Route::post('/user-home/{id}', 'UserHomeController@store')->name('users.store');

# Show form to edit a food
Route::get('/edit/{user_id}/{id}', 'UserHomeController@edit')->name('users.edit');
# Process form to edit a food
Route::put('/user-home/{id}', 'UserHomeController@update')->name('users.update');



Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');

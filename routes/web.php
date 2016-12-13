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

Route::get('/', 'IndexController@index')->name('main.index');

Route::get('/home', 'HomeController@show')->name('home.show');

Route::get('/grocery-list/{id}', 'GroceryListController@show')->name('foods.show');

Route::post('/grocery-list', 'GroceryListController@store')->name('foods.store');

# Show form to edit a food
Route::get('/edit/{user_id}/{id}', 'GroceryListController@edit')->name('foods.edit');
# Process form to edit a food
Route::put('/grocery-list/{id}', 'GroceryListController@update')->name('foods.update');

Route::get('/delete/{user_id}/{id}', 'GroceryListController@delete')->name('foods.delete');



Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');

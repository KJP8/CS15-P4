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

# Show index page
Route::get('/', 'IndexController@index')->name('main.index');

# Show user homepage
Route::get('/home', 'HomeController@show')->name('home.show');

# Show user's grocery list
Route::get('/grocery-list/{id}', 'GroceryListController@show')->name('foods.show');

# Process form to add food to user's grocery list
Route::post('/grocery-list', 'GroceryListController@store')->name('foods.store')->middleware('auth');

# Show form to edit a food
Route::get('/edit/{user_id}/{id}', 'GroceryListController@edit')->name('foods.edit')->middleware('auth');

# Process form to edit a food
Route::put('/grocery-list/{id}', 'GroceryListController@update')->name('foods.update')->middleware('auth');

# Process form to delete a food from user's grocery list
Route::get('/delete/{user_id}/{id}', 'GroceryListController@delete')->name('foods.delete')->middleware('auth');

# Process form to delete all foods from user's grocery list
Route::get('/delete/{user_id}/', 'GroceryListController@deleteAll')->name('foods.deleteAll')->middleware('auth');


# Authentication-related routes
Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');

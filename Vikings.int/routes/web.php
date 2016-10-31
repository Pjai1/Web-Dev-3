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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('/user', 'UserController');
Route::get('/user/trashed/{id}', 'UserController@showTrashed');
// Route::get('/user', 'UserController@index');
// Route::get('/user/{id}', 'UserController@show');
// Route::post('/user/{user}', 'UserController@update');
Route::post("/user/restore/{id}", "UserController@restore");
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

Route::get('/contest', 'ContestController@index');

Route::get('/dashboard', 'DashboardController@index');

Route::get('/contact', function() {
	return view('contact');
});

Route::resource('/user', 'UserController');
Route::post('/user/{user}', 'UserController@destroy');
Route::post('/user/update/{user}', 'UserController@update');
Route::get('/admins', 'UserController@showAdmins');
Route::get('/exportusers', 'UserController@exportUsers');
Route::post('/user/restore/{id}', 'UserController@restore');

Route::resource('/period', 'PeriodController');
Route::get('/exportperiods', 'PeriodController@exportPeriods');
Route::post("/period/restore/{id}", "PeriodController@restore");

Route::resource('/entry', 'EntryController');
Route::get('/exportentries', 'EntryController@exportEntries');
Route::get('/winners', "EntryController@showWinners");
Route::post("/entry/restore/{id}", "EntryController@restore");

Route::get('/send', 'EmailController@send');
Route::get('/error', function() {
	return view('test');
});

Route::get('/test', 'EntryController@makeRandomKeys');


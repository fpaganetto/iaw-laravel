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

Route::get('/readme', function () {
    return view('readme');
});

Route::get('/personalizables','PersonalizablesController@json');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect/{servicio}','Auth\OAuthController@redirect');
Route::get('/callback/{servicio}','Auth\OAuthController@callback');
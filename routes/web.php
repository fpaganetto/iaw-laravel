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

/*Route::get('/', function () {
	return view('welcome', ['idURL' => ""]);
});*/

/* ESTO ROMPE TODO
Route::get('/{idURL}', function ($idURL) {
	return view('welcome', ['idURL' => $idURL]);
});
*/

Route::get('/', "WelcomeController@welcome");

Route::get('/readme', function () {
    return view('readme');
});

Route::get('/personalizables','PersonalizablesController@json');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect/{servicio}','Auth\OAuthController@redirect');
Route::get('/callback/{servicio}','Auth\OAuthController@callback');

Route::post('/compartir','CompartirController@registrar');
Route::post('/obtener','CompartirController@obtenerJSON');

Route::get('/compartido/{idURL}', function ($idURL) {
	return Redirect::action("WelcomeController@welcome", array('idURL' => $idURL));
});

Route::get('/admin', function () {
    return view('admin',['personalizables' => \App\Personalizables::all(), 'elementos' => \App\Personalizables::elementos()]);
})->middleware('admin');

Route::get('/prueba', function () {
	dd(\App\Personalizables::elementos());
});

Route::get('/logout', function () {
	Auth::logout();
	return redirect('/');
});
<<<<<<< HEAD

Route::post('/borrar/{categoria}/{elemento}','ABMController@borrar');
=======
>>>>>>> 4427fc34ac20ea44be06c17a6795834677a97b91

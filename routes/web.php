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

Route::get('/logout', function () {
	Auth::logout();
	return redirect('/');
});

Route::get('/admin', function () {
    return view('admin/admin',['personalizables' => \App\Personalizables::all(), 'elementos' => \App\Personalizables::elementos()]);
})->middleware('admin');

Route::get('/admin/crearCategoria', function () {
    return view('admin/crearCategoria');
})->middleware('admin');
Route::get('/crearElemento/{categoria}', 'ABMController@categoriaVista')->middleware('admin');

Route::post('/crearCategoria','ABMController@crearCategoria')->middleware('admin');
Route::post('/crearElemento','ABMController@crearElemento')->middleware('admin');

Route::post('/eliminarCategoria','ABMController@eliminarCategoria')->middleware('admin');
Route::post('/eliminarElemento','ABMController@eliminarElemento')->middleware('admin');
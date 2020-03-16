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

Route::middleware(['auth'])->group(function () {
   
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/misCotizacionesP','CotizacionController@misCotizacionesP')->name('misCotizacionesP');

//Rutas Cliente
Route::get('clientes/index','ClienteController@index')->name('clientes.index');
Route::get('clientes/create','ClienteController@create')->name('clientes.create');
Route::post('clientes/store','ClienteController@store')->name('clientes.store');
Route::get('clientes/edit/{id}','ClienteController@edit')->name('clientes.edit');
Route::put('clientes/update/{id}','ClienteController@update')->name('clientes.update');
Route::delete('clientes/delete/{id}','ClienteController@destroy')->name('clientes.destroy');
Route::post('clientes/storefromcotizacion','ClienteController@fromCotizacion')->name('cliente.fromCotizacion');

//Se hará modificaciones a las rutas de clientes

//Rutas Cotizaciones
Route::get('cotizaciones/index','CotizacionController@index')->name('cotizaciones.index');
Route::get('cotizaciones/finalizadas','CotizacionController@finalizadas')->name('cotizaciones.finalizadas');
Route::get('cotizaciones/vendidas','CotizacionController@vendidas')->name('cotizaciones.vendidas');
Route::get('cotizaciones/create','CotizacionController@create')->name('cotizaciones.create');
Route::post('cotizaciones/store','CotizacionController@store')->name('cotizaciones.store');
Route::get('cotizaciones/edit/{id}','CotizacionController@show')->name('cotizaciones.show');
Route::post('cotizaciones/addIti', 'CotizacionController@addIti')->name('cotizaciones.addIti');
Route::delete('cotizaciones/destroyIti/{id}','CotizacionController@destroyIti')->name('cotizaciones.destroyIti');
Route::put('cotizaciones/finalizar/{id}','CotizacionController@updateCotizacion')->name('cotizaciones.updateStatus');
Route::put('cotizaciones/vendido/{id}','CotizacionController@vendido')->name('cotizaciones.vendido');
Route::delete('cotizaciones/delete/{id}','CotizacionController@deleteCotizacion')->name('cotizaciones.deleteCotizacion');
Route::put('cotizaciones/edit/{id}','CotizacionController@editCotizacion')->name('cotizaciones.edit');
});

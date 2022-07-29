<?php

use App\Http\Controllers\prestador_s;
use App\Http\Controllers\servicios;
use App\Http\Controllers\user_n;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('index');




Auth::routes();

Auth::routes();



Route::group(['middleware' => 'auth'], function () {
	Route::group(['middleware' => 'valUser'], function() {
		Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
		Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
		Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
		Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
		Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
		Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
		Route::get('map', function () {return view('pages.maps');})->name('map');
		Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
		Route::get('table-list', function () {return view('pages.tables');})->name('table');
		Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
		Route::get("/servicios", [servicios::class, 'vista'])->name("crud_servicios");
		Route::get("/servicios_listar", [servicios::class, 'listar']);
		Route::post("/servicio_guardar", [servicios::class, 'guardar']);
		Route::post("/servicio_editar", [servicios::class, 'editar']);
		Route::delete("/servicio_eliminar/{id}", [servicios::class, 'eliminar']);
		Route::get("/verIMG/{id}", [AlimentosController::class, 'verArchivos']);
	});
	Route::get("/usuarioEspec", [user_n::class, 'usuarioEspec']);

	Route::group(['middleware' => 'pasado'], function() {
		Route::get('/registroDual', function () {
			return view('pages.regisDual');
		})->name('registroDual');

		Route::post("/clienteGuardar", [user_n::class, 'guardar2'])->name('validacionClient');
		Route::post("/negocioGuardar", [prestador_s::class, 'guardar2'])->name('validacionNegocio');
	});
});


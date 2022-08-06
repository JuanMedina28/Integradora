<?php

use App\Http\Controllers\carrito;
use App\Http\Controllers\detalle_v;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\prestador_s;
use App\Http\Controllers\Profile_2;
use App\Http\Controllers\servicios;
use App\Http\Controllers\user_n;
use App\Models\m_pservicio;
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
		Route::get("/servicios_listar2", [servicios::class, 'listar2']);
		Route::post("/servicio_guardar", [servicios::class, 'guardar']);
		Route::post("/servicio_editar", [servicios::class, 'editar']);
		Route::post("/servicio_baja/{id}", [servicios::class, 'eliminar']);
		Route::get("/verIMG/{id}", [servicios::class, 'verArchivos']);

		Route::get("/negocios", [prestador_s::class, 'vista'])->name('crud_negocios');
		Route::get("/negocios_listar1", [prestador_s::class, 'listar1']);
		Route::get("/negocios_listar2", [prestador_s::class, 'listar2']);
		Route::post("/negocio_baja/{id}", [prestador_s::class, 'baja']);

		Route::get("/clientes", [InicioController::class, 'vista'])->name('crud_clientes');

		Route::get("/usuarios", [user_n::class, 'vista'])->name('crud_usuarios');
		Route::get("/usuarios_listar", [user_n::class, 'listar']);
		Route::post("/usuarios_editar", [user_n::class, 'editar']);
		Route::post("/usuarios_guardar", [user_n::class, 'guardar']);
		Route::post("/usuarios_baja/{id}", [user_n::class, 'eliminar']);
		Route::get("/usuarios_filtrar", [user_n::class, 'filtro']);
		Route::get("/usuarios_filtrar2", [user_n::class, 'filtro2']);

		Route::get("/negocios_filtrar", [prestador_s::class, 'filtro']);
		Route::get("/negocios_filtrar2", [prestador_s::class, 'filtro2']);

		Route::get("/pedidos", [detalle_v::class, 'vista'])->name('pedidos');
		Route::get("/compras", [detalle_v::class, 'vista2'])->name('compras');
		Route::get("/compras_listar", [detalle_v::class, 'lista_ventas']);
		Route::get("/compras_listar2", [detalle_v::class, 'lista_ventas2']);
		Route::get("/compras_listar3", [detalle_v::class, 'lista_ventas3']);
		Route::get("/items_carrito", [detalle_v::class, 'lista_vcar']);
		Route::get("/items_carrito2", [detalle_v::class, 'lista_vcar2']);
		Route::post("/compras_borrar", [detalle_v::class, 'eliminar_venta2']);

		

		Route::get("/carrito", [carrito::class, 'vista'])->name('carrito');

		Route::post("/procesarPagos", [carrito::class, 'pagar_venta2']);
		Route::get("/items", [carrito::class, 'lista_carrito']);
		Route::post("/carrito_guardar", [carrito::class, 'guardar_c2']);
		Route::post("/newItem", [detalle_v::class, 'guardar_venta2']);
		Route::post("/deleteItem", [carrito::class, 'eliminar_carrito2']);

		Route::post("/modificarFotoPerfil",[Profile_2::class, 'foto']);
		Route::get("/consulta",[Profile_2::class, 'nose']);
		Route::post("/nameEmail",[Profile_2::class, 'nameEmail']);
		Route::post("/pModify",[Profile_2::class, 'password']);

		Route::get('/servicios_filtrar', [servicios::class, 'filtro']);

	});
	
	Route::get("/usuarioEspec", [user_n::class, 'usuarioEspec']);
	Route::get("/inicio", [InicioController::class, 'vista'])->name('inicio');

	Route::group(['middleware' => 'pasado'], function() {
		Route::get('/registroDual', function () {
			return view('pages.regisDual');
		})->name('registroDual');

		Route::post("/clienteGuardar", [user_n::class, 'guardar2'])->name('validacionClient');
		Route::post("/negocioGuardar", [prestador_s::class, 'guardar2'])->name('validacionNegocio');
	});
});


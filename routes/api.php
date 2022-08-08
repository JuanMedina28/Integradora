<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\carrito;
use App\Http\Controllers\consumidores;
use App\Http\Controllers\detalle_v;
use App\Http\Controllers\prestador_s;
use App\Http\Controllers\servicios;
use App\Http\Controllers\user_n;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/guardar',
    [user_n::class,'guardar_us']  
);

Route::post('user/guardar2',
    [user_n::class,'guardar_us2']  
)->middleware("auth:api");

Route::post('user/guardar3',
    [user_n::class,'guardar_us3']  
)->middleware("auth:api");

Route::post('user/pser',
    [prestador_s::class,'g_pser']  
);

Route::get('user/ver',
    [user_n::class,'l_user']  
)->middleware("auth:api");

Route::get('user/listar',
    [user_n::class,'listar_user']  
)->middleware("auth:api");

Route::get('ps/listar',[prestador_s::class,'listar_ps'])->middleware("auth:api");

Route::get('ps/listar_negocios',
    [prestador_s::class,'listar_ps']  
)->middleware("auth:api");

Route::get('ps/listar_nego',
    [prestador_s::class,'listar_unps']  
)->middleware("auth:api");

Route::post('ps/buscar',
    [prestador_s::class,'buscar_ps']  
)->middleware("auth:api");

Route::get('ps/listarrz',
[prestador_s::class,'listar_psrz']  
)->middleware("auth:api");

Route::post('servicios/guardar',
    [servicios::class,'guardar_serv']  
)->middleware("auth:api");

Route::post('servicios/guardar_sol',
    [servicios::class,'guardar_sol']  
)->middleware("auth:api");

Route::get('servicios/listar',
    [servicios::class,'listar_serv']  
)->middleware("auth:api");

Route::post('servicios/listar_tipo',
    [servicios::class,'listar_serv_tipo']  
)->middleware("auth:api");

Route::post('servicios/buscar',
    [servicios::class,'listar_busqueda']  
)->middleware("auth:api");

Route::post('servicios/buscar2',
    [servicios::class,'listar_busqueda2']  
)->middleware("auth:api");

Route::get('servicios/listar2',
    [servicios::class,'listar_serv2']  
)->middleware("auth:api");

Route::get('servicios/listar3',
    [servicios::class,'listar_serv3']  
)->middleware("auth:api");

Route::get('servicios/listar4',
    [servicios::class,'listar_serv4']  
)->middleware("auth:api");

Route::post('servicios/eliminar',
    [servicios::class,'eliminar_serv']  
)->middleware("auth:api");

/*--------------------------Ventas---------------------------*/
Route::post('ventas/guardar',
    [detalle_v::class,'guardar_venta']  
)->middleware("auth:api");

Route::post('ventas/guardar2',
    [detalle_v::class,'guardar_venta2']  
)->middleware("auth:api");

Route::post('ventas/eliminar',
    [detalle_v::class,'eliminar_venta']  
)->middleware("auth:api");

Route::get('ventas/lista',
    [detalle_v::class,'lista_ventas']  
)->middleware("auth:api");

Route::get('ventas/lista_nego',
    [detalle_v::class,'lista_venta_nego']  
)->middleware("auth:api");

Route::post('ventas/fecha',
    [detalle_v::class,'validar_fecha']  
)->middleware("auth:api");

Route::post('ventas/pago_op',
    [detalle_v::class,'pago_openpay']  
)->middleware("auth:api");

Route::post('ventas/pagar',
    [carrito::class,'pagar_venta']  
)->middleware("auth:api");

Route::post('ventas/pagar2',
    [carrito::class,'concluir']  
)->middleware("auth:api");

Route::post('carrito/guardar',
    [carrito::class,'guardar_c']  
)->middleware("auth:api");

Route::post('carrito/guardar2',
    [carrito::class,'guardar_c2']  
)->middleware("auth:api");

Route::post('carrito/eliminar',
    [carrito::class,'eliminar_carrito']  
)->middleware("auth:api");

Route::get('carrito/lista',
    [carrito::class,'lista_carrito']  
)->middleware("auth:api");




Route::post('login', function (Request $request) {

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

        $user = Auth::user();

        //$success ['token'] = $user->create Token ('MyApp')-> accessToken; //$success['name'] = $user->name;

        $arr = array('acceso' => "Ok", 'error' => "", 'token' => $user->createToken('MyApp')->accessToken, 't_us' => $user->tipo_us);
        return json_encode($arr);
    } else {

        $arr = array('acceso' => "", 'error' => "No existe el usuario o contraseña", 'token' => "");

        return json_encode($arr);
    }
});

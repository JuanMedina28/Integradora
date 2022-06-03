<?php

use App\Http\Controllers\Auth\RegisterController;
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

Route::post('servicios/guardar',
    [servicios::class,'guardar_serv']  
)->middleware("auth:api");

Route::post('login', function (Request $request) {

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

        $user = Auth::user();

        //$success ['token'] = $user->create Token ('MyApp')-> accessToken; //$success['name'] = $user->name;

        $arr = array('acceso' => "Ok", 'error' => "", 'token' => $user->createToken('MyApp')->accessToken);
        return json_encode($arr);
    } else {

        $arr = array('acceso' => "", 'error' => "No existe el usuario o contraseña", 'token' => "");

        return json_encode($arr);
    }
});

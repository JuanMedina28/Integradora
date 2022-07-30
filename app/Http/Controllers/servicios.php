<?php

namespace App\Http\Controllers;

use App\Models\m_carrito;
use App\Models\m_servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class servicios extends Controller
{
    public function listar_serv(){

        $serv = DB::table('servicio')->where('id_us', Auth::user()->id)
        ->select('servicio.*')
        ->get();
        return $serv;
    }

    public function listar_serv_tipo(Request $request){

        $serv = DB::table('servicio')
        ->join("users", "users.id", "=", "servicio.id_us")
        ->join("pservicio", "pservicio.id_us", "=", "users.id")
        ->where('pservicio.tipo_ser', $request->tipo_ser)
        ->select('servicio.*', 'pservicio.tipo_ser as tipo')
        ->get();
        return $serv;
    }

    public function listar_busqueda(Request $request){

        $serv = DB::table('servicio')
        ->where('tipo_serv','like', '%'.$request->tipo_ser.'%')
        ->orwhere('des','like', '%'.$request->tipo_ser.'%')
        ->select('servicio.*')
        ->get();
        return $serv;
    }

    public function listar_serv2(){

        $serv = m_servicio::all();
        return $serv;
    }

    public function eliminar_serv(Request $request){
        $car = m_carrito::where('id_serv', $request->id);
        $car->delete();

        $ser = m_servicio::where('id', $request->id);
        $ser->delete();   
    }

    public function guardar_serv(Request $request){

       
        if($request->id==null||$request->id==0){
            $serv = new m_servicio();
        }else{
            $serv = m_servicio::find($request->id);
        }
        
        $serv->tipo_serv =$request->tipo_serv;
        $serv->des =$request->des;
        $serv->precio =$request->precio;
        if($request->url_img != null){
            if($request->file('url_img')->isValid()){
                $ruta_archivo = $request->file('url_img')->store('imagenes','public');
                $serv->url_img =$ruta_archivo;
            }
        }else{
            $serv->url_img ="Sin Aplicar";
        }
        $serv->nombre_libro="No aplica";
        $serv->id_us =Auth::user()->id;
        $serv->save();

        return $serv;
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\m_carrito;
use App\Models\m_servicio;
use App\Models\User;
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
        ->where('tipo_serv','ilike', '%'.$request->tipo_ser.'%')
        ->orwhere('des','ilike', '%'.$request->tipo_ser.'%')
        ->select('servicio.*')
        ->get();
        return $serv;
    }

    public function listar_busqueda2(Request $request){

        $serv = DB::table('servicio')
        ->where('tipo_serv','ilike', '%'.$request->tipo_ser.'%')
        ->orwhere('des','ilike', '%'.$request->tipo_ser.'%')
        ->select('servicio.*')->where('id_us', Auth::user()->id)
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
        return $car;
    }

    public function guardar_serv(Request $request){

       
        if($request->id==null||$request->id==0){
            $serv = new m_servicio();
            $serv->tipo_serv =$request->tipo_serv;
            $serv->des =$request->des;
            $serv->nombre_libro="No Aplica";
            $serv->precio =$request->precio;
            if($request->url_img != null || $request->url_img != 'No Aplica'){
                if($request->file('url_img')->isValid()){
                    $ruta_archivo = $request->file('url_img')->store('imagenes','public');
                    $serv->url_img =$ruta_archivo;
                }
            }else{
                $serv->url_img =$request->url_img;
            }
            $serv->id_us =Auth::user()->id;
            $serv->save();
    
            return 'Guardado con exito'.$serv;

        }else{
            $serv = m_servicio::where('id',$request->id)->first();
            $serv->tipo_serv =$request->tipo_serv;
            $serv->des =$request->des;
            $serv->nombre_libro="No Aplica";
            $serv->precio =$request->precio;
            $serv->url_img =$request->url_img;
            $serv->id_us =Auth::user()->id;
            $serv->save();
    
            return 'Se guardo el cambio'.$serv;
        }

        return 'Algo salio mal';
       
    }

    /*------------------------------------------Solicitudes de Servicio------------------------------*/

    public function guardar_sol(Request $request){

        $pserv= $serv = DB::table('pservicio')
            ->join("users", "users.id", "=", "pservicio.id_us")
            ->where('pservicio.id_us', $request->id_ps)
            ->select('pservicio.*')
            ->get();
            
            $serv = new m_servicio();
            $serv->tipo_serv =$request->tipo_serv;
            $serv->des =$request->des;
            $serv->solicitud="si";
            $serv->precio ="";
            $serv->nombre_libro="No Aplica";
            $serv->id_us =$pserv->id;
            $serv->url_img ="imagenes/logo.jpg";
            $serv->save();

            $sol = new m_solicitud();
            $sol->id_us_cli= Auth::user()->id;
            $sol->id_ps=$request->id_ps;
            $sol->save();

            return 'Todo salio bien';
    }

    public function listar_serv3(){

        $user = User::where('id', Auth::user()->id)->first();

        $serv = DB::table('servicio')
        ->join("users", "users.id", "=", "servicio.id_us")
        ->join("pservicio", "pservicio.id_us", "=", "users.id")
        ->where('users.municipio',$user->municipio )
        ->select('servicio.*','users.municipio as muni' )
        ->get();
        return $serv;
    }




        /*------------------------------------------Fin Solicitudes de Servicio------------------------------*/


}

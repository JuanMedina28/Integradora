<?php

namespace App\Http\Controllers;

use App\Models\m_carrito;
use App\Models\m_servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class servicios extends Controller
{
    public function listar_serv(){

        $serv = DB::table('servicio')->where('id_us', Auth::user()->id)
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
    
    /*Funciones para web*/ 
    public function vista(){
        return view('pages.servicios');
    }

    public function listar(Request $request){

        $filtro = $request->buscador;

        

        if($request->user()->tipo_us == 1){

            if($filtro!=null){
                $usuarios =  m_servicio::join('users','users.id','=','servicio.id_us')
                ->select("servicio.*",'users.name as nego_name')
                ->where('tipo_serv', 'like', '%'.$filtro.'%')
                ->get();
                if($usuarios!=null){
                    //$usuarios = User::all();
                }else{
                    $usuarios = m_servicio::join('users','users.id','=','servicio.id_us')
                    ->select("servicio.*",'users.name as nego_name')
                    ->get();
                }
            }else{
                $usuarios = m_servicio::join('users','users.id','=','servicio.id_us')
                    ->select("servicio.*",'users.name as nego_name')
                    ->get();
            }

            return $usuarios;


        }else{

            return m_servicio::join('users','users.id','=','servicio.id_us')
        ->select("servicio.*",'users.name as nego_name')
        ->where('users.id', '=', $request->user()->id)
        ->get();

        }

        
    }

    public function listar2(){
        

        return m_servicio::join('users','users.id','=','servicio.id_us')
        ->join('pservicio', 'users.id', '=', 'pservicio.id_us')
        ->select("servicio.*",'pservicio.tipo_ser as nego_name')
        ->get();
        
    }

    public function guardar(Request $request){
        $nuevoServicio = new m_servicio();
        $nuevoServicio->id_us=$request->id_us;
        $nuevoServicio->nombre_libro="No aplica";
        $nuevoServicio->precio=$request->precio;
        $nuevoServicio->des=$request->des;
        $nuevoServicio->tipo_serv=$request->tipo_serv;
        if($request->url_img != null){
            if($request->file('url_img')->isValid()){
                $ruta_archivo = $request->file('url_img')->store('imagenes','public');
                $nuevoServicio->url_img =$ruta_archivo;
            }
        }else{
            $nuevoServicio->url_img ="Sin Aplicar";
        }

        //Validación si es un tipo negocio el que inserta
        if($request->user()->tipo_us == 2){
            $aux = DB::table('users')->where('id', $request->user()->id)->first();
            $nuevoServicio->id_us = $aux->id;
        }
        $nuevoServicio->save();
    }
    public function editar(Request $request){
        $servicio = m_servicio::find($request->id);
        //$alimento->id_negocio = $request->id_negocio;
        $servicio->nombre_libro="No aplica";
        $servicio->precio = $request->precio;
        $servicio->des = $request->des;
        $servicio->tipo_serv=$request->tipo_serv;
        if($request->file('url_img')!=null){
            $servicio->url_img = $request->file('url_img')->store('imagenes','public');
        }

        $servicio->save();
    }
    public function verArchivos($id){
        $servicio = m_servicio::find($id);
        $ruta = 'public/'.$servicio->url_img;
        return Storage::download($ruta);
    }
    public function eliminar($id){
        $servicio = m_servicio::find($id);
        $servicio->delete();
    }

}

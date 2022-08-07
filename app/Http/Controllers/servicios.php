<?php

namespace App\Http\Controllers;

use App\Models\m_carrito;
use App\Models\m_servicio;
use App\Models\m_solicitud;
use App\Models\User;
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
    
    /******************Funciones para web******************/ 
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
                    ->select("servicio.*",'users.name as nego_name','users.status as statusn')
                    ->get();
                }
            }else{
                $usuarios = m_servicio::join('users','users.id','=','servicio.id_us')
                    ->select("servicio.*",'users.name as nego_name','users.status as statusn')
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

    public function listar2(Request $request){
        
        $filtro = $request->buscador;

        if($filtro!=null){
            $usuarios =  m_servicio::join('users','users.id','=','servicio.id_us')
            ->join('pservicio', 'users.id', '=', 'pservicio.id_us')
            ->select("servicio.*",'pservicio.tipo_ser as nego_name')
            ->where('tipo_serv', 'ilike', '%'.$filtro.'%')
            ->orWhere('tipo_ser', 'ilike', '%'.$filtro.'%')
            ->get();
            if(empty($usuarios)){
                $usuarios = m_servicio::join('users','users.id','=','servicio.id_us')
                ->join('pservicio', 'users.id', '=', 'pservicio.id_us')
                ->select("servicio.*",'pservicio.tipo_ser as nego_name')
                ->get();
            }
            
        }else{
            $usuarios = m_servicio::join('users','users.id','=','servicio.id_us')
            ->join('pservicio', 'users.id', '=', 'pservicio.id_us')
            ->select("servicio.*",'pservicio.tipo_ser as nego_name')
            ->get();
        }

        return $usuarios;

        
        
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
    public function eliminar($idn){

        $usuario = m_servicio::find( $idn);

        $userl = User::find($usuario->id_us);

        if($userl->status == 2){
            $userl->status = 1;
        }else{
            $userl->status = 2;
        }

        $userl->save();

        
    }

    public function filtro(Request $request){
        $filtro = $request->key;

        if($filtro != 7){
            if($filtro == 1){
                $filtro = 'Ingeribles - Alimentos y bebidas.';
            
            }
            if($filtro == 2){
                $filtro = 'Ambiente - Sonido y luces.';
            
            }
            if($filtro == 3){
                $filtro = "Música - Músicos y DJ's.";
            
            }
            if($filtro == 4){
                $filtro = 'Decoración - Exteriores e interiores.';
            
            }
            if($filtro == 5){
                $filtro = 'Extras- Hileras, tortilleros, centros de mesa, recuerdos, etc.';
            
            }
            if($filtro == 6){
                $filtro = 'Personal de servicio - Exteriores e interiores.';
            
            }
            $usuarios =  m_servicio::join('users','users.id','=','servicio.id_us')
            ->join('pservicio', 'users.id', '=', 'pservicio.id_us')
            ->select("servicio.*",'pservicio.tipo_ser as nego_name')
            ->where('pservicio.tipo_ser', 'ilike', '%'.$filtro.'%')
            ->get();
        }else{
            $usuarios = m_servicio::join('users','users.id','=','servicio.id_us')
            ->join('pservicio', 'users.id', '=', 'pservicio.id_us')
            ->select("servicio.*",'pservicio.tipo_ser as nego_name')
            ->get();

        }
        return $usuarios;
    }
    /***************************Fin Funciones WEB************ */

    ///////////

}

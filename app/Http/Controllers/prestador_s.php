<?php

namespace App\Http\Controllers;

use App\Models\m_pservicio;
use App\Models\User;
use Illuminate\Http\Request;

class prestador_s extends Controller
{
    public function g_pser(Request $request){
        
        $us=User::where('email',$request->email)->where('status',1)->first();
        if($us){  
            $pser = new m_pservicio();
            $pser->razon_social =$request->razon_social;
            $pser->url_com_dom ="Sin Aplicar";
            $pser->url_logo ="Sin Aplicar";
            $pser->rfc =$request->rfc;
            $pser->tipo_ser =$request->tipo_ser;
            $pser->id_us =$us->id;
            $pser->save();
            return $pser; 
        }
        return "No";
                   
    }
    public function guardar2(Request $request){

        $pser = new m_pservicio();
        
        $pser->razon_social =$request->razon_social;
        $pser->url_com_dom ="Sin Aplicar";
            if($request->url_logo != null){
                if($request->file('url_logo')->isValid()){
                    $ruta_archivo = $request->file('url_logo')->store('imagenes','public');
                    $pser->url_logo =$ruta_archivo;
                }
            }else{
                $pser->url_logo ="Sin Aplicar";
            }
            
        $pser->rfc = $request->rfc;
        $pser->tipo_ser = $request->tipo_ser;
        $pser->id_us = $request->user()->id;

        $userModify = User::find($request->user()->id);
        $userModify->celular = $request->celular;
        $userModify->tipo_us = 2;
        $userModify->status = 1;
        if($request->url_logo != null){
            if($request->file('url_logo')->isValid()){
                $ruta_archivo = $request->file('url_logo')->store('imagenes','public');
                $userModify->url_img_us =$ruta_archivo;
            }
        }else{
            $userModify->url_img_us ="Sin Aplicar";
        }
        $userModify->save();

        $pser->save();
    }
    public function listar2(){
        return m_pservicio::join('users','users.id','=','pservicio.id_us')
        ->select("pservicio.*",'users.celular as nego_celular', 'users.email as nego_email')
        ->get();
    }
}

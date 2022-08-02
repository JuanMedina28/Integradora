<?php

namespace App\Http\Controllers;

use App\Models\m_pservicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $pser->des ="Sin descripcion";
            $pser->save();
            return $pser; 
        }
        return "No";
                   
    }

    public function listar_psrz(){

        $us = DB::table('pservicio')
        ->select('pservicio.razon_social')
        ->where('id_us', Auth::user()->id)
        ->get();
        //$us=m_user::where('id',Auth::user()->id)->first();
        //$us= User::all();
        return $us;
    }

    public function listar_unps(){

        $us = DB::table('pservicio')
        ->select('pservicio.*')
        ->where('id_us', Auth::user()->id)
        ->get();
        return $us;
    }

    public function listar_ps(){
        $ps= m_pservicio::all();
        return $ps;
    }

    public function buscar_ps(Request $request){
        $ps= DB::table('pservicio')
        ->where('tipo_ser','like', '%'.$request->tipo_ser.'%')
        ->orwhere('razon_social','like', '%'.$request->tipo_ser.'%')
        ->select('pservicio.*')
        ->get();
        return $ps;
    }

}

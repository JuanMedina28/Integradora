<?php

namespace App\Http\Controllers;

use App\Models\m_pservicio;
use App\Models\User;
use Illuminate\Http\Request;

class prestador_s extends Controller
{
    public function guardar_pser(Request $request){
        
        $us=User::where('email',$request->email)->where('status',1)->first();
        if($us){  
            $pser = new m_pservicio();
            $pser->razon_social =$request->razon_social;
            $pser->calle =$request->calle;
            $pser->numero =$request->numero;
            $pser->municipio =$request->municipio;
            $pser->estado =$request->estado;
            $pser->cp =$request->cp;
            $pser->url_com_dom ="Sin Aplicar";
            $pser->url_logo ="Sin Aplicar";
            $pser->n_iden =$request->n_iden;
            $pser->rfc =$request->rfc;
            $pser->num_casa ="Sin Numero";
            $pser->celular =$request->celular;
            $pser->id_us =$us->id;
            $pser->save();
        }
            return $pser;        
    }
}

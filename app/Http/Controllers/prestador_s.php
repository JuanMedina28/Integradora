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
}

<?php

namespace App\Http\Controllers;

use App\Models\m_consumidor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class consumidores extends Controller
{

    /**Guardar datos consumidor
     * Esta funcion guarda los datos de un consumidor 
     * */
    public function guardar_cons(Request $request){

        $us=User::where('email',$request->email)->where('status',1)->first();
        if($us){   
            $consu = new m_consumidor();
            $consu->calle =$request->calle;
            $consu->numero =$request->numero;
            $consu->municipio =$request->municipio;
            $consu->estado =$request->estado;
            $consu->cp =$request->cp;
            $consu->n_iden =$request->n_iden;
            $consu->num_casa ="Sin Numero";
            $consu->celular =$request->celular;
            $consu->id_us =$us->id;
            $consu->save();
        }
            return $consu;        
    }
}

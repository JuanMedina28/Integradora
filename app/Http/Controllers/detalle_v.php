<?php

namespace App\Http\Controllers;

use App\Models\m_detalle_venta;
use App\Models\m_servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class detalle_v extends Controller
{
    /***************************Guardar Venta*************************** */
    public function guardar_venta(Request $request){

        $sventa=m_detalle_venta::where('id_user',Auth::user()->id)->where('status',1)->first();

        if($sventa){
            $dventa = m_detalle_venta::find($sventa->id);
            $dventa->cant = $sventa->cant+1;
            $ser=m_servicio::where('id',$request->id_ser)->first();
            $dventa->total =$dventa->total+$ser->precio;
            $dventa->fecha = date("Y/m/d");
        }else{            
            $dventa = new m_detalle_venta();
            $dventa->fecha = date("Y/m/d"); 
            $dventa->status =$request->status;
            $dventa->cant = 1; 
            $dventa->id_user =Auth::user()->id;
            $ser=m_servicio::where('id',$request->id_ser)->first();  
            $dventa->total =$ser->precio; 
        }
        
        $dventa->save();
    }

    /*********************************Fin Guardar Venta************************* */

}

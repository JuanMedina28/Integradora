<?php

namespace App\Http\Controllers;

use App\Models\m_detalle_venta;
use App\Models\m_servicio;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Openpay\Data\Openpay;
use Openpay\Data\OpenpayApiAuthError;
use Openpay\Data\OpenpayApiConnectionError;
use Openpay\Data\OpenpayApiError;
use Openpay\Data\OpenpayApiRequestError;
use Openpay\Data\OpenpayApiTransactionError;

class detalle_v extends Controller
{
    /***************************Guardar Venta*************************** */
    public function guardar_venta(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        if ($sventa) {
            $dventa = m_detalle_venta::find($sventa->id);
            $dventa->cant = $sventa->cant + 1;
            $ser = m_servicio::where('id', $request->id_ser)->first();
            $dventa->total = $dventa->total + $ser->precio;
            $dventa->fecha = date("Y/m/d");
            $dventa->save();
            return $dventa;
        } else {
            $dventa = new m_detalle_venta();
            $dventa->no_venta = "No Aplica";
            $dventa->fecha = date("Y/m/d");
            $dventa->status = $request->status;
            $dventa->cant = 1;
            $dventa->id_user = Auth::user()->id;
            $ser = m_servicio::where('id', $request->id_ser)->first();
            $dventa->total = $ser->precio;
            $dventa->save();
            return $dventa;
        }

        
    }
    


    /*********************************Fin Guardar Venta************************* */

       /***************************Guardar Venta2*************************** */
       public function guardar_venta2(Request $request)
       {
   
           $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();
   
           if ($sventa) {
               $dventa = m_detalle_venta::find($sventa->id);
               $dventa->cant = $sventa->cant + 1;
               $ser = m_servicio::where('tipo_serv', $request->tipo_serv)->first();
               $dventa->total = $dventa->total + $ser->precio;
               $dventa->fecha = date("Y/m/d");
               $dventa->save();
               return $dventa;
           } else {
               $dventa = new m_detalle_venta();
               $dventa->no_venta = "No Aplica";
               $dventa->fecha = date("Y/m/d");
               $dventa->status = $request->status;
               $dventa->cant = 1;
               $dventa->id_user = Auth::user()->id;
               $ser = m_servicio::where('tipo_serv', $request->tipo_serv)->first();
               $dventa->total = $ser->precio;
               $dventa->save();
               return $dventa;
           }
   
           
       }
   
       /*********************************Fin Guardar Venta2************************* */
    


    /*********************************Lista Ventas****************************** */
    public function lista_ventas()
    {
        $ventas = DB::table('dventa')
            ->select('dventa.*')
            ->where('id_user', Auth::user()->id)
            ->orderBy('fecha', 'desc')
            ->orderBy('status', 'asc')
            ->get();

        return $ventas;
    }

    public function lista_venta_nego()
    {
        $lcarrito = DB::table('dventa')
            ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
            ->join("servicio", "servicio.id", "=", "carrito.id_serv")
            ->join("users", "users.id", "=", "dventa.id_user")
            ->join("pservicio", "pservicio.id_us", "=", "servicio.id_us")
            ->select('carrito.*','dventa.fevent2 as fevent2', 
            'dventa.fecha as fecha', 
            'servicio.tipo_serv as tipo',
            'users.name as name',
             'users.apaterno as ap', 
             'users.amaterno as am',
             'dventa.id as id_v',
             'dventa.status as st')
            ->where('pservicio.id_us', Auth::user()->id)
            ->orderBy('dventa.fecha', 'desc')
            ->get();

        return $lcarrito;
    }
    /****************************Fin Lista Ventas ********************************/

 /*********************************Validar fecha****************************** */
        public function validar_fecha(Request $request){
        
            $lcarrito = DB::table('dventa')
           ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
           ->join("servicio", "servicio.id", "=", "carrito.id_serv")
           ->select('carrito.*')
           ->where('dventa.fevent2',$request->fecha)
           ->where('carrito.status', 1)
           ->get();

           if($lcarrito){
               return "Ya existe una venta";
           }else{
               return "No existe una venta";
           }

   }

   /****************************validar fecha ********************************/

    /***************************eliminar Venta*************************** */
    public function eliminar_venta(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        if ($sventa) {
            $dventa = m_detalle_venta::find($sventa->id);
            if ($dventa->cant == 1) {

                $dventa->delete();
            } else {
                $dventa->cant = $sventa->cant - 1;
                $ser = m_servicio::where('id', $request->id_ser)->first();
                $dventa->total = $dventa->total - $ser->precio;
                $dventa->fecha = date("Y/m/d");
                $dventa->save();
            }
        }
    }

    /*********************************Fin Eliminar Venta************************* */

    /*+++++++++++++++++++++++++++++++++++++++++OPEN PAY+++++++++++++++++++++++++++++++++++++++++++++++ */

    public function pago_openpay(Request $request)
    {
        try {

            $openpay = Openpay::getInstance('mx969jutgahr3m09j5xz', 'sk_065a62c5c5ab42b59c52976d0ccc1d25', 'MX');
            Openpay::setProductionMode(false);

            $customer = array(
                'name' => 'Juan Jose2',
                'last_name'=>'Medina Montes',
                'phone'=>'5571706433',
                'email'=>'jonny.medina.2806@gmali.com',
            );

            $chargeData = array(
                'method' => 'card',
                'source_id' => $request->token_card,
                'currency' => 'MXN',
                'amount' => 1000,
                'send_email' => true,
                'description' => 'Cargo completo',
                'device_session_id'=>$request->id_device,
                'customer'=> $customer);
            
            $charge = $openpay->charges->create($chargeData);

            return 'Pago Completo: '.$charge->id.'\nStatus: '.$charge->status;

        } catch (OpenpayApiTransactionError $e) {
            return 'ERROR on the transaction: ' . $e->getMessage() .
                ' [error code: ' . $e->getErrorCode() .
                ', error category: ' . $e->getCategory() .
                ', HTTP code: ' . $e->getHttpCode() .
                ', request ID: ' . $e->getRequestId() . ']';
        } catch (OpenpayApiRequestError $e) {
            return 'ERROR on the request: ' . $e->getMessage();
        } catch (OpenpayApiConnectionError $e) {
            return 'ERROR while connecting to the API: ' . $e->getMessage();
        } catch (OpenpayApiAuthError $e) {
            return 'ERROR on the authentication: ' . $e->getMessage();
        } catch (OpenpayApiError $e) {
            return 'ERROR on the API: ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Error on the script: ' . $e->getMessage();
        }
    }

    /*************Funciones web*********** */
    public function vista(){
        return view('pages.pedidos');
    }

    public function vista2(){
        return view('pages.historial');
    }
    public function vsolicitud(){
        return view('pages.solicitudes');
    }
    public function lista_ventas2()
    {
        $tipus = User::find(Auth::user()->id);

        if($tipus->tipo_us == 1){
            $ventas = DB::table('dventa')
                ->select('dventa.*')
                ->where('status', 1)
                ->orderBy('fecha', 'desc')
                ->orderBy('status', 'asc')
                ->get();
        }else{
            $ventas = DB::table('dventa')
            ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
            ->join("servicio", "servicio.id", "=", "carrito.id_serv")
            ->join("users", "users.id", "=", "dventa.id_user")
            ->join("pservicio", "pservicio.id_us", "=", "servicio.id_us")
            ->select('carrito.*','dventa.fevent2 as fevent2', 
            'dventa.fecha as fecha', 
            'servicio.tipo_serv as tipo',
            'servicio.url_img as img',
            'users.name as name',
             'users.apaterno as ap', 
             'users.amaterno as am',
             'dventa.id as id_v',
             'dventa.status as st',
             'carrito.status as sta')
            ->where('pservicio.id_us', Auth::user()->id)
            ->where('carrito.status',2)
            ->orderBy('dventa.fecha', 'desc')
            ->get();
                
        }
        return $ventas;
    }
    public function lista_ventas3()
    {
        $tipus = User::find(Auth::user()->id);

        if($tipus->tipo_us == 1){
            $ventas = DB::table('dventa')
                ->select('dventa.*')
                ->where('status', 2)
                ->orderBy('fecha', 'desc')
                ->orderBy('status', 'asc')
                ->get();
        }else{
            $ventas = DB::table('dventa')
            ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
            ->join("servicio", "servicio.id", "=", "carrito.id_serv")
            ->join("users", "users.id", "=", "dventa.id_user")
            ->join("pservicio", "pservicio.id_us", "=", "servicio.id_us")
            ->select('carrito.*','dventa.fevent2 as fevent2', 
            'dventa.fecha as fecha', 
            'servicio.tipo_serv as tipo',
            'servicio.url_img as img',
            'users.name as name',
             'users.apaterno as ap', 
             'users.amaterno as am',
             'dventa.id as id_v',
             'dventa.status as st',
             'carrito.status as sta')
            ->where('pservicio.id_us', Auth::user()->id)
            ->where('carrito.status', 3)
            ->orderBy('dventa.fecha', 'desc')
            ->get();
                
        }
        return $ventas;
    }
    public function lista_vcar2(Request $request)
    {

         $lcarrito = DB::table('dventa')
            ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
            ->join("servicio", "servicio.id", "=", "carrito.id_serv")
            ->join("users", "users.id", "=", "servicio.id_us")
            ->join("pservicio", "pservicio.id_us", "=", "users.id")
            ->select('carrito.*', 'servicio.tipo_serv as tipo_serv', 'servicio.precio as precio', 'users.name as nom', 'pservicio.tipo_ser as cat', 'servicio.url_img as url_img')

            ->where('dventa.id', $request->carrito2)
            ->distinct('tipo_serv')
            ->get();
      
        return $lcarrito;
    }
    public function detalleVen(Request $request){

        $lcarrito = DB::table('dventa')
        ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
        ->join("servicio", "servicio.id", "=", "carrito.id_serv")
        ->join("users", "users.id", "=", "servicio.id_us")
        ->join("pservicio", "pservicio.id_us", "=", "users.id")
        ->select('carrito.*', 'servicio.tipo_serv as tipo_serv', 'servicio.precio as precio', 'users.name as nom', 'pservicio.tipo_ser as cat', 'servicio.url_img as url_img', 'carrito.status as sta')
        ->where('carrito.id_dventa', $request->carrito)
        ->distinct('tipo_serv')
        ->get();
        return $lcarrito;

    } 
    public function eliminar_venta2(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        if ($sventa) {
            $dventa = m_detalle_venta::find($sventa->id);
            if ($dventa->cant == 1) {

                $dventa->delete();
            } else {
                $dventa->cant = $sventa->cant - 1;
                $ser = m_servicio::where('id', $request->id_serv)->first();
                $dventa->total = $dventa->total - $ser->precio;
                $dventa->fecha = date("Y/m/d");
                $dventa->save();
            }
        }

        return $request;
    }
    public function guardar_dventa2(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        if ($sventa) {
            $dventa = m_detalle_venta::find($sventa->id);
            $dventa->cant = $sventa->cant + 1;
            $ser = m_servicio::where('id', $request->id)->first();
            $dventa->total = $dventa->total + $ser->precio;
            $dventa->fecha = date("Y/m/d");
        } else {
            $dventa = new m_detalle_venta();
            $dventa->no_venta = "No Aplica";
            $dventa->fecha = date("Y/m/d");
            $dventa->status = 1;
            $dventa->cant = 1;
            $dventa->id_user = Auth::user()->id;
            $ser = m_servicio::where('id', $request->id)->first();
            $dventa->total = $ser->precio;
        }

        $dventa->save();
    }
    public function lista_vcar(Request $request)
    {
       

         $lcarrito = DB::table('dventa')
            ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
            ->join("servicio", "servicio.id", "=", "carrito.id_serv")
            ->join("users", "users.id", "=", "servicio.id_us")
            ->join("pservicio", "pservicio.id_us", "=", "users.id")
            ->select('carrito.*', 'servicio.tipo_serv as tipo_serv', 'servicio.precio as precio', 'users.name as nom', 'pservicio.tipo_ser as cat', 'servicio.url_img as url_img')
   
            ->where('dventa.id', $request->carrito)
            ->distinct('tipo_serv')
            ->get();

        return $lcarrito;
    }
    /**************FIn Funciones Web********** */
}

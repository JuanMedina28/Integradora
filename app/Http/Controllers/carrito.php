<?php

namespace App\Http\Controllers;

use App\Models\m_carrito;
use App\Models\m_detalle_venta;
use App\Models\m_servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class carrito extends Controller
{
    /********************************Guardar carrito***************************** */

    public function guardar_c(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        $ser = m_servicio::where('id', $request->id_ser)->first();

        $carrito = m_carrito::where('id_serv', $ser->id)->where('status', 1)->first();

        if ($carrito && $sventa && $ser) {
            //$carrito2 = m_venta::where('id_dventa',$sventa->id)->find($request->id_libro);
            $carrito2 = m_carrito::where('id_dventa', $sventa->id)
                ->where('id_serv', $request->id_ser)
                ->first();
            $carrito2->scant = $carrito->scant + 1;
            $carrito2->save();
        } else {
            $carrito = new m_carrito();
            $carrito->id_serv = $ser->id;
            $carrito->id_dventa = $sventa->id;
            $carrito->scant = 1;
            $carrito->status = $request->status;
            $carrito->save();
        }
    }

    /**********************************Fin Guardar Carrito*********************** */

    /********************************Eliminar carrito***************************** */
    public function eliminar_carrito(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        $ser = m_servicio::where('id', $request->id_ser)->first();


        $carrito = m_carrito::where('id_serv', $ser->id)->first();

        if ($carrito && $sventa && $ser) {

            $carrito2 = m_carrito::where('id_dventa', $sventa->id)
                ->where('id_serv', $request->id_ser)
                ->first();
            if ($carrito->scant == 1) {
                $carrito2->delete();
            } else {
                $carrito2->scant = $carrito->scant - 1;
                $carrito2->save();
            }
        }
    }

    /**********************************Fin Eliminar Carrito*********************** */

    /**********************************Listar Carrito***************************** */

    public function lista_carrito()
    {

        $lcarrito = DB::table('carrito')
            ->join("servicio", "servicio.id", "=", "carrito.id_serv")
            ->select('carrito.*', 'servicio.tipo_serv as servicio', 'servicio.precio as precio')
            ->where('status', 1)
            ->distinct('tipo_serv')
            ->get();

        return $lcarrito;
    }

    /*********************************Fin Listar Carrito************************* */

    /*********************************Lista Ventas****************************** */
    public function lista_ventas()
    {
        $ventas = DB::table('dventa')
            ->select('dventa.*')
            ->where('id_user', Auth::user()->id)
            ->get();

        return $ventas;
    }

    /****************************Fin Lista Ventas ********************************/


    /***************************Guardar Venta*************************** */
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

    /***************************Pagar Venta*************************** */
    public function pagar_venta(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        if ($sventa) {
            $dventa = m_detalle_venta::find($sventa->id);
            $dventa->status = $request->status;
            $dventa->save();

            //$venta = m_venta::where('id_dventa', $request->id_pago)->where('status',1);
        }
        $venta = m_carrito::where('id_dventa', $request->id_pago)->where('status', 1)->get();

        if ($venta) {
            foreach ($venta as $ven) {
                $ven->status = 2;
                $ven->save();
            }
        }
    }

    /*********************************Fin Pagar Venta************************* */
}

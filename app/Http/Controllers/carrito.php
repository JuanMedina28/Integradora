<?php

namespace App\Http\Controllers;

use App\Models\m_carrito;
use App\Models\m_detalle_venta;
use App\Models\m_servicio;
use App\Models\m_user;
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
            $carrito2->stotal = $carrito->stotal + $ser->precio;
            $carrito2->save();
            return 'Carrito detalle existente';
        } else {
            $carrito3 = new m_carrito();
            $carrito3->id_serv = $ser->id;
            $carrito3->id_dventa = $sventa->id;
            $carrito3->scant = 1;
            $carrito3->stotal = $ser->precio;
            $carrito3->status = $request->status;
            $carrito3->save();
            return 'carrito nuevo';
        }
    }

    /**********************************Fin Guardar Carrito*********************** */

    /********************************Guardar carrito2***************************** */

    public function guardar_c2(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        $ser = m_servicio::where('tipo_serv', $request->tipo_serv)->first();

        $carrito = m_carrito::where('id_serv', $ser->id)->where('status', 1)->first();

        if ($carrito && $sventa && $ser) {
            //$carrito2 = m_venta::where('id_dventa',$sventa->id)->find($request->id_libro);
            $carrito2 = m_carrito::where('id_dventa', $sventa->id)
                ->where('id_serv', $request->id_ser)
                ->first();
            $carrito2->scant = $carrito->scant + 1;
            $carrito2->stotal = $carrito->stotal + $ser->precio;
            $carrito2->save();
            return 'Carrito detalle existente';
        } else {
            $carrito3 = new m_carrito();
            $carrito3->id_serv = $ser->id;
            $carrito3->id_dventa = $sventa->id;
            $carrito3->scant = 1;
            $carrito3->stotal = $ser->precio;
            $carrito3->status = $request->status;
            $carrito3->save();
            return 'carrito nuevo';
        }
    }

    /**********************************Fin Guardar Carrito2*********************** */

    /********************************Eliminar carrito***************************** */
    public function eliminar_carrito(Request $request)
    {

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        $ser = m_servicio::where('id', $request->id_ser)->first();

        $carrito = m_carrito::where('id_serv', $ser->id)->where('status', 1)->first();

        if ($carrito && $sventa && $ser) {

            $carrito2 = m_carrito::where('id_dventa', $sventa->id)
                ->where('id_serv', $request->id_ser)
                ->first();
            if ($carrito->scant == 1) {
                $carrito2->delete();
                return 'Carrito eliminado '.$carrito2;
            } else {
                $carrito2->scant = $carrito->scant - 1;
                $carrito2->save();
                return 'Carrito descontado '.$carrito;
            }
        }
        return 'Fallo el eliminar';
    }

    /**********************************Fin Eliminar Carrito*********************** */

    /**********************************Listar Carrito***************************** */

    public function lista_carrito()
    {

        $lcarrito = DB::table('dventa')
            ->join("carrito", "carrito.id_dventa", "=", "dventa.id")
            ->join("servicio", "servicio.id", "=", "carrito.id_serv")
            ->join("users", "users.id", "=", "servicio.id_us")
            ->join("pservicio", "pservicio.id_us", "=", "users.id")
            ->select('carrito.*', 'servicio.solicitud as solicitud','servicio.tipo_serv as tipo_serv', 'servicio.precio as precio', 'users.name as nom', 'pservicio.tipo_ser as cat', 'servicio.url_img as url_img')
            ->where('carrito.status', 1)
            ->where('dventa.status', 1)
            ->where('dventa.id_user', Auth::user()->id)
            ->distinct('tipo_serv')
            ->get();

        return $lcarrito;
    }

    /*********************************Fin Listar Carrito************************* */


    /***************************Pagar Venta*************************** */
    public function pagar_venta(Request $request)
    {
        $us = m_user::where('id', Auth::user()->id)->first();

        $sventa = m_detalle_venta::where('id_user', Auth::user()->id)->where('status', 1)->first();

        if ($sventa && $us) {
            $dventa = m_detalle_venta::find($sventa->id);
            $dventa->status = $request->status;
            $dventa->fevent2 = $request->fevent;
            /*-----------------------------------OpenPAY-------------------------------------------*/
            try {

                $openpay = Openpay::getInstance('mx969jutgahr3m09j5xz', 'sk_065a62c5c5ab42b59c52976d0ccc1d25', 'MX');
                Openpay::setProductionMode(false);

                $customer = array(
                    'name' => $us->name,
                    'last_name' => $us->apaterno,
                    'phone' => $us->celular,
                    'email' => $us->email,
                );
                $chargeData = array(
                    'method' => 'card',
                    'source_id' => $request->token_card,
                    'currency' => 'MXN',
                    'amount' => $sventa->total,
                    'send_email' => true,
                    'description' => 'Cantidad de servicios: ' . $sventa->cant,
                    'device_session_id' => $request->id_device,
                    'customer' => $customer
                );

                $charge = $openpay->charges->create($chargeData);

                if ($charge->status == 'completed') {
                    $dventa->save();

                    $venta = m_carrito::where('id_dventa', $request->id_pago)->where('status', 1)->get();
                    if ($venta) {
                        foreach ($venta as $ven) {
                            $ven->status = 2;
                            $ven->save();
                        }
                    }
                }

                return 'Pago Completo: '.$charge->id.', Status: '.$charge->status;

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

            /*-----------------------------------Fin OpenPAY-------------------------------------------*/
        }
    }

    /*********************************Fin Pagar Venta************************* */

    /***************************Concluir*************************** */
    public function concluir(Request $request)
    {

        $sventa = m_detalle_venta::where('id', $request->id_v)->where('status', 2)->first();

        if ($sventa) {
            $sventa->status = 3;
            $sventa->save();
            return 'Concluida';
             }
             return 'Fallo el Concluir'.$request->id_v;
    }
}

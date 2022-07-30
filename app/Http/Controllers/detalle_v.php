<?php

namespace App\Http\Controllers;

use App\Models\m_detalle_venta;
use App\Models\m_servicio;
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
        } else {
            $dventa = new m_detalle_venta();
            $dventa->no_venta = "No Aplica";
            $dventa->fecha = date("Y/m/d");
            $dventa->status = $request->status;
            $dventa->cant = 1;
            $dventa->id_user = Auth::user()->id;
            $ser = m_servicio::where('id', $request->id_ser)->first();
            $dventa->total = $ser->precio;
        }

        $dventa->save();
    }

    /*********************************Fin Guardar Venta************************* */


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

    /****************************Fin Lista Ventas ********************************/


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
}

<?php

namespace App\Http\Controllers;

use App\Models\m_pservicio;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Profile_2 extends Controller
{
    public function nameEmail(Request $request){
        //auth()->user()->id == 1
        if(auth()->user()->id==1){
            return 'Tu no puedes modificar estos datos por ser usuario root';
        }else{
            try {
            $userModify = User::find(auth()->user()->id);
            $userModify->name = $request->name;
            $userModify->email = $request->email;
            $userModify->save();
            return 'La información ha sido actualizada';
            }catch(Exception $e){
                return 'Lo sieto! Algo ha fallado:'.$e;
            }
        }
    }
 public function nose(){
    $pservicioModi = m_pservicio::where('id_us', '=', auth()->user()->id)->first();
    $userModify = User::find(auth()->user()->id);
    return $pservicioModi;
    
 }
    public function foto(Request $request){
        try {
            $pservicioModi = m_pservicio::where('id_us', '=', auth()->user()->id)->first();
            $userModify = User::find(auth()->user()->id);
                    if($request->url_img_us != null){
                        if($request->file('url_img_us')->isValid()){
                            $ruta_archivo = $request->file('url_img_us')->store('imagenes','public');
                            $userModify->url_img_us =$ruta_archivo;
                            $pservicioModi->url_logo = $ruta_archivo;
                        }
                    }else{
                        $userModify->url_img_us ="Sin Aplicar";
                    }      
            $userModify->save();
            $pservicioModi->save();
            return 'La información ha sido actualizada';
        }catch(Exception $e){
                return 'Lo sieto! Algo ha fallado:'.$e;
        }
    }
    public function password(Request $request){
        if(auth()->user()->id==1){
            return 'Tu no puedes modificar estos datos por ser usuario root';
        }else{
            $userModify = User::find(auth()->user()->id);
            
            if(Hash::check($request->passwordOld, $request->user()->password)){
                $aux = Hash::make($request->passwordOld);
                try {
                    $userModify->password = $aux;
                    $userModify->save();
                    return 'La información ha sido actualizada';
                }catch(Exception $e){
                        return 'Lo sieto! Algo ha fallado:'.$e;
                }
            }else{
                return 'La Contraseña Actual no coincide ';
            }
        }
    }
}

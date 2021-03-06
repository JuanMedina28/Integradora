<?php

namespace App\Http\Controllers;

use App\Models\m_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class user_n extends Controller
{
    public function listar_user(){

        $us = DB::table('users')
        ->select('users.*')
        ->where('id', Auth::user()->id)
        ->get();
        //$us=m_user::where('id',Auth::user()->id)->first();
        //$us= User::all();
        return $us;
    }

    public function l_user(){

        $us = DB::table('users')
        ->select('users.*')
        ->where('id', Auth::user()->id)
        ->get();
        return $us;
    }

    public function guardar_us(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ], [
            'name.required'=>'Nombre no puede estar vacio.',
            'name.string'=>'Nombre debe ser de texto.',
            'name.max'=>'Nombre debe tener menos de 255 letras',
            'email.required'=>'e-mail no puede estar vacio.',
            'email.string'=>'e-mail debe ser de texto.',
            'email.email'=>'El formato de e-mail no es correcto',
            'email.max'=>'e-mail debe tener menos de 255 caracteres',
            'email.unique'=>'e-mail ya existe',
            'password_confirmation.required'=>'Por favor ingrese una contrasena para confirmar',
            'password_confirmation.string'=>'Ingrese caracteres para la contrasena de confirmacion',
            'password_confirmation.min'=>'La contrasena de confirmacion debe ser de minimo 8 caracteres',
            'password.required'=>'Por favor ingrese una contrasena',
            'password.string'=>'Ingrese caracteres para la contraseaa',
            'password.min'=>'La contrasena debe ser de minimo 8 caracteres',
            'password.confirmed'=>'Las contrasenas no coinciden',
        ]);

        if($validator->fails()){

            return json_encode($validator->errors());
        }else{
            $user = new User();
        
            $user->name =$request->name;
            $user->apaterno =$request->apaterno;
            $user->amaterno =$request->amaterno;
            $user->status =$request->status;
            $user->tipo_us =$request->tipo_us;
            if($request->img_us != null){
            if($request->file('img_us')->isValid()){
                $ruta_archivo = $request->file('img_us')->store('imagenes','public');
                $user->url_img_us =$ruta_archivo;
            }
        }else{
            $user->url_img_us ="Sin Aplicar";
        }
            //$user->url_img_us ="Sin Aplicar";
            $user->email =$request->email;
            $user->celular =$request->celular;
            $user->edad =0;
            $user->password =Hash::make($request->password);
            $user->save();
            return $user;
        }
        
    }


    public function guardar_us2(Request $request){
        
            $user = User::where('id', Auth::user()->id)->first();
        
            $user->name =$request->name;
            $user->apaterno =$request->apaterno;
            $user->amaterno =$request->amaterno;
            $user->celular =$request->celular;
            $user->save();
            return $user;
    }

    public function guardar_us3(Request $request){
        
        $user = User::where('id', Auth::user()->id)->first();
    
        $user->calleyn =$request->calle;
        $user->n_iden =$request->no;
        $user->municipio =$request->cp;
        $user->cp =$request->mun;
        $user->save();
        return $user;
}

    public function listar_psrz(Request $request){

        $us = DB::table('pservicio')
        ->select('pservicio.razon_social')
        ->where('id_us', $request->id)
        ->get();
        //$us=m_user::where('id',Auth::user()->id)->first();
        //$us= User::all();
        return $us;
    }





}

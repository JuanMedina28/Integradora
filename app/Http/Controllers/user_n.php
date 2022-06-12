<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class user_n extends Controller
{
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
            $user->url_img_us ="Sin Aplicar";
            $user->email =$request->email;
            $user->password =Hash::make($request->password);
            $user->save();
            return $user;
        }
       
       
        

        
    }





}

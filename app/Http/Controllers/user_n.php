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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'=>'El campo name no puede estar vacio.',
            'name.string'=>'El campo name debe ser texto.',
            'name.max'=>'El campo name debe tener menos de 255 letras',
        ]);

        if($validator->fails()){

            return json_encode($validator->errors());
        }else{
            $user = new User();
        
            $user->name =$request->name;
            $user->email =$request->email;
            $user->password =Hash::make($request->password);
            $user->save();
        }
       
       
        

        
    }





}

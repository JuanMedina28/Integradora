<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function vista(){
        if(auth()->user()->tipo_us == 3){
            return view('pages.inicio');
        }else{
            return view('pages.inicioroot');
        }
    }
}

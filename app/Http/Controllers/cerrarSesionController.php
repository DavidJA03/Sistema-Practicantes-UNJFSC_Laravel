<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cerrarSesionController extends Controller
{
    public function cerrarSecion(){
        
        Auth::logout();
       return redirect()->route('login');
    }
}

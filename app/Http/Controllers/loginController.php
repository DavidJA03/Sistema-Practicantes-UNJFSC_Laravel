<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect()->route('panel');
        }
        return view('auth.login');
    } 

    public function login( loginRequest $request){
        
        if(!Auth::validate($request->only('email', 'password'))){
            return redirect()->to('login')->withErrors('Credenciales incorectas');
        }

        $user = Auth::getProvider()->retrieveByCredentials($request->only('email','password'));
        Auth::login($user);
        $persna = $user->persona;
        $tipoUsuario = $persna->rol_id;
        if($tipoUsuario == 4){
            return redirect()->route('panel.estudiantes');
        } elseif($tipoUsuario == 2) {
            return redirect()->route('panel');
        } elseif($tipoUsuario == 1) {
            return redirect()->route('panel');
        } elseif($tipoUsuario == 3) {
            return redirect()->route('panel');
        } else {
            return redirect()->route('panel');
        }
    }
}

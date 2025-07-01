<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class matriculaController extends Controller
{
    public function index(){
        $user = Auth::user(); // Usuario autenticado s
        $persona = $user->persona; // Relación uno a uno
        $matricula = $persona?->matricula; // Puede ser null si aún no tiene
        return view('matricula.indexM', compact('matricula', 'persona'));
    }
}

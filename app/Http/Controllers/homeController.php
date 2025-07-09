<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Escuela;

class homeController extends Controller
{
    public function index(){
        
        return view('panel.index2'); 
    }

    public function index_estudiante(){
        
        $persona = auth()->user()->persona;
        if (!$persona) {
            return redirect()->route('home')->with('error', 'No se encontró la persona asociada al usuario.');
        }
        $id_escuela = $persona->id_escuela;
        $matricula = $persona?->matricula;
        $escuela = Escuela::findOrFail($id_escuela);
        
        return view('panel.index_estudiante', compact('escuela')); 
    }
}

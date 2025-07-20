<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Escuela;
use App\Models\grupo_estudiante;
use App\Models\grupos_practica;
use App\Models\Persona;
use App\Models\Semestre;

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
        $escuela = Escuela::find($id_escuela);
        $grupo_estudiante = grupo_estudiante::where('id_estudiante', $persona->id)->first();
    
        if (!$escuela || !$grupo_estudiante) {
            auth()->logout(); // cierra sesión
            return redirect()->route('login')->with('error', 'Aún no tienes acceso al sistema. Contacta al administrador.');
        }
    
        $grupo_practica = grupos_practica::find($grupo_estudiante->id_grupo_practica);
        $docente = Persona::find($grupo_practica?->id_docente);
        $semestre = Semestre::find($grupo_practica?->id_semestre);
    
        // Si alguno de estos aún falta, también redirige
        if (!$grupo_practica || !$docente || !$semestre) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Aún no tienes acceso al sistema. Contacta al administrador.');
        }
        
        return view('panel.index_estudiante', compact('escuela', 'semestre', 'docente')); 
    }
}

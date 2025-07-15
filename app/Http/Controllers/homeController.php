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
        $matricula = $persona?->matricula;
        $escuela = Escuela::findOrFail($id_escuela);
        $grupo_estudiante = grupo_estudiante::where('id_estudiante', $persona->id)->firstOrFail();
        $grupo_practica = grupos_practica::findOrFail($grupo_estudiante->id_grupo_practica);
        $docente = Persona::findOrFail($grupo_practica->id_docente);
        $semestre = Semestre::findOrFail($grupo_practica->id_semestre);
        
        return view('panel.index_estudiante', compact('escuela', 'semestre', 'docente')); 
    }
}

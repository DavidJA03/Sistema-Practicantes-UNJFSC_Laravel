<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use App\Models\grupo_estudiante;
use App\Models\grupos_practica;
use App\Models\matricula;
use App\Models\Persona;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class validacionMatriculaController extends Controller
{
    public function Vmatricula(){
        $id = auth()->id();
/*
        $estudiantes = grupos_practica::with([
             'estudiante.matricula', 
        ])->where('id_docente', $id)->get();
*/ 

        $estudiantes = grupo_estudiante::with([
            'grupoPractica.semestre',
            'grupoPractica.escuela',
            'estudiante.matricula',
            'supervisor'
        ])->whereHas('  ', function ($query) use ($id) {
            $query->where('id_docente', $id);
        })->get();

        return view('ValidacionMatricula.ValidacionMatricula', compact('estudiantes'));
    }
    public function actualizarEstadoFicha(Request $request, $id)
    {
        $matricula = matricula::findOrFail($id);
        $matricula->estado_ficha = $request->estado_ficha;
        $matricula->save();

        return back()->with('success', 'Estado de ficha actualizado correctamente');
    }

    public function actualizarEstadoRecord(Request $request, $id)
    {
        $matricula = matricula::findOrFail($id);
        $matricula->estado_record = $request->estado_record;
        $matricula->save();

        return back()->with('success', 'Estado de récord académico actualizado correctamente');
    }


}

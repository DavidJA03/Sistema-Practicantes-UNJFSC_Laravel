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
        $idPersona = auth()->user()->persona->id;
        $id = auth()->id();
        //$persona = auth()->user()->persona;
/*$nombre = $persona?->type_user?->nombre;
$nombres = $nombre;*/
        
        if($id ==1) {
            $estudiantes = grupo_estudiante::with([
                'grupo.semestre',
                'grupo.escuela',
                'estudiante.matricula',
                'supervisor'
            ])->get();
        }else{
            $estudiantes = grupo_estudiante::with([
                'grupo.semestre',
                'grupo.escuela',
                'estudiante.matricula',
                'supervisor'
            ])->whereHas('grupo', function ($query) use ($idPersona) {
                $query->where('id_docente', $idPersona); // Aquí filtras por docente dentro de la relación
            })->get();

        }
        

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

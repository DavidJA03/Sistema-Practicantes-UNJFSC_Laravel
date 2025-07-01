<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use App\Models\Facultade;
use App\Models\grupo_estudiante;
use App\Models\grupos_practica;
use App\Models\Persona;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class grupoEstudianteController extends Controller
{
    public function index()
    {
        $docentes = Persona::where('rol_id', 3)->get(); // Ajusta rol_id si es necesario
        $semestres = Semestre::all();
        $escuelas = Escuela::all();
        $facultades = Facultade::all();
        $grupos_practica = grupos_practica::all();
        $estudiantes = Persona::with('escuela')->get(); // Suponiendo que rol_id 3 es para estudiantes

        return view('asignatura.grupoAsignatura', compact(
            'docentes',
            'semestres',
            'escuelas',
            'facultades',
            'grupos_practica',
            'estudiantes'
        ));
    }


public function asignarAlumnos(Request $request)
{
    

    foreach ($request->estudiantes as $id_estudiante) {
        grupo_estudiante::create([
            'id_supervisor' => $request->id_supervisor,
            'id_grupo_practica' => $request->grupo_id,
            'id_estudiante' => $id_estudiante,
            'estado' => 1,
        ]);
    }

    return redirect()->back()->with('success', 'Alumno(s) asignado(s) correctamente.');
}
public function destroy($id)
{
    $registro = grupo_estudiante::findOrFail($id);
    $registro->delete();

    return back()->with('success', 'Estudiante eliminado del grupo correctamente.');
}


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluacionRequest;
use App\Http\Requests\UpdateEvaluacionRequest;
use App\Models\Evaluacione;
use App\Models\Persona;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class EvaluacionController extends Controller
{
    public function index(Request $request)
{
    $query = Persona::where('rol_id', 4)->with('evaluacione');

    // Filtro por nombre o apellido
    if ($request->filled('buscar')) {
        $query->where(function($q) use ($request) {
            $q->where('nombres', 'like', '%'.$request->buscar.'%')
              ->orWhere('apellidos', 'like', '%'.$request->buscar.'%');
        });
    }

    // Número de registros por página (default 10)
    $perPage = $request->get('perPage', 5);

    $alumnos = $query->orderBy('apellidos')->paginate($perPage)->appends($request->all());

    $preguntas = [
        '¿Cuál fue su principal aprendizaje durante sus prácticas?',
        '¿Cómo aplicó los conocimientos adquiridos en la universidad?',
        '¿Qué habilidades blandas desarrolló más?',
        '¿Enfrentó algún reto importante? ¿Cómo lo resolvió?',
        '¿Recomendaría esta empresa para futuros practicantes? ¿Por qué?',
    ];

    return view('evaluacion.index', compact('alumnos', 'preguntas'));
}

   public function store(Request $request)
{
    $anexo7 = $request->file('anexo_7') ? $request->file('anexo_7')->store('anexos') : null;
    $anexo8 = $request->file('anexo_8') ? $request->file('anexo_8')->store('anexos') : null;

    Evaluacione::create([
        'alumno_id'   => $request->alumno_id,
        'anexo_7'     => $anexo7,
        'anexo_8'     => $anexo8,
        'pregunta_1'  => $request->pregunta_1,
        'pregunta_2'  => $request->pregunta_2,
        'pregunta_3'  => $request->pregunta_3,
        'pregunta_4'  => $request->pregunta_4,
        'pregunta_5'  => $request->pregunta_5,
        'user_create' => 'admin', // O el usuario actual si gustas
        'date_create' => now(),
        'estado'      => true,
    ]);

    return redirect()->route('evaluacion.index')->with('success', 'Evaluación registrada correctamente.');
}




    public function edit(Evaluacione $evaluacion)
    {
        $alumno = $evaluacion->alumno;
        return view('evaluacion.edit', compact('evaluacion', 'alumno'));
    }

    public function update(UpdateEvaluacionRequest $request, Evaluacione $evaluacion)
    {
        try {
            DB::beginTransaction();

            // Si hay nuevos archivos, reemplazar
            if ($request->hasFile('anexo_7')) {
                if ($evaluacion->anexo_7) Storage::delete($evaluacion->anexo_7);
                $evaluacion->anexo_7 = $request->file('anexo_7')->store('anexos');
            }

            if ($request->hasFile('anexo_8')) {
                if ($evaluacion->anexo_8) Storage::delete($evaluacion->anexo_8);
                $evaluacion->anexo_8 = $request->file('anexo_8')->store('anexos');
            }

            $evaluacion->pregunta_1 = $request->pregunta_1;
            $evaluacion->pregunta_2 = $request->pregunta_2;
            $evaluacion->pregunta_3 = $request->pregunta_3;
            $evaluacion->pregunta_4 = $request->pregunta_4;
            $evaluacion->pregunta_5 = $request->pregunta_5;
            $evaluacion->user_update = auth()->user()->name ?? 'admin';
            $evaluacion->date_update = now();

            $evaluacion->save();

            DB::commit();

            return redirect()->route('evaluacion.index')->with('success', 'Evaluación actualizada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al actualizar la evaluación: ' . $e->getMessage());
        }
    }

    public function destroy(Evaluacione $evaluacion)
    {
        try {
            if ($evaluacion->anexo_7) Storage::delete($evaluacion->anexo_7);
            if ($evaluacion->anexo_8) Storage::delete($evaluacion->anexo_8);

            $evaluacion->delete();

            return redirect()->route('evaluacion.index')->with('success', 'Evaluación eliminada correctamente.');
        } catch (Exception $e) {
            return back()->withErrors('Error al eliminar la evaluación: ' . $e->getMessage());
        }
    }

    // Guardar Anexos
public function storeAnexos(Request $request)
{
    $request->validate([
        'alumno_id' => 'required|exists:personas,id',
        'anexo_7' => 'nullable|file|mimes:pdf',
        'anexo_8' => 'nullable|file|mimes:pdf',
    ]);

    $evaluacion = Evaluacione::firstOrNew(['alumno_id' => $request->alumno_id]);

    $evaluacion->anexo_7 = $request->file('anexo_7')->store('anexos', 'public');
    $evaluacion->anexo_8 = $request->file('anexo_8')->store('anexos', 'public');


    $evaluacion->save();

    return redirect()->route('evaluacion.index', ['open' => $request->alumno_id])
                     ->with('success', 'Anexos guardados correctamente.');
}


// Guardar Entrevista
public function storeEntrevista(Request $request)
{
    $request->validate([
        'alumno_id' => 'required|exists:personas,id',
        'pregunta_1' => 'required|string',
        'pregunta_2' => 'required|string',
        'pregunta_3' => 'required|string',
        'pregunta_4' => 'required|string',
        'pregunta_5' => 'required|string',
    ]);

    $evaluacion = Evaluacione::firstOrNew(['alumno_id' => $request->alumno_id]);

    $evaluacion->pregunta_1 = $request->pregunta_1;
    $evaluacion->pregunta_2 = $request->pregunta_2;
    $evaluacion->pregunta_3 = $request->pregunta_3;
    $evaluacion->pregunta_4 = $request->pregunta_4;
    $evaluacion->pregunta_5 = $request->pregunta_5;

    $evaluacion->save();

    return redirect()->route('evaluacion.index', ['open' => $request->alumno_id])
                     ->with('success', 'Entrevista guardada correctamente.');
}


}

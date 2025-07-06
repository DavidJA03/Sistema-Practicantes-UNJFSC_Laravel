<?php

namespace App\Http\Controllers;

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
        $query = Persona::where('rol_id', 4)
            ->with(['evaluacione', 'respuestas.pregunta']);

        if ($request->filled('buscar')) {
            $query->where(function($q) use ($request) {
                $q->where('nombres', 'like', '%'.$request->buscar.'%')
                  ->orWhere('apellidos', 'like', '%'.$request->buscar.'%');
            });
        }

        // No usamos paginate()
        $alumnos = $query->orderBy('apellidos')->get();

        $preguntas = \App\Models\Pregunta::where('estado', true)->orderBy('id')->get();

        return view('evaluacion.index', compact('alumnos', 'preguntas'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:personas,id',
            'anexo_7'   => 'nullable|file|mimes:pdf',
            'anexo_8'   => 'nullable|file|mimes:pdf',
        ]);

        Evaluacione::create([
            'alumno_id'   => $request->alumno_id,
            'anexo_7'     => $request->file('anexo_7') ? $request->file('anexo_7')->store('anexos', 'public') : null,
            'anexo_8'     => $request->file('anexo_8') ? $request->file('anexo_8')->store('anexos', 'public') : null,
            'user_create' => auth()->user()->name ?? 'admin',
            'date_create' => now(),
            'estado'      => true,
        ]);

        return redirect()->route('evaluacion.index')->with('success', 'Anexos guardados correctamente.');
    }

    public function edit(Evaluacione $evaluacion)
    {
        $alumno = $evaluacion->alumno;
        return view('evaluacion.edit', compact('evaluacion', 'alumno'));
    }

    public function update(Request $request, Evaluacione $evaluacion)
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('anexo_7')) {
                if ($evaluacion->anexo_7) Storage::disk('public')->delete($evaluacion->anexo_7);
                $evaluacion->anexo_7 = $request->file('anexo_7')->store('anexos', 'public');
            }

            if ($request->hasFile('anexo_8')) {
                if ($evaluacion->anexo_8) Storage::disk('public')->delete($evaluacion->anexo_8);
                $evaluacion->anexo_8 = $request->file('anexo_8')->store('anexos', 'public');
            }

            $evaluacion->user_update = auth()->user()->name ?? 'admin';
            $evaluacion->date_update = now();

            $evaluacion->save();

            DB::commit();

            return redirect()->route('evaluacion.index')->with('success', 'Anexos actualizados correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al actualizar los anexos: ' . $e->getMessage());
        }
    }

    public function destroy(Evaluacione $evaluacion)
    {
        try {
            if ($evaluacion->anexo_7) Storage::disk('public')->delete($evaluacion->anexo_7);
            if ($evaluacion->anexo_8) Storage::disk('public')->delete($evaluacion->anexo_8);

            $evaluacion->delete();

            return redirect()->route('evaluacion.index')->with('success', 'Evaluación eliminada correctamente.');
        } catch (Exception $e) {
            return back()->withErrors('Error al eliminar la evaluación: ' . $e->getMessage());
        }
    }

    public function storeAnexos(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:personas,id',
            'anexo_7'   => 'nullable|file|mimes:pdf',
            'anexo_8'   => 'nullable|file|mimes:pdf',
        ]);

        $evaluacion = Evaluacione::firstOrNew(['alumno_id' => $request->alumno_id]);

        if ($request->hasFile('anexo_7')) {
            if ($evaluacion->anexo_7) Storage::disk('public')->delete($evaluacion->anexo_7);
            $evaluacion->anexo_7 = $request->file('anexo_7')->store('anexos', 'public');
        }

        if ($request->hasFile('anexo_8')) {
            if ($evaluacion->anexo_8) Storage::disk('public')->delete($evaluacion->anexo_8);
            $evaluacion->anexo_8 = $request->file('anexo_8')->store('anexos', 'public');
        }

        if (!$evaluacion->exists) {
            $evaluacion->user_create = auth()->user()->name ?? 'admin';
            $evaluacion->date_create = now();
            $evaluacion->estado = true;
        } else {
            $evaluacion->user_update = auth()->user()->name ?? 'admin';
            $evaluacion->date_update = now();
        }

        $evaluacion->save();

        return redirect()->route('evaluacion.index', ['open' => $request->alumno_id])
                         ->with('success', 'Anexos guardados correctamente.');
    }
}

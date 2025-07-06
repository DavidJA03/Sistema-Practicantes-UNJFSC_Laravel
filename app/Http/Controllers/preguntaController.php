<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;

class preguntaController extends Controller
{
    /**
     * Mostrar todas las preguntas.
     */
    public function index()
    {
        $preguntas = Pregunta::orderBy('id', 'desc')->get();
        return view('pregunta.index', compact('preguntas'));
    }

    /**
     * Guardar nueva pregunta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|string|max:255',
        ]);

        Pregunta::create([
            'pregunta' => $request->pregunta,
            'estado' => true,
            'user_create' => auth()->id(),
            'date_create' => now(),
        ]);

        return redirect()->route('pregunta.index')
                         ->with('success', 'Pregunta creada correctamente.');
    }

    /**
     * Actualizar pregunta o su estado.
     */
    public function update(Request $request, $id)
    {
        $pregunta = Pregunta::findOrFail($id);

        if ($request->has('toggle_estado')) {
            $pregunta->update([
                'estado' => !$pregunta->estado,
                'user_update' => auth()->id(),
                'date_update' => now(),
            ]);

            return redirect()->route('pregunta.index')
                             ->with('success', 'Estado actualizado.');
        }

        $request->validate([
            'pregunta' => 'required|string|max:255',
        ]);

        $pregunta->update([
            'pregunta' => $request->pregunta,
            'user_update' => auth()->id(),
            'date_update' => now(),
        ]);

        return redirect()->route('pregunta.index')
                         ->with('success', 'Pregunta actualizada.');
    }

    /**
     * Eliminar pregunta.
     */
    public function destroy(Pregunta $pregunta)
    {
        $pregunta->delete();

        return redirect()->route('pregunta.index')
                         ->with('success', 'Pregunta eliminada.');
    }
}

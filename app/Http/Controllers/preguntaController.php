<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;

class preguntaController extends Controller
{
    /**
     * Mostrar preguntas: todas si es admin, propias si no.
     */
    public function index()
    {
        $user = auth()->user();

        // Si el usuario es admin (rol_id == 1), puede ver todas las preguntas
        if ($user->persona?->rol_id == 1) {
            $preguntas = Pregunta::orderBy('id', 'desc')->get();
        } else {
            $preguntas = Pregunta::where('user_create', $user->id)
                                 ->orderBy('id', 'desc')
                                 ->get();
        }

        return view('pregunta.index', compact('preguntas'));
    }

    /**
     * Guardar una nueva pregunta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|string|max:255',
        ]);

        Pregunta::create([
            'pregunta'     => $request->pregunta,
            'estado'       => true,
            'user_create'  => auth()->id(),
            'date_create'  => now(),
        ]);

        return redirect()->route('pregunta.index')
                         ->with('success', 'Pregunta creada correctamente.');
    }

    /**
     * Actualizar una pregunta.
     * El admin puede modificar todas, los usuarios solo las suyas.
     */
    public function update(Request $request, $id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $user = auth()->user();

        if ($pregunta->user_create !== $user->id && $user->persona?->rol_id !== 1) {
            abort(403, 'No autorizado para modificar esta pregunta.');
        }

        if ($request->has('toggle_estado')) {
            $pregunta->update([
                'estado'      => !$pregunta->estado,
                'user_update' => $user->id,
                'date_update' => now(),
            ]);

            return redirect()->route('pregunta.index')
                             ->with('success', 'Estado actualizado.');
        }

        $request->validate([
            'pregunta' => 'required|string|max:255',
        ]);

        $pregunta->update([
            'pregunta'     => $request->pregunta,
            'user_update'  => $user->id,
            'date_update'  => now(),
        ]);

        return redirect()->route('pregunta.index')
                         ->with('success', 'Pregunta actualizada.');
    }

    /**
     * Eliminar una pregunta.
     * El admin puede eliminar todas, los usuarios solo las suyas.
     */
    public function destroy($id)
{
    $user = auth()->user();
    $pregunta = Pregunta::findOrFail($id);

    // Control de permisos
    if ($pregunta->user_create !== $user->id && $user->persona?->rol_id !== 1) {
        abort(403, 'No autorizado para eliminar esta pregunta.');
    }

    $pregunta->delete();

    return redirect()->route('pregunta.index')->with('success', 'Pregunta eliminada.');
}


}

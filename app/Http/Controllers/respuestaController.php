<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use App\Models\Pregunta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'alumno_id'    => 'required|exists:personas,id',
            'respuestas'   => 'required|array',
            'respuestas.*' => 'required|string',
        ]);

        foreach ($request->respuestas as $preguntaId => $textoRespuesta) {
            Respuesta::updateOrCreate(
                [
                    'persona_id'  => $request->alumno_id,
                    'pregunta_id' => $preguntaId,
                ],
                [
                    'respuesta'   => $textoRespuesta,
                ]
            );
        }

        return redirect()
            ->route('evaluacion.index', ['open' => $request->alumno_id])
            ->with('success', 'Entrevista guardada correctamente.');
    }
}

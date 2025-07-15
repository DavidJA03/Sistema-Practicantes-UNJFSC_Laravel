<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JefeInmediato;
use App\Models\Empresa;
use App\Models\Practica;
use Illuminate\Support\Facades\Auth;

class JefeInmediatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jefes = JefeInmediato::all();
        return view('auxiliares.jefe_inmediato', compact('jefes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $practicas_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'cargo' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'sitio_web' => 'nullable|url|max:255'
        ]);

        JefeInmediato::create([
            'nombres' => $validated['name'],
            'dni' => $validated['dni'],
            'cargo' => $validated['cargo'],
            'area' => $validated['area'],
            'telefono' => $validated['telefono'],
            'correo' => $validated['email'],
            'web' => $validated['sitio_web'] ?? null,
            'practicas_id' => $practicas_id,
            'estado' => 1,
        ]);

        return redirect()->back()->with('success', 'Jefe Inmediato registrado exitosamente');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $jefeInmediato = JefeInmediato::findOrFail($id);
        $practica = Practica::findOrFail($jefeInmediato->practicas_id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'cargo' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'sitio_web' => 'nullable|url|max:255'
        ]);

        $jefeInmediato->update([
            'nombres' => $validated['name'],
            'dni' => $validated['dni'],
            'cargo' => $validated['cargo'],
            'area' => $validated['area'],
            'telefono' => $validated['telefono'],
            'correo' => $validated['email'],
            'web' => $validated['sitio_web'] ?? null,
            'estado' => 1,
        ]);

        $practica->update([
            'estado_proceso' => 'en proceso',
            'estado' => 1,
        ]);

        return redirect()->back()->with('success', 'Jefe Inmediato actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

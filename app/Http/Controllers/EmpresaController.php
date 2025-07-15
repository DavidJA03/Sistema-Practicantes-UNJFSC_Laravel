<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Practica;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('auxiliares.empresa', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($practicas_id)
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
            'empresa' => 'required|string|max:255',
            'ruc' => 'required|string|max:11',
            'razon_social' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'sitio_web' => 'nullable|url|max:255'
        ]);

        Empresa::create([
            'nombre' => $validated['empresa'],
            'ruc' => $validated['ruc'],
            'razon_social' => $validated['razon_social'],
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
            'correo' => $validated['email'],
            'sitio_web' => $validated['sitio_web'] ?? null,
            'practicas_id' => $practicas_id,
            'estado' => 1,
            
        ]);

        return redirect()->back()->with('success', 'Empresa registrada exitosamente');
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
        $empresa = Empresa::findOrFail($id);
        $practica = Practica::findOrFail($empresa->practicas_id);
        
        $validated = $request->validate([
            'empresa' => 'required|string|max:255',
            'ruc' => 'required|string|max:11',
            'razon_social' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'sitio_web' => 'nullable|url|max:255'
        ]);

        $empresa->update([
            'nombre' => $validated['empresa'],
            'ruc' => $validated['ruc'],
            'razon_social' => $validated['razon_social'],
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
            'correo' => $validated['email'],
            'sitio_web' => $validated['sitio_web'] ?? null,
            'estado' => 1,
        ]);

        $practica->update([
            'estado_proceso' => 'en proceso',
        ]);

        return redirect()->back()->with('success', 'Empresa actualizada exitosamente');
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

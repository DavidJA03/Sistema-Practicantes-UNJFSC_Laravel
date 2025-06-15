<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFacultadRequest;
use App\Http\Requests\UpdateFacultadRequest;
use App\Models\Facultade;
use App\Models\Escuela;
use Illuminate\Support\Facades\DB;
use Exception;

class facultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultades = Facultade::with('escuela')->get();
        return view('facultad.index',['facultades' => $facultades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facultad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacultadRequest $request)
    {
        try {
            DB::beginTransaction();

            Facultade::create([
                'name' => $request->name,
                'user_create' => null, // o Auth::id() si tienes autenticación
                'date_create' => now(),
                'estado' => true
            ]);

            DB::commit();

            return redirect()->route('facultad.index')
                ->with('success', 'Facultad registrada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al guardar la facultad.');
        }
        

        return redirect()->route('facultad.index')->with('success', 'Facultad registrada correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Facultade $facultad)
    {
        return view('facultad.edit',['facultad'=>$facultad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacultadRequest $request, Facultade $facultad)
    {
        try {
        $facultad->update([
            'name' => $request->name,
            'date_update' => now(),
        ]);

        return redirect()->route('facultad.index')
                         ->with('success', 'Facultad actualizada correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()
                         ->with('error', 'Error al actualizar la facultad: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facultad = Facultade::findOrFail($id);
        $facultad->delete();

        return redirect()->route('facultad.index')->with('success', 'Facultad eliminada correctamente.');
    }
}

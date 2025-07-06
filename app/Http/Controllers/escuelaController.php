<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEscuelaRequest;
use App\Http\Requests\UpdateEscuelaRequest;
use App\Models\Facultade;
use App\Models\Escuela;
use Illuminate\Support\Facades\DB;
use Exception;

class EscuelaController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
=======
    public function index()
>>>>>>> eea7286f4c01acbe655844924ce0329143e2b733
    {
        $facultades = Facultade::all();
        // Trae todas las escuelas con la relación facultad
        $escuelas = Escuela::with('facultad')->orderBy('id', 'desc')->get();

        return view('escuela.index', compact('escuelas', 'facultades'));
    }

<<<<<<< HEAD
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultades = Facultade::all();
        return view('escuela.create', compact('facultades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
=======
>>>>>>> eea7286f4c01acbe655844924ce0329143e2b733
    public function store(StoreEscuelaRequest $request)
    {
        try {
            DB::beginTransaction();

            Escuela::create([
                'name' => $request->name,
                'facultad_id' => $request->facultad_id,
                'user_create' => null,
                'date_create' => now(),
                'estado' => true
            ]);

            DB::commit();

            return redirect()->route('escuela.index')->with('success', 'Escuela registrada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al registrar la escuela: ' . $e->getMessage());
        }
    }

<<<<<<< HEAD
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
    public function edit($id)
    {
        $escuela = Escuela::findOrFail($id);
        $facultades = Facultade::all();

        return view('escuela.edit', compact('escuela', 'facultades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
=======
>>>>>>> eea7286f4c01acbe655844924ce0329143e2b733
    public function update(UpdateEscuelaRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $escuela = Escuela::findOrFail($id);

            $escuela->update([
                'name' => $request->name,
                'facultad_id' => $request->facultad_id,
                'date_update' => now()
            ]);

            DB::commit();

            return redirect()->route('escuela.index')
                             ->with('success', 'Escuela actualizada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                             ->withErrors('Error al actualizar la escuela: ' . $e->getMessage());
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
        try {
            $escuela = Escuela::findOrFail($id);
            $escuela->delete();

<<<<<<< HEAD
        return redirect()->route('escuela.index')->with('success', 'Escuela eliminada correctamente.');

=======
            return redirect()->route('escuela.index')->with('success', 'Escuela eliminada correctamente.');
        } catch (Exception $e) {
            return back()->withErrors('Error al eliminar la escuela: ' . $e->getMessage());
        }
>>>>>>> eea7286f4c01acbe655844924ce0329143e2b733
    }
}

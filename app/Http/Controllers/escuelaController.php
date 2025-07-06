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
    public function index()
    {
        $facultades = Facultade::all();
        // Trae todas las escuelas con la relación facultad
        $escuelas = Escuela::with('facultad')->orderBy('id', 'desc')->get();

        return view('escuela.index', compact('escuelas', 'facultades'));
    }

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

    public function destroy($id)
    {
        try {
            $escuela = Escuela::findOrFail($id);
            $escuela->delete();

            return redirect()->route('escuela.index')->with('success', 'Escuela eliminada correctamente.');
        } catch (Exception $e) {
            return back()->withErrors('Error al eliminar la escuela: ' . $e->getMessage());
        }
    }
}

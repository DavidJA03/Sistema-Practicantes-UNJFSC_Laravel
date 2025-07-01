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
    public function index(Request $request)
    {
        $facultades = Facultade::all();

        $query = Escuela::with('facultad');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('facultad_id')) {
            $query->where('facultad_id', $request->facultad_id);
        }

        $perPage = in_array($request->cantidad, [5, 10, 25, 50]) ? $request->cantidad : 5;

        $escuelas = $query->orderBy('id', 'desc')->paginate($perPage);

        if ($request->ajax()) {
            return view('escuela.partials.table', compact('escuelas'))->render();
        }

        return view('escuela.index', compact('escuelas', 'facultades'));
    }

    public function create()
    {
        $facultades = Facultade::all();
        return view('escuela.create', compact('facultades'));
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
            return back()->withErrors('Error al registrar la escuela.');
        }
    }

    public function edit($id)
    {
        $escuela = Escuela::findOrFail($id);
        $facultades = Facultade::all();

        return view('escuela.edit', compact('escuela', 'facultades'));
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
        $escuela = Escuela::findOrFail($id);
        $escuela->delete();

        return redirect()->route('escuela.index')->with('success', 'Escuela eliminada correctamente.');
    }
}

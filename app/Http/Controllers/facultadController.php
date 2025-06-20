<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFacultadRequest;
use App\Http\Requests\UpdateFacultadRequest;
use App\Models\Facultade;
use Illuminate\Support\Facades\DB;
use Exception;

class FacultadController extends Controller
{
    public function index(Request $request)
    {
        $query = Facultade::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $facultades = $query->orderBy('id', 'desc')
                            ->paginate($request->get('cantidad', 5));

        if ($request->ajax()) {
            return view('facultad.partials.table', compact('facultades'))->render();
        }

        return view('facultad.index', compact('facultades'));
    }

    public function create()
    {
        return view('facultad.create');
    }

    public function store(StoreFacultadRequest $request)
    {
        try {
            DB::beginTransaction();

            $facultad = Facultade::create([
                'name' => $request->name,
                'user_create' => null,
                'date_create' => now(),
                'estado' => true
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Facultad registrada correctamente.',
                    'facultad' => $facultad
                ]);
            }

            return redirect()->route('facultad.index')
                             ->with('success', 'Facultad registrada correctamente.');

        } catch (Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Error al registrar facultad.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withErrors('Error al guardar la facultad.');
        }
    }

    public function edit(Facultade $facultad)
    {
        return view('facultad.edit', compact('facultad'));
    }

    public function update(UpdateFacultadRequest $request, Facultade $facultad)
    {
        try {
            $facultad->update([
                'name' => $request->name,
                'date_update' => now(),
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Facultad actualizada correctamente.'
                ]);
            }

            return redirect()->route('facultad.index')
                             ->with('success', 'Facultad actualizada correctamente.');

        } catch (Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Error al actualizar la facultad.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                             ->with('error', 'Error al actualizar la facultad: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $facultad = Facultade::findOrFail($id);
            $facultad->delete();

            if (request()->ajax()) {
                return response()->json([
                    'message' => 'Facultad eliminada correctamente.'
                ]);
            }

            return redirect()->route('facultad.index')
                             ->with('success', 'Facultad eliminada correctamente.');
        } catch (Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'message' => 'Error al eliminar facultad.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withErrors('Error al eliminar facultad.');
        }
    }

    // Opcional si lo necesitas por separado
    public function ajaxIndex(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);

        $facultades = Facultade::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate($perPage);

        return view('facultad.partials.table', compact('facultades'))->render();
    }
}

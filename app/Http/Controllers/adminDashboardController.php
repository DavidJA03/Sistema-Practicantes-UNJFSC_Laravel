<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminDashboardController extends Controller
{
    public function indexAdmin(Request $request)
    {
        $facultades = DB::table('facultades')->get();
        $escuelas = DB::table('escuelas')->get();
        $semestres = DB::table('semestres')->get();

        // Consulta base basada en tu SQL original que funciona bien
        $baseQuery = DB::table('grupo_estudiante as ge')
            ->join('grupos_practicas as gp', 'ge.id_grupo_practica', '=', 'gp.id')
            ->join('escuelas as e', 'gp.id_escuela', '=', 'e.id')
            ->join('facultades as f', 'e.facultad_id', '=', 'f.id')
            ->join('semestres as s', 'gp.id_semestre', '=', 's.id')
            ->join('personas as p', 'ge.id_estudiante', '=', 'p.id')
            ->leftJoin('matriculas as m', 'ge.id_estudiante', '=', 'm.persona_id');

        // Aplicar filtros si se envían desde el request
        if ($request->filled('facultad')) {
            $baseQuery->where('f.id', $request->facultad);
        }

        if ($request->filled('escuela')) {
            $baseQuery->where('e.id', $request->escuela);
        }

        if ($request->filled('semestre')) {
            $baseQuery->where('s.id', $request->semestre);
        }

        // Lista de estudiantes
        $listaEstudiantes = (clone $baseQuery)
            ->select(
                'p.nombres',
                'p.apellidos',
                'e.name as escuela',
                'f.name as facultad',
                's.codigo as semestre',
                DB::raw("COALESCE(m.estado_ficha, 'Sin registrar') as estado_ficha"),
                DB::raw("COALESCE(m.estado_record, 'Sin registrar') as estado_record")
            )
            ->groupBy(
                'p.nombres', 'p.apellidos', 'e.name', 'f.name', 's.codigo', 'm.estado_ficha', 'm.estado_record'
            )
            ->get();

        // Totales
        $totalEstudiantes = (clone $baseQuery)->distinct()->count('ge.id_estudiante');

        $totalMatriculados = (clone $baseQuery)
            ->whereNotNull('m.estado_ficha')
            ->distinct()
            ->count('ge.id_estudiante');

       $totalSupervisores = (clone $baseQuery)
        ->whereNotNull('ge.id_supervisor')
        ->distinct('ge.id_supervisor')
        ->count('ge.id_supervisor');


        $completos = (clone $baseQuery)
            ->where('m.estado_ficha', 'Completo')
            ->where('m.estado_record', 'Completo')
            ->distinct()
            ->count('ge.id_estudiante');

        $pendientes = $totalMatriculados - $completos;

        $totalPorEscuelaEnSemestre = DB::table('grupo_estudiante as ge')
    ->join('grupos_practicas as gp', 'ge.id_grupo_practica', '=', 'gp.id')
    ->join('escuelas as e', 'gp.id_escuela', '=', 'e.id')
    ->join('facultades as f', 'e.facultad_id', '=', 'f.id')
    ->join('semestres as s', 'gp.id_semestre', '=', 's.id')
    ->when($request->filled('facultad'), function ($query) use ($request) {
        return $query->where('f.id', $request->facultad);
    })
    ->when($request->filled('semestre'), function ($query) use ($request) {
        return $query->where('s.id', $request->semestre);
    })
    ->when($request->filled('escuela'), function ($query) use ($request) {
        return $query->where('e.id', $request->escuela);
    })
    ->count('ge.id_estudiante');

        $fichasPorEscuela = (clone $baseQuery)
            ->select(
                'e.name as escuela',
                DB::raw("SUM(CASE WHEN m.estado_ficha = 'Completo' THEN 1 ELSE 0 END) as completos"),
                DB::raw("SUM(CASE WHEN m.estado_ficha = 'En proceso' THEN 1 ELSE 0 END) as en_proceso"),
                DB::raw("SUM(CASE WHEN m.estado_ficha IS NULL OR m.estado_ficha NOT IN ('Completo', 'En proceso') THEN 1 ELSE 0 END) as pendientes")
            )
            ->groupBy('e.name')
            ->get();

            
        $fichasPorMes = (clone $baseQuery)
        ->join('matriculas as m2', 'ge.id_estudiante', '=', 'm2.persona_id')
        ->select(
            DB::raw('MONTHNAME(m2.created_at) as mes'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('m2.created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(m2.created_at)'), DB::raw('MONTHNAME(m2.created_at)'))
        ->orderBy(DB::raw('MONTH(m2.created_at)'))
        ->get();
            



        return view('dashboard.dashboardAdmin', compact(
            'facultades', 'escuelas', 'semestres',
            'totalMatriculados', 'totalSupervisores',
            'completos', 'pendientes', 'totalPorEscuelaEnSemestre',
            'totalEstudiantes', 'listaEstudiantes','fichasPorEscuela','fichasPorMes'
        )); 
    }
}
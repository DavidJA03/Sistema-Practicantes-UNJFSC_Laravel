<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class panelPrincipal extends Controller
{
    public function dashboard()
{
    
    $rol = auth()->user()->persona?->rol_id;

    switch ($rol) {
        case 1:
            return redirect()->action([adminDashboardController::class, 'indexAdmin']);
        case 2:
            return redirect()->action([DashboardDocenteController::class, 'index']);
        case 3:
            return redirect()->action([supervisorDashboard::class, 'indexsupervisor']);
        case 4:
            return redirect()->action([estudianteDashboardController::class, 'index']);
        default:
            abort(403, 'Acceso no autorizado');
    }
}

}

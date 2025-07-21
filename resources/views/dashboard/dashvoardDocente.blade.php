
@extends('template')
@section('title', 'Dashboard Docente')
@section('subtitle', 'Panel de control y supervisión de estudiantes')

@push('css')
<style>
    :root {
        --primary-color: #1e3a8a;
        --primary-light: #3b82f6;
        --secondary-color: #64748b;
        --background-color: #f8fafc;
        --surface-color: #ffffff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --border-color: #e2e8f0;
        --success-color: #059669;
        --warning-color: #d97706;
        --danger-color: #dc2626;
        --info-color: #0891b2;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    .dashboard-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    /* Card Principal */
    .dashboard-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .dashboard-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .dashboard-card-header {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        padding: 1.5rem 2rem;
        position: relative;
        border-bottom: none;
    }

    .dashboard-card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .dashboard-card-title {
        font-size: 1.375rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-transform: none;
    }

    .dashboard-card-title i {
        font-size: 1.25rem;
    }

    .dashboard-card-body {
        padding: 1.5rem;
    }

    /* Sección de Filtros */
    .filters-section {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .filters-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--info-color), #0e7490);
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .filters-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filters-title i {
        color: var(--info-color);
    }

    /* Form Controls */
    .form-label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-select {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        background: var(--surface-color);
    }

    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        outline: none;
    }

    .form-control {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        background: var(--surface-color);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        outline: none;
    }

    /* Botón de Filtrar */
    .btn-filter {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-sm);
    }

    .btn-filter:hover {
        background: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    /* Métricas */
    .metrics-section {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .metrics-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--success-color), #047857);
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .metrics-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .metrics-title i {
        color: var(--success-color);
    }

    /* Cards de Métricas */
    .metric-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        transition: all 0.3s ease;
    }

    .metric-card.primary::before {
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .metric-card.info::before {
        background: linear-gradient(90deg, var(--info-color), #0e7490);
    }

    .metric-card.warning::before {
        background: linear-gradient(90deg, var(--warning-color), #b45309);
    }

    .metric-icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .metric-card.primary .metric-icon {
        color: var(--primary-color);
    }

    .metric-card.info .metric-icon {
        color: var(--info-color);
    }

    .metric-card.warning .metric-icon {
        color: var(--warning-color);
    }

    .metric-label {
        font-size: 0.9rem;
        color: var(--text-secondary);
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    /* Secciones de Gráficos */
    .chart-section {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        position: relative;
        height: 100%;
    }

    .chart-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .chart-section.chart-1::before {
        background: linear-gradient(90deg, var(--warning-color), #b45309);
    }

    .chart-section.chart-2::before {
        background: linear-gradient(90deg, var(--danger-color), #991b1b);
    }

    .chart-section.chart-3::before {
        background: linear-gradient(90deg, var(--info-color), #0e7490);
    }

    .chart-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-1 .chart-title i {
        color: var(--warning-color);
    }

    .chart-2 .chart-title i {
        color: var(--danger-color);
    }

    .chart-3 .chart-title i {
        color: var(--info-color);
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    /* Tabla de Grupos */
    .groups-section {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }

    .groups-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--success-color), #047857);
    }

    .groups-header {
        padding: 1rem 1.5rem;
        background: var(--surface-color);
        border-bottom: 1px solid var(--border-color);
    }

    .groups-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .groups-title i {
        color: var(--success-color);
    }

    /* Tabla */
    .table-container {
        background: var(--surface-color);
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table {
        margin: 0;
        border: none;
        font-size: 0.9rem;
    }

    .table thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: none;
        border-bottom: 2px solid var(--border-color);
        font-weight: 600;
        color: var(--text-primary);
        padding: 1rem 0.75rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
        text-align: center;
    }

    .table tbody td {
        padding: 0.875rem 0.75rem;
        border-bottom: 1px solid #f1f5f9;
        color: var(--text-primary);
        vertical-align: middle;
        text-align: center;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(30, 58, 138, 0.02);
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Badges de Estado */
    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .status-badge.success {
        background: rgba(5, 150, 105, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(5, 150, 105, 0.2);
    }

    .status-badge.warning {
        background: rgba(217, 119, 6, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(217, 119, 6, 0.2);
    }

    .status-badge.danger {
        background: rgba(220, 38, 38, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(220, 38, 38, 0.2);
    }

    .status-badge.secondary {
        background: rgba(100, 116, 139, 0.1);
        color: var(--secondary-color);
        border: 1px solid rgba(100, 116, 139, 0.2);
    }

    .status-badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-sm);
    }

    /* Lista de Estudiantes */
    .students-section {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .students-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .students-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .students-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .students-title i {
        color: var(--primary-color);
    }

    .search-input {
        max-width: 400px;
        min-width: 300px;
    }

    .table-students-container {
        max-height: 500px;
        overflow-y: auto;
    }

    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--border-color);
        margin-bottom: 1rem;
        display: block;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-card-header {
            padding: 1.25rem 1.5rem;
        }

        .dashboard-card-body {
            padding: 1rem;
        }

        .filters-section,
        .metrics-section,
        .students-section,
        .chart-section {
            padding: 1rem;
        }

        .students-header {
            flex-direction: column;
            align-items: stretch;
        }

        .search-input {
            max-width: none;
            min-width: auto;
        }

        .metric-card {
            margin-bottom: 1rem;
        }

        .chart-container {
            height: 250px;
        }
    }

    /* Animaciones */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.3s ease;
    }

    /* Scroll personalizado */
    .table-students-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .table-students-container::-webkit-scrollbar-track {
        background: var(--background-color);
        border-radius: 4px;
    }

    .table-students-container::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 4px;
        transition: background 0.3s ease;
    }

    .table-students-container::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-color);
    }
</style>
@endpush

@section('content')

<div class="dashboard-container fade-in">
    <div class="dashboard-card">
        <div class="dashboard-card-header">
            <h5 class="dashboard-card-title">
                <i class="bi bi-mortarboard"></i>
                Dashboard Docente - Panel de Supervisión
            </h5>
        </div>


    <div class="card-body">

        {{-- Filtros --}}
        <div class="p-3 mb-4 rounded-3 border bg-light">
            <h6 class="mb-3 text-dark fw-bold">🎯 Filtros de búsqueda</h6>
            <form id="filtrosDocente" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Facultad</label>
                        <select id="facultad" name="facultad" class="form-select">
                            <option value="">-- Todas --</option>
                            @foreach ($facultades as $facultad)
                                <option value="{{ $facultad->id }}" {{ request('facultad') == $facultad->id ? 'selected' : '' }}>
                                    {{ $facultad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Semestre</label>
                        <select id="semestre" name="semestre" class="form-select">
                            <option value="">-- Todos --</option>
                        </select>
                    </div>

        <div class="dashboard-card-body">

            {{-- Filtros --}}
            <div class="filters-section">
                <h6 class="filters-title">
                    <i class="bi bi-funnel"></i>
                    Filtros de Búsqueda
                </h6>
                <form id="filtrosDocente" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Escuela</label>
                            <select id="escuela" name="escuela" class="form-select">
                                <option value="">-- Todas --</option>
                                @foreach ($escuelas as $escuela)
                                    <option value="{{ $escuela->id }}">{{ $escuela->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Semestre</label>
                            <select id="semestre" name="semestre" class="form-select">
                                <option value="">-- Todos --</option>
                            </select>
                        </div>


                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button> 

                        <div class="col-md-4">
                            <label class="form-label">Supervisor</label>
                            <select id="supervisor" name="supervisor" class="form-select">
                                <option value="">-- Todos --</option>
                            </select>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn-filter">
                                <i class="bi bi-filter"></i> 
                                Filtrar Datos
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            {{-- Métricas --}}
            <div class="metrics-section">
                <h6 class="metrics-title">
                    <i class="bi bi-graph-up"></i>
                    Indicadores de Supervisión
                </h6>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="metric-card primary">
                            <i class="bi bi-people-fill metric-icon"></i>
                            <div class="metric-label">Total Estudiantes</div>
                            <div class="metric-value">{{ $totalEstudiantes }}</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="metric-card info">
                            <i class="bi bi-file-earmark-check-fill metric-icon"></i>
                            <div class="metric-label">Fichas Validadas</div>
                            <div class="metric-value">{{ $totalFichasValidadas }}</div>
                        </div>
                    </div>

                </div>
                <div class="col">
                    <div class="card bg-warning text-dark shadow-sm rounded-3">
                        <div class="card-body"> 
                            <i class="bi bi-person-badge-fill fs-4"></i><br>
                            Supervisores<br><strong>{{ $totalSupervisores }}</strong>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="metric-card warning">
                            <i class="bi bi-person-badge-fill metric-icon"></i>
                            <div class="metric-label">Supervisores</div>
                            <div class="metric-value">{{ $totalSupervisores }}</div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Gráficos --}}
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="chart-section chart-1">
                        <h6 class="chart-title">
                            <i class="bi bi-bar-chart"></i>
                            Estudiantes por Escuela
                        </h6>
                        <div class="chart-container">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="chart-section chart-2">
                        <h6 class="chart-title">
                            <i class="bi bi-pie-chart"></i>
                            Estado de Matrículas
                        </h6>
                        <div class="chart-container">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chart-section chart-3 mb-4">
                <h6 class="chart-title">
                    <i class="bi bi-trophy"></i>
                    Estudiantes por Supervisor
                </h6>
                <div class="chart-container">
                    <canvas id="horizontalBarChart"></canvas>
                </div>
            </div>

            {{-- Grupos asignados --}}
            <div class="groups-section">
                <div class="groups-header">
                    <h6 class="groups-title">
                        <i class="bi bi-collection"></i>
                        Grupos Asignados
                    </h6>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre del Grupo</th>
                                <th>Escuela</th>
                                <th>Semestre</th>
                                <th>Estudiantes</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupsData as $group)
                                <tr>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->school }}</td>
                                    <td>{{ $group->semester }}</td>
                                    <td>{{ $group->students }}</td>
                                    <td>
                                        <span class="status-badge {{ $group->status === 'Activo' ? 'success' : 'secondary' }}">
                                            {{ $group->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            @if($groupsData->isEmpty())
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="bi bi-collection"></i>
                                        <p class="mb-0">No hay grupos asignados.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Lista de Estudiantes --}}
            <div class="students-section">
                <div class="students-header">
                    <h6 class="students-title">
                        <i class="bi bi-list-ul"></i>
                        Lista de Estudiantes Matriculados
                    </h6>
                    <input type="text" id="filtroTabla" class="form-control search-input" 
                           placeholder="🔍 Buscar estudiantes...">
                </div>

                <div class="table-students-container">
                    <div class="table-container">
                        <table class="table" id="tablaEstudiantes">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Supervisor</th>
                                    <th>Escuela</th>
                                    <th>Semestre</th>
                                    <th>Ficha</th>
                                    <th>Record</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listaEstudiantes as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->nombres }}</td>
                                        <td>{{ $item->apellidos }}</td>
                                        <td>{{ $item->facultad }}</td>
                                        <td>{{ $item->escuela }}</td>
                                        <td>{{ $item->semestre }}</td>
                                        <td>
                                            @php $estadoFicha = $item->estado_ficha ?? 'Sin registrar'; @endphp
                                            @if($estadoFicha === 'Completo')
                                                <span class="status-badge success">Completo</span>
                                            @elseif($estadoFicha === 'En proceso')
                                                <span class="status-badge warning">En proceso</span>
                                            @else
                                                <span class="status-badge danger">Pendiente</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php $estadoRecord = $item->estado_record ?? 'Sin registrar'; @endphp
                                            @if($estadoRecord === 'Completo')
                                                <span class="status-badge success">Completo</span>
                                            @elseif($estadoRecord === 'En proceso')
                                                <span class="status-badge warning">En proceso</span>
                                            @else
                                                <span class="status-badge danger">Pendiente</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @if($listaEstudiantes->isEmpty())
                                    <tr>
                                        <td colspan="8" class="empty-state">
                                            <i class="bi bi-people"></i>
                                            <p class="mb-0">No se encontraron estudiantes registrados.</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
@push('js')
<script>
$(document).ready(function() {
    console.log("JS del dashboard docente cargado");

    // Animaciones progresivas para las métricas
    function animateMetrics() {
        $('.metric-card').each(function(index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            });
            
            setTimeout(() => {
                $(this).css({
                    'transition': 'all 0.5s ease',
                    'opacity': '1',
                    'transform': 'translateY(0)'
                });
            }, index * 100);
        });
    }

    // Efectos hover mejorados para metric cards
    $('.metric-card').hover(
        function() {
            $(this).find('.metric-icon').css({
                'transform': 'scale(1.15) rotate(10deg)',
                'transition': 'all 0.3s ease'
            });
            $(this).find('.metric-value').css({
                'color': 'var(--primary-color)',
                'transform': 'scale(1.1)'
            });
        },
        function() {
            $(this).find('.metric-icon').css({
                'transform': 'scale(1) rotate(0deg)'
            });
            $(this).find('.metric-value').css({
                'color': 'var(--text-primary)',
                'transform': 'scale(1)'
            });
        }
    );

    // Efectos para las secciones de gráficos
    $('.chart-section').hover(
        function() {
            $(this).css({
                'transform': 'translateY(-2px)',
                'box-shadow': 'var(--shadow-lg)'
            });
        },
        function() {
            $(this).css({
                'transform': 'translateY(0)',
                'box-shadow': 'var(--shadow-sm)'
            });
        }
    );

    // Efectos para la tabla de estudiantes
    $('#tablaEstudiantes tbody tr').hover(
        function() {
            $(this).css({
                'border-left': '4px solid var(--success-color)',
                'transition': 'all 0.3s ease'
            });
        },
        function() {
            $(this).css({
                'border-left': 'none'
            });
        }
    );

    // Animación para badges de estado
    $('.status-badge').hover(
        function() {
            $(this).css({
                'transform': 'scale(1.1) rotate(2deg)',
                'box-shadow': 'var(--shadow-sm)'
            });
        },
        function() {
            $(this).css({
                'transform': 'scale(1) rotate(0deg)',
                'box-shadow': 'none'
            });
        }
    );

    // Efecto loading en formulario de filtros
    $('#filtrosDocente').on('submit', function() {
        const button = $(this).find('button[type="submit"]');
        button.html('<i class="bi bi-hourglass-split"></i> Filtrando...');
        button.prop('disabled', true);
        
        // Mostrar indicador de carga
        $('.dashboard-card-body').css({
            'opacity': '0.7',
            'pointer-events': 'none'
        });
    });

    // Contador animado para métricas
    function animateCounter(element, targetValue) {
        const startValue = 0;
        const duration = 1500;
        const startTime = performance.now();
        
        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const currentValue = Math.floor(startValue + (targetValue - startValue) * progress);
            
            element.textContent = currentValue;
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            }
        }
        
        requestAnimationFrame(updateCounter);
    }

    // Inicializar contadores animados
    $('.metric-value').each(function() {
        const targetValue = parseInt($(this).text());
        if (!isNaN(targetValue)) {
            animateCounter(this, targetValue);
        }
    });

    // Mejorar búsqueda en tabla con highlight
    $('#filtroTabla').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        
        $('#tablaEstudiantes tbody tr').each(function() {
            const rowText = $(this).text().toLowerCase();
            const isMatch = rowText.includes(searchTerm);
            
            $(this).toggle(isMatch);
            
            if (isMatch && searchTerm.length > 0) {
                $(this).css({
                    'animation': 'highlight 0.5s ease',
                    'background-color': 'rgba(5, 150, 105, 0.05)'
                });
                
                setTimeout(() => {
                    $(this).css({
                        'background-color': '',
                        'animation': ''
                    });
                }, 500);
            }
        });
        
        // Mostrar mensaje si no hay resultados
        const visibleRows = $('#tablaEstudiantes tbody tr:visible').length;
        if (visibleRows === 0 && searchTerm.length > 0) {
            if ($('#no-results').length === 0) {
                $('#tablaEstudiantes tbody').append(`
                    <tr id="no-results">
                        <td colspan="8" class="empty-state">
                            <i class="bi bi-search"></i>
                            <p class="mb-0">No se encontraron resultados para "${searchTerm}"</p>
                        </td>
                    </tr>
                `);
            }
        } else {
            $('#no-results').remove();
        }
    });

    // Efectos para selects de filtros
    $('.form-select, .form-control').focus(function() {
        $(this).css({
            'transform': 'scale(1.02)',
            'transition': 'all 0.2s ease'
        });
    }).blur(function() {
        $(this).css({
            'transform': 'scale(1)'
        });
    });

    // Animación para grupos asignados
    $('.groups-section tbody tr').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateX(-20px)'
        });
        
        setTimeout(() => {
            $(this).css({
                'transition': 'all 0.4s ease',
                'opacity': '1',
                'transform': 'translateX(0)'
            });
        }, index * 100 + 500);
    });

    // Ejecutar animaciones al cargar
    setTimeout(animateMetrics, 300);

    // CSS adicional para animaciones
    $('head').append(`
        <style>
            @keyframes highlight {
                0% { background-color: rgba(5, 150, 105, 0.2); }
                50% { background-color: rgba(5, 150, 105, 0.1); }
                100% { background-color: rgba(5, 150, 105, 0.05); }
            }
            
            .metric-value {
                transition: all 0.3s ease;
            }
            
            .metric-icon {
                transition: all 0.3s ease;
            }
            
            .status-badge {
                transition: all 0.2s ease;
                cursor: default;
            }
            
            .table tbody tr {
                transition: all 0.2s ease;
            }
            
            .form-select:focus,
            .form-control:focus {
                transform: scale(1.02);
            }
            
            .chart-section {
                transition: all 0.3s ease;
            }
            
            .groups-section tbody tr {
                transition: all 0.4s ease;
            }
        </style>
    `);
});
</script>

<script>
    document.getElementById('filtroTabla').addEventListener('input', function () {
        const valor = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tablaEstudiantes tbody tr');

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();
            fila.style.display = texto.includes(valor) ? '' : 'none';
        });
    });
</script>

<script>
document.getElementById('escuela').addEventListener('change', function () {
    let escuelaId = this.value;

    // Obtener semestres
    fetch(`/docente/semestres/${escuelaId}`)
        .then(res => res.json())
        .then(data => {
            const semestreSelect = document.getElementById('semestre');
            semestreSelect.innerHTML = '<option value="">-- Todos --</option>';
            data.forEach(item => {
                semestreSelect.innerHTML += `<option value="${item.codigo}">${item.codigo}</option>`;
            });
        });

    // Obtener supervisores
    fetch(`/docente/supervisores/${escuelaId}`)
        .then(res => res.json())
        .then(data => {
            const supervisorSelect = document.getElementById('supervisor');
            supervisorSelect.innerHTML = '<option value="">-- Todos --</option>';
            data.forEach(item => {
                supervisorSelect.innerHTML += `<option value="${item.id}">${item.nombres}</option>`;
            });
        });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function createChart(elId, type, data, options) {
        var el = document.getElementById(elId);
        if (el) {
            var ctx = el.getContext('2d');
            new Chart(ctx, { type, data, options });
        }
    }

    // Bar chart - Estudiantes por Escuela
    createChart('barChart', 'bar', {
        labels: {!! json_encode($estudiantesPorEscuela->pluck('escuela')) !!},
        datasets: [{
            label: 'Total Estudiantes',
            data: {!! json_encode($estudiantesPorEscuela->pluck('total')) !!},
            backgroundColor: '#d97706',
            borderColor: '#b45309',
            borderWidth: 1,
            borderRadius: 4
        }]
    }, {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: '#1e293b',
                    font: {
                        family: 'Inter',
                        weight: '500'
                    }
                }
            },
            tooltip: {
                backgroundColor: '#ffffff',
                titleColor: '#1e293b',
                bodyColor: '#64748b',
                borderColor: '#e2e8f0',
                borderWidth: 2,
                cornerRadius: 8,
                titleFont: {
                    family: 'Inter',
                    weight: 'bold'
                },
                bodyFont: {
                    family: 'Inter'
                }
            }
        },
        scales: { 
            y: { 
                beginAtZero: true,
                ticks: {
                    color: '#64748b',
                    font: {
                        family: 'Inter',
                        weight: '500'
                    }
                },
                grid: {
                    color: '#f1f5f9'
                }
            },
            x: {
                ticks: {
                    color: '#64748b',
                    font: {
                        family: 'Inter',
                        weight: '500'
                    }
                },
                grid: {
                    display: false
                }
            }
        }
    });

    // Pie chart - Estado de Fichas
    createChart('pieChart', 'pie', {
        labels: {!! json_encode($estadoFichas->pluck('estado_ficha')) !!},
        datasets: [{
            data: {!! json_encode($estadoFichas->pluck('total')) !!},
            backgroundColor: [
                '#059669',
                '#dc2626',
                '#d97706',
                '#0891b2'
            ],
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    }, {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#1e293b',
                    font: {
                        family: 'Inter',
                        weight: '500'
                    },
                    padding: 20
                }
            },
            tooltip: {
                backgroundColor: '#ffffff',
                titleColor: '#1e293b',
                bodyColor: '#64748b',
                borderColor: '#e2e8f0',
                borderWidth: 2,
                cornerRadius: 8,
                titleFont: {
                    family: 'Inter',
                    weight: 'bold'
                },
                bodyFont: {
                    family: 'Inter'
                }
            }
        }
    });
</script>

<script>
    var ctxHB = document.getElementById('horizontalBarChart');
    if (ctxHB) {
        new Chart(ctxHB.getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($supervisoresRanking->pluck('nombres')->toArray()) !!},
                datasets: [{
                    label: 'Estudiantes asignados',
                    data: {!! json_encode($supervisoresRanking->pluck('total')->toArray()) !!},
                    backgroundColor: '#0891b2',
                    borderColor: '#0e7490',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#1e293b',
                            font: {
                                family: 'Inter',
                                weight: '500'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#ffffff',
                        titleColor: '#1e293b',
                        bodyColor: '#64748b',
                        borderColor: '#e2e8f0',
                        borderWidth: 2,
                        cornerRadius: 8,
                        titleFont: {
                            family: 'Inter',
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Inter'
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: '#64748b',
                            font: {
                                family: 'Inter',
                                weight: '500'
                            }
                        },
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#64748b',
                            font: {
                                family: 'Inter',
                                weight: '500'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
@extends('template')
@section('title', 'Gestión de Estudiantes por Grupo')
@section('subtitle', 'Asignar y administrar estudiantes en grupos de práctica')

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

    .grupo-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    /* Card Principal */
    .grupo-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .grupo-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .grupo-card-header {
        background: linear-gradient(135deg, var(--surface-color) 0%, #f8fafc 100%);
        border-bottom: 2px solid var(--border-color);
        padding: 1.5rem 2rem;
        position: relative;
    }

    .grupo-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .grupo-card-title {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-transform: none;
    }

    .grupo-card-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .grupo-card-body {
        padding: 1.5rem;
    }

    /* Tabla Principal */
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
        padding: 1rem 0.75rem;
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

    /* Badges modernos */
    .id-badge {
        background: linear-gradient(135deg, var(--secondary-color), #475569);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: var(--shadow-sm);
    }

    .docente-name {
        font-weight: 600;
        color: var(--text-primary);
        text-align: left;
    }

    .semestre-badge {
        background: linear-gradient(135deg, var(--info-color), #0e7490);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-block;
    }

    .escuela-badge {
        background: linear-gradient(135deg, var(--success-color), #047857);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
    }

    .grupo-name {
        font-weight: 600;
        color: var(--primary-color);
        text-align: left;
    }

    /* Botones modernos */
    .btn {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.375rem;
        margin: 0.125rem;
    }

    .btn-success {
        background: var(--success-color);
        color: white;
    }

    .btn-success:hover {
        background: #047857;
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
        color: white;
    }

    .btn-info {
        background: var(--info-color);
        color: white;
    }

    .btn-info:hover {
        background: #0e7490;
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
        color: white;
    }

    .btn-danger {
        background: var(--danger-color);
        color: white;
    }

    .btn-danger:hover {
        background: #991b1b;
        color: white;
    }

    .btn-secondary {
        background: var(--secondary-color);
        color: white;
    }

    .btn-secondary:hover {
        background: #475569;
        color: white;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-light);
        color: white;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 1rem;
        box-shadow: var(--shadow-lg);
    }

    .modal-header {
        border-radius: 1rem 1rem 0 0;
        padding: 1.5rem 2rem;
        border-bottom: none;
        color: white;
    }

    .modal-header.bg-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light)) !important;
    }

    .modal-header.bg-info {
        background: linear-gradient(135deg, var(--info-color), #0e7490) !important;
    }

    .modal-header.bg-danger {
        background: linear-gradient(135deg, var(--danger-color), #991b1b) !important;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-header .close {
        background: transparent;
        border: none;
        font-size: 1.2rem;
        color: #ffffffcc;
        padding: 0.5rem 0.7rem;
        border-radius: 50%;
        transition: all 0.3s ease-in-out;
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .modal-header .close:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        transform: rotate(90deg);
        box-shadow: 0 0 5px #ffffff88;
    }

    .modal-body {
        padding: 2rem;
        background: var(--surface-color);
    }

    .modal-footer {
        background: var(--background-color);
        border-top: 1px solid var(--border-color);
        border-radius: 0 0 1rem 1rem;
        padding: 1.5rem 2rem;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
        display: block;
    }

    .form-control {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        padding: 0.875rem 1rem;
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

    /* Search input especial */
    .buscar-estudiante,
    .buscar-estudiante-asignado {
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        background: var(--surface-color);
        transition: all 0.3s ease;
        position: relative;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z'/%3e%3c/svg%3e");
        background-position: left 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1rem 1rem;
        padding-left: 2.5rem;
    }

    .buscar-estudiante:focus,
    .buscar-estudiante-asignado:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        outline: none;
        background: white;
    }

    /* Tabla wrapper mejorada */
    .tabla-wrapper {
        max-height: 300px;
        overflow-y: auto;
        border: 2px solid var(--border-color);
        border-radius: 0.75rem;
        background: var(--surface-color);
        box-shadow: var(--shadow-sm);
    }

    .tabla-wrapper table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        margin: 0;
    }

    .tabla-wrapper thead th {
        position: sticky;
        top: 0;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        z-index: 10;
        border-bottom: 2px solid var(--border-color);
        padding: 0.75rem;
        font-weight: 600;
        color: var(--text-primary);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
    }

    .tabla-wrapper tbody td {
        padding: 0.75rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.875rem;
    }

    .tabla-wrapper tbody tr:hover {
        background-color: rgba(30, 58, 138, 0.02);
    }

    /* Checkboxes modernos */
    input[type="checkbox"] {
        appearance: none;
        width: 1.2rem;
        height: 1.2rem;
        border: 2px solid var(--border-color);
        border-radius: 0.25rem;
        background: var(--surface-color);
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }

    input[type="checkbox"]:checked {
        background: var(--primary-color);
        border-color: var(--primary-color);
    }

    input[type="checkbox"]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 0.875rem;
        font-weight: bold;
    }

    input[type="checkbox"]:hover {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
    }

    /* Botones btn-sm mejorados */
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.8rem;
        min-width: auto;
    }

    /* Estados hover para tabla */
    .tabla-wrapper tbody tr:hover {
        background-color: rgba(30, 58, 138, 0.02);
        transform: translateY(-1px);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Scroll personalizado */
    .tabla-wrapper::-webkit-scrollbar {
        width: 8px;
    }

    .tabla-wrapper::-webkit-scrollbar-track {
        background: var(--background-color);
        border-radius: 4px;
    }

    .tabla-wrapper::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 4px;
        transition: background 0.3s ease;
    }

    .tabla-wrapper::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-color);
    }

    /* Estados de carga */
    .loading {
        position: relative;
        pointer-events: none;
        opacity: 0.7;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 1.5rem;
        height: 1.5rem;
        border: 2px solid transparent;
        border-top: 2px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 1000;
        background: var(--surface-color);
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Estados vacíos mejorados */
    .text-muted i {
        color: var(--border-color) !important;
    }

    /* Mejoras en modales XL */
    .modal-xl .modal-dialog {
        max-width: 1200px;
    }

    /* Form controls en modales */
    .modal-body .form-control {
        border: 2px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .modal-body .form-control:focus {
        border-color: var(--primary-color);
        background: white;
        transform: scale(1.01);
    }

    /* Labels con iconos */
    .modal-body label i {
        margin-right: 0.5rem;
        color: var(--primary-color);
        width: 1rem;
        text-align: center;
    }

    /* Responsive mejoras adicionales */
    @media (max-width: 576px) {
        .modal-xl .modal-dialog {
            max-width: 95%;
            margin: 1rem auto;
        }

        .tabla-wrapper {
            max-height: 200px;
        }

        .card-header .row {
            flex-direction: column;
            gap: 1rem;
        }

        .card-header .col-md-6 {
            width: 100%;
        }

        .btn {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }

        .info-card {
            padding: 0.75rem;
        }

        .info-card p {
            font-size: 0.875rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.25rem;
        }
    }

    /* Transiciones para elementos */
    .table tbody tr,
    .btn,
    .badge,
    .form-control,
    .modal-content {
        transition: all 0.3s ease;
    }

    /* Estados de enfoque mejorados */
    .btn:focus,
    .form-control:focus {
        outline: 0;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.25);
    }

    /* Hover effects para badges */
    .badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-sm);
    }

    /* Card header responsive */
    @media (max-width: 768px) {
        .card-header {
            padding: 0.75rem 1rem;
        }

        .card-header h6 {
            font-size: 0.875rem;
        }
    }

    /* ...existing styles... */
</style>
@endpush

@section('content')

<div class="grupo-container">
  <div class="grupo-card fade-in">
    <div class="grupo-card-header">
      <h5 class="grupo-card-title">
        <i class="bi bi-people"></i>
        Gestión de Estudiantes por Grupo
      </h5>
    </div>
    <div class="grupo-card-body">
      <div class="table-container">
        <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Docente</th>
                <th>Semestre</th>
                <th>Escuela</th>
                <th>Nombre de grupo</th>
                <th>Agregar alumno</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($grupos_practica as $index => $grupo)
              <tr>
                <td>
                  <span class="grupo-name">{{ $index + 1 }}</span>
                </td>
                <td class="docente-name">{{ $grupo->docente->nombres }} {{ $grupo->docente->apellidos }}</td>
                <td>
                  <span class="grupo-name">{{ $grupo->semestre->codigo }}</span>
                </td>
                <td>
                  <span class="grupo-name">{{ $grupo->escuela->name }}</span>
                </td>
                <td class="grupo-name">{{ $grupo->nombre_grupo }}</td>
                <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEditar{{ $grupo->id }}">
                    <i class="bi bi-person-plus"></i>
                    Asignar alumno
                  </button>
                </td>
                <td class="text-center">
                  <button class="btn btn-info" data-toggle="modal" data-target="#modalVer{{ $grupo->id }}">
                    <i class="bi bi-eye"></i>
                    Ver detalles
                  </button>
                </td>
              </tr>
              @endforeach
              @if($grupos_practica->isEmpty())
              <tr>
                <td colspan="7" class="text-muted">
                  <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                  No se encontraron grupos de práctica.
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

<!-- MODALES POR CADA GRUPO -->
@foreach($grupos_practica as $grupo)
<!-- Modal Asignar alumnos -->
<div class="modal fade" id="modalEditar{{ $grupo->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ route('grupos.asignarAlumnos') }}">
        @csrf
        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
        <div class="modal-header bg-primary">
          <h5 class="modal-title">
            <i class="bi bi-person-plus-fill"></i> 
            Asignar Alumnos al Grupo: <strong>{{ $grupo->nombre_grupo }}</strong>
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">


            {{-- Lista de supervisores ya asignados a la escuela --}}
{{-- Lista de supervisores ya asignados a la escuela --}}
{{-- Supervisor Asignado --}}
<div id="supervisor-asignado-{{ $grupo->id }}" class="mb-3 border p-3 rounded shadow-sm bg-white">
  <label class="font-weight-bold mb-2">Supervisor Asignado</label>

  <select class="form-control custom-select mb-2" name="id_supervisor" id="select-supervisor-{{ $grupo->id }}">

    @php
      $docente3 = \App\Models\Persona::where('rol_id', 3)
          ->whereHas('grupo_estudiantes2.grupo', function ($query) use ($grupo) {
              $query->where('id_escuela', $grupo->id_escuela);
          })
          ->get();
    @endphp

    @foreach($docente3 as $docente)
      <option value="{{ $docente->id }}" {{ $docente->id == $grupo->id_docente ? 'selected' : '' }}>
        {{ $docente->nombres }} {{ $docente->apellidos }}
      </option>
    @endforeach 
  </select>

  <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick="mostrarNuevoSupervisor({{ $grupo->id }})">
    Asignar nuevo supervisor
  </button>
</div>

{{-- Nueva Asignación de Supervisor --}}
<div id="nuevo-supervisor-{{ $grupo->id }}" class="mb-3 border p-3 rounded shadow-sm bg-light" style="display: none;">
  <label class="font-weight-bold mb-2">Asignar Nuevo Supervisor</label>

  @if($docente2->isEmpty())
    <div class="alert alert-warning text-center mb-2">
      No hay supervisores disponibles
    </div>
  @else
    <select class="form-control custom-select mb-2" name="id_supervisor" id="select-nuevo-supervisor-{{ $grupo->id }}" disabled>

      @foreach($docente2 as $docente)
        <option value="{{ $docente->id }}" {{ $docente->id == $grupo->id_docente ? 'selected' : '' }}>
          {{ $docente->nombres }} {{ $docente->apellidos }}
        </option>
      @endforeach 
    </select>
  @endif

  <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="cancelarNuevoSupervisor({{ $grupo->id }})">
    Cancelar
  </button>
</div>




            <label class="font-weight-bold">
              <i class="bi bi-person-badge"></i>
              Docente Asignado
            </label>
            <select class="form-control" name="id_supervisor">
              @foreach($docentes as $docente)
              <option value="{{ $docente->id }}" {{ $docente->id == $grupo->id_docente ? 'selected' : '' }}>
                {{ $docente->nombres }} {{ $docente->apellidos }}
              </option>
              @endforeach
            </select>

          </div>
          <div class="form-group">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">
                    <i class="bi bi-people"></i>
                    Lista de Alumnos Disponibles
                  </h6>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control buscar-estudiante" data-grupo="{{ $grupo->id }}" placeholder="🔍 Buscar estudiante...">
                </div>
              </div>
            </div>
            <div class="tabla-wrapper">
              <table class="table table-hover table-sm mb-0 tabla-estudiantes" data-grupo="{{ $grupo->id }}">
                <thead>
                  <tr>
                    <th class="text-center">
                      <input type="checkbox" class="check-all" data-grupo="{{ $grupo->id }}">
                      <span class="ml-2">Todo</span>
                    </th>
                    <th>Nombre Completo</th>
                    <th>Código</th>
                    <th>Escuela</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $estudiantesAsignados = \App\Models\grupo_estudiante::pluck('id_estudiante')->toArray();
                    $estudiantesGrupo = \App\Models\Persona::with('escuela')
                        ->where('rol_id', 4)
                        ->where('id_escuela', $grupo->id_escuela)
                        ->whereNotIn('id',  $estudiantesAsignados)
                        ->get();
                @endphp
                  @foreach($estudiantesGrupo as $estudiante)
                  <tr>
                    <td class="text-center">
                      <input type="checkbox" name="estudiantes[]" value="{{ $estudiante->id }}" class="check-estudiante" data-grupo="{{ $grupo->id }}">
                    </td>
                    <td>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</td>
                    <td>
                      <span class="badge badge-secondary">{{ $estudiante->codigo }}</span>
                    </td>
                    <td>{{ $estudiante->escuela->name ?? 'Sin escuela' }}</td>
                  </tr>
                  @endforeach
                  @if($estudiantesGrupo->isEmpty())
                  <tr>
                    <td colspan="4" class="text-center text-muted">
                      <i class="bi bi-person-x" style="font-size: 2rem; display: block; margin: 1rem 0;"></i>
                      No hay estudiantes disponibles para asignar
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle"></i> 
            Asignar Alumnos Seleccionados
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="bi bi-x-circle"></i> 
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ver grupo -->
<div class="modal fade" id="modalVer{{ $grupo->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title">
          <i class="bi bi-info-circle"></i>
          Detalles del Grupo
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal">
          &times;
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="info-card">
              <p><strong><i class="bi bi-collection"></i> Nombre del grupo:</strong> {{ $grupo->nombre_grupo }}</p>
              <p><strong><i class="bi bi-person-badge"></i> Docente:</strong> {{ $grupo->docente->nombres }} {{ $grupo->docente->apellidos }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-card">
              <p><strong><i class="bi bi-calendar3"></i> Semestre:</strong> {{ $grupo->semestre->codigo }}</p>
              <p><strong><i class="bi bi-building"></i> Escuela:</strong> {{ $grupo->escuela->name }}</p>
            </div>
          </div>
        </div>

        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h6 class="m-0 font-weight-bold text-primary text-uppercase">
                <i class="bi bi-people-fill"></i>
                Estudiantes Asignados
              </h6>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control buscar-estudiante-asignado" data-grupo="{{ $grupo->id }}" placeholder="🔍 Buscar estudiante...">
            </div>
          </div>
        </div>
        @php
        $estudiantesAsignados = \App\Models\grupo_estudiante::with('estudiante')->where('id_grupo_practica', $grupo->id)->get();
        @endphp
        @if($estudiantesAsignados->isEmpty())
          <div class="text-center text-muted py-4">
            <i class="bi bi-person-x" style="font-size: 3rem; display: block; margin-bottom: 1rem; color: var(--border-color);"></i>
            <p class="mb-0">No hay estudiantes asignados a este grupo.</p>
          </div>
        @else
          <div class="tabla-wrapper">
            <table class="table table-hover tabla-estudiantes-asignados" id="tablaAsignados{{ $grupo->id }}">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre Completo</th>
                  <th>Código</th>
                  <th>Escuela</th>
                  <th>Supervisor</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($estudiantesAsignados as $index => $registro)
                <tr>
                  <td>
                    <span class="badge badge-primary">{{ $index + 1 }}</span>
                  </td>
                  <td>{{ $registro->estudiante->nombres }} {{ $registro->estudiante->apellidos }}</td>
                  <td>
                    <span class="badge badge-secondary">{{ $registro->estudiante->codigo }}</span>
                  </td>
                  <td>{{ $registro->estudiante->escuela->name ?? 'Sin escuela' }}</td>
                  <td>{{ $registro->supervisor?->nombres ?? 'Sin supervisor' }}</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-sm abrir-eliminar"
                        data-nombre="{{ $registro->estudiante->nombres }} {{ $registro->estudiante->apellidos }}"
                        data-grupo="{{ $grupo->nombre_grupo }}"
                        data-url="{{ route('grupos.eliminarAsignado', $registro->id) }}">
                        <i class="bi bi-trash"></i>
                        
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- MODAL ELIMINAR GLOBAL -->
<div class="modal fade" id="modalConfirmarEliminar" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 2000;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">
          <i class="bi bi-exclamation-triangle"></i> 
          Confirmar eliminación
        </h5>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <i class="bi bi-person-x text-danger" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
          <p id="textoModalEliminar"></p>
          <small class="text-muted">Esta acción no se puede deshacer</small>
        </div>
      </div>
      <div class="modal-footer">
        <form id="formEliminarAsignado" method="GET">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash"></i> 
            Eliminar
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modalConfirmarEliminar').modal('hide')">
            <i class="bi bi-x-circle"></i> 
            Cancelar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function mostrarNuevoSupervisor(grupoId) {
    document.getElementById(`supervisor-asignado-${grupoId}`).style.display = 'none';
    document.getElementById(`nuevo-supervisor-${grupoId}`).style.display = 'block';

    const nuevoSelect = document.getElementById(`select-nuevo-supervisor-${grupoId}`);
    if (nuevoSelect) {
        nuevoSelect.disabled = false;
    }
  }

  function cancelarNuevoSupervisor(grupoId) {
    document.getElementById(`nuevo-supervisor-${grupoId}`).style.display = 'none';
    document.getElementById(`supervisor-asignado-${grupoId}`).style.display = 'block';

    const nuevoSelect = document.getElementById(`select-nuevo-supervisor-${grupoId}`);
    if (nuevoSelect) {
        nuevoSelect.disabled = true;
    }
  }
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("JS cargado directamente sin stack");

    // FILTRO estudiantes NO asignados
    document.querySelectorAll('.buscar-estudiante').forEach(function(input){
        input.addEventListener('keyup', function(){
            let valor = this.value.toLowerCase();
            let grupoId = this.dataset.grupo;

            document.querySelectorAll(`.tabla-estudiantes[data-grupo="${grupoId}"] tbody tr`).forEach(function(tr){
                let textoFila = tr.textContent.toLowerCase();
                tr.style.display = textoFila.includes(valor) ? '' : 'none';
            });
        });
    });

    // FILTRO estudiantes YA asignados
    document.querySelectorAll('.buscar-estudiante-asignado').forEach(function(input){
        input.addEventListener('keyup', function(){
            let valor = this.value.toLowerCase();
            let grupoId = this.dataset.grupo;

            document.querySelectorAll(`#tablaAsignados${grupoId} tbody tr`).forEach(function(tr){
                let textoFila = tr.textContent.toLowerCase();
                tr.style.display = textoFila.includes(valor) ? '' : 'none';
            });
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("JS cargado sin duplicados");

    // FILTRO estudiantes NO asignados
    document.querySelectorAll('.buscar-estudiante').forEach(function(input){
        input.addEventListener('keyup', function(){
            let grupoId = this.dataset.grupo;
            let valor = this.value.toLowerCase();
            document.querySelectorAll(`.tabla-estudiantes[data-grupo="${grupoId}"] tbody tr`).forEach(function(tr){
                tr.style.display = tr.textContent.toLowerCase().includes(valor) ? '' : 'none';
            });
        });
    });

    // FILTRO estudiantes YA asignados
    document.querySelectorAll('.buscar-estudiante-asignado').forEach(function(input){
        input.addEventListener('keyup', function(){
            let grupoId = this.dataset.grupo;
            let valor = this.value.toLowerCase();
            let tabla = document.getElementById(`tablaAsignados${grupoId}`);
            if (tabla) {
                tabla.querySelectorAll('tbody tr').forEach(function(tr){
                    tr.style.display = tr.textContent.toLowerCase().includes(valor) ? '' : 'none';
                });
            }
        });
    });

    // CHECK ALL
    document.querySelectorAll('.check-all').forEach(function(checkbox){
        checkbox.addEventListener('change', function(){
            let grupoId = this.dataset.grupo;
            document.querySelectorAll(`.check-estudiante[data-grupo="${grupoId}"]`).forEach(function(cb){
                cb.checked = checkbox.checked;
            });
        });
    });

    // MODAL ELIMINAR
    document.querySelectorAll('.abrir-eliminar').forEach(function(btn){
        btn.addEventListener('click', function(){
            let nombre = this.dataset.nombre;
            let grupo = this.dataset.grupo;
            let url = this.dataset.url;
            abrirModalEliminar(nombre, grupo, url);
        });
    });
});

function abrirModalEliminar(nombre, grupo, url){
    $('.modal.show').modal('hide');
    document.getElementById('textoModalEliminar').innerText = `¿Estás seguro de eliminar a ${nombre} del grupo ${grupo}?`;
    document.getElementById('formEliminarAsignado').action = url;
    setTimeout(() => $('#modalConfirmarEliminar').modal('show'), 300);
}

// Limpiar backdrops cuando se cierra el modal de eliminar
$('#modalConfirmarEliminar').on('hidden.bs.modal', () => {
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("JS mejorado cargado");

    // FILTRO estudiantes NO asignados con efectos
    document.querySelectorAll('.buscar-estudiante').forEach(function(input){
        input.addEventListener('keyup', function(){
            let grupoId = this.dataset.grupo;
            let valor = this.value.toLowerCase();
            
            // Agregar efecto de loading
            this.classList.add('loading');
            
            setTimeout(() => {
                document.querySelectorAll(`.tabla-estudiantes[data-grupo="${grupoId}"] tbody tr`).forEach(function(tr){
                    tr.style.display = tr.textContent.toLowerCase().includes(valor) ? '' : 'none';
                });
                input.classList.remove('loading');
                updateSelectedCount(grupoId);
            }, 200);
        });
    });

    // FILTRO estudiantes YA asignados con efectos
    document.querySelectorAll('.buscar-estudiante-asignado').forEach(function(input){
        input.addEventListener('keyup', function(){
            let grupoId = this.dataset.grupo;
            let valor = this.value.toLowerCase();
            let tabla = document.getElementById(`tablaAsignados${grupoId}`);
            
            this.classList.add('loading');
            
            setTimeout(() => {
                if (tabla) {
                    tabla.querySelectorAll('tbody tr').forEach(function(tr){
                        tr.style.display = tr.textContent.toLowerCase().includes(valor) ? '' : 'none';
                    });
                }
                input.classList.remove('loading');
            }, 200);
        });
    });

    // CHECK ALL mejorado
    document.querySelectorAll('.check-all').forEach(function(checkbox){
        checkbox.addEventListener('change', function(){
            let grupoId = this.dataset.grupo;
            let isChecked = this.checked;
            
            document.querySelectorAll(`.check-estudiante[data-grupo="${grupoId}"]`).forEach(function(cb){
                if (cb.closest('tr').style.display !== 'none') {
                    cb.checked = isChecked;
                    // Animación en la fila
                    cb.closest('tr').style.transform = isChecked ? 'scale(1.02)' : 'scale(1)';
                    setTimeout(() => {
                        cb.closest('tr').style.transform = 'scale(1)';
                    }, 200);
                }
            });
            
            updateSelectedCount(grupoId);
        });
    });

    // Checkboxes individuales con animación
    document.querySelectorAll('.check-estudiante').forEach(function(checkbox){
        checkbox.addEventListener('change', function(){
            let grupoId = this.dataset.grupo;
            updateSelectedCount(grupoId);
            
            // Animación en la fila
            this.closest('tr').style.transform = this.checked ? 'scale(1.02)' : 'scale(1)';
            setTimeout(() => {
                this.closest('tr').style.transform = 'scale(1)';
            }, 200);
        });
    });

    // MODAL ELIMINAR con loading
    document.querySelectorAll('.abrir-eliminar').forEach(function(btn){
        btn.addEventListener('click', function(){
            let nombre = this.dataset.nombre;
            let grupo = this.dataset.grupo;
            let url = this.dataset.url;
            
            this.classList.add('loading');
            
            setTimeout(() => {
                abrirModalEliminar(nombre, grupo, url);
                this.classList.remove('loading');
            }, 300);
        });
    });

    // Auto-focus en búsquedas
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            let searchInput = this.querySelector('.buscar-estudiante, .buscar-estudiante-asignado');
            if (searchInput) {
                setTimeout(() => searchInput.focus(), 200);
            }
        });
    });

    // Limpiar búsquedas al cerrar modales
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            let searchInputs = this.querySelectorAll('.buscar-estudiante, .buscar-estudiante-asignado');
            searchInputs.forEach(input => {
                input.value = '';
                let grupoId = input.dataset.grupo;
                if (grupoId) {
                    // Mostrar todas las filas
                    document.querySelectorAll(`.tabla-estudiantes[data-grupo="${grupoId}"] tbody tr`).forEach(tr => {
                        tr.style.display = '';
                    });
                    
                    let tabla = document.getElementById(`tablaAsignados${grupoId}`);
                    if (tabla) {
                        tabla.querySelectorAll('tbody tr').forEach(tr => {
                            tr.style.display = '';
                        });
                    }
                    
                    updateSelectedCount(grupoId);
                }
            });
        });
    });

    // Función para actualizar contador
    function updateSelectedCount(grupoId) {
        let checkboxes = document.querySelectorAll(`.check-estudiante[data-grupo="${grupoId}"]:checked`);
        let visibleCheckboxes = Array.from(checkboxes).filter(cb => 
            cb.closest('tr').style.display !== 'none'
        );
        
        let checkAll = document.querySelector(`.check-all[data-grupo="${grupoId}"]`);
        let allVisible = document.querySelectorAll(`.check-estudiante[data-grupo="${grupoId}"]`);
        let allVisibleFiltered = Array.from(allVisible).filter(cb => 
            cb.closest('tr').style.display !== 'none'
        );
        
        if (checkAll && allVisibleFiltered.length > 0) {
            checkAll.checked = visibleCheckboxes.length === allVisibleFiltered.length;
            checkAll.indeterminate = visibleCheckboxes.length > 0 && 
                                     visibleCheckboxes.length < allVisibleFiltered.length;
        }
    }

    // Loading en formularios
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            let submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });
    });
});
</script>
@endsection

@push('js')
@endpush

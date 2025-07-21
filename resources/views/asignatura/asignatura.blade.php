@extends('template')
@section('title', 'Gestión de Grupos de Asignatura')
@section('subtitle', 'Administrar grupos de práctica por asignaturas y docentes')

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

    .asignatura-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    /* Card Principal */
    .asignatura-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .asignatura-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .asignatura-card-header {
        background: linear-gradient(135deg, var(--surface-color) 0%, #f8fafc 100%);
        border-bottom: 2px solid var(--border-color);
        padding: 1.5rem 2rem;
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .asignatura-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .asignatura-card-title {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-transform: none;
    }

    .asignatura-card-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .asignatura-card-body {
        padding: 1.5rem;
    }

    /* Botón crear grupo */
    .btn-crear-grupo {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-sm);
    }

    .btn-crear-grupo:hover {
        background: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    .btn-crear-grupo i {
        font-size: 1rem;
    }

    /* Tabla Moderna */
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

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges para datos */
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

    .estado-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .estado-activo {
        background: rgba(5, 150, 105, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(5, 150, 105, 0.2);
    }

    .estado-inactivo {
        background: rgba(220, 38, 38, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(220, 38, 38, 0.2);
    }

    /* Botones de Acción */
    .btn {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
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
        min-width: 40px;
    }

    .btn-warning {
        background: var(--warning-color);
        color: white;
    }

    .btn-warning:hover {
        background: #b45309;
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
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
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

    .btn-secondary {
        background: var(--secondary-color);
        color: white;
    }

    .btn-secondary:hover {
        background: #475569;
        color: white;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 1rem;
        box-shadow: var(--shadow-lg);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border-radius: 1rem 1rem 0 0;
        padding: 1.5rem 2rem;
        border-bottom: none;
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

    .form-control:disabled {
        background-color: #f8fafc;
        border-color: #e2e8f0;
        color: var(--text-secondary);
        opacity: 0.7;
    }

    /* Alertas modernas */
    .alert {
        border: none;
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        border-left: 4px solid;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .alert-success {
        background: rgba(5, 150, 105, 0.1);
        border-left-color: var(--success-color);
        color: #047857;
    }

    .alert-danger {
        background: rgba(220, 38, 38, 0.1);
        border-left-color: var(--danger-color);
        color: #991b1b;
    }

    .alert-dismissible .close {
        position: absolute;
        top: 0.5rem;
        right: 1rem;
        padding: 0.5rem;
        color: inherit;
        opacity: 0.7;
    }

    .alert-dismissible .close:hover {
        opacity: 1;
    }

    /* Estados vacíos */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--border-color);
        margin-bottom: 1rem;
    }

    /* Mejoras adicionales para integración completa */
    
    /* Hover effects para badges */
    .id-badge:hover,
    .semestre-badge:hover,
    .escuela-badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
    }

    /* Estados de badges con transiciones */
    .estado-badge {
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .estado-badge:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    /* Mejoras en nombres */
    .docente-name:hover,
    .grupo-name:hover {
        color: var(--primary-light);
        transform: translateX(2px);
    }

    /* Botones con tooltips */
    .btn[data-toggle="modal"] {
        position: relative;
    }

    .btn[data-toggle="modal"]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: var(--text-primary);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        white-space: nowrap;
        z-index: 1000;
    }

    /* Form controls con estados */
    .form-control:valid {
        border-color: var(--success-color);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }

    .form-control:invalid {
        border-color: var(--danger-color);
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* Selects con estilos mejorados */
    select.form-control {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    /* Modal de eliminación especial */
    .modal-content form[action*="destroy"] .modal-header {
        background: linear-gradient(135deg, var(--danger-color), #991b1b);
    }

    /* Loading states */
    .form-control.loading {
        background-image: url("data:image/svg+xml,%3csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3e%3cpath fill='%236b7280' d='M10 3.5a6.5 6.5 0 1 0 6.5 6.5h-1.5a5 5 0 1 1-5-5V3.5z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1rem 1rem;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { background-position-x: right 0.75rem; transform: rotate(0deg); }
        100% { background-position-x: right 0.75rem; transform: rotate(360deg); }
    }

    /* Alert icons mejorados */
    .alert i {
        margin-right: 0.5rem;
        font-size: 1.1rem;
    }

    .alert-success i {
        color: var(--success-color);
    }

    .alert-danger i {
        color: var(--danger-color);
    }

    /* Placeholder mejorado */
    .form-control::placeholder {
        color: var(--text-secondary);
        opacity: 0.7;
        font-style: italic;
    }

    /* Estados de focus mejorados */
    .btn:focus,
    .form-control:focus {
        outline: 0;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.25);
    }

    /* Mejoras en el modal de crear */
    .modal-dialog {
        transition: transform 0.3s ease-out;
    }

    .modal.fade .modal-dialog {
        transform: translateY(-50px);
    }

    .modal.show .modal-dialog {
        transform: translateY(0);
    }

    /* Table responsive mejorada */
    .table-responsive {
        border-radius: 0.75rem;
        overflow: hidden;
    }

    /* Estados hover para las filas */
    .table tbody tr:hover .id-badge,
    .table tbody tr:hover .semestre-badge,
    .table tbody tr:hover .escuela-badge {
        transform: scale(1.05);
    }

    /* Footer del modal mejorado */
    .modal-footer .btn {
        min-width: 120px;
    }

    /* Responsive mejoras adicionales */
    @media (max-width: 576px) {
        .estado-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }

        .id-badge,
        .semestre-badge,
        .escuela-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }

        .btn {
            min-width: 35px;
            padding: 0.375rem 0.5rem;
        }

        .asignatura-card-title {
            font-size: 1.125rem;
        }

        .modal-title {
            font-size: 1.125rem;
        }
    }

    /* Efectos de aparición para elementos */
    .badge,
    .btn {
        transition: all 0.3s ease;
    }

    /* Estados de validación para selects dependientes */
    select.form-control:disabled {
        background-color: #f8fafc;
        color: var(--text-secondary);
        cursor: not-allowed;
    }

    select.form-control:disabled option {
        color: var(--text-secondary);
    }

    /* Mejoras en spacing */
    .form-group:last-child {
        margin-bottom: 0;
    }

    /* Iconos en labels con mejor spacing */
    .form-group label i {
        margin-right: 0.5rem;
        color: var(--primary-color);
        width: 1rem;
        text-align: center;
    }

    /* ...existing styles... */
</style>
@endpush

@section('content')
<div class="asignatura-container">

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="asignatura-card fade-in">
        <div class="asignatura-card-header">
            <h5 class="asignatura-card-title">
                <i class="bi bi-collection"></i>
                Lista de Grupos de Práctica
            </h5>
            <button class="btn-crear-grupo" data-toggle="modal" data-target="#crearGrupoModal">
                <i class="bi bi-plus-circle"></i> 
                Registrar Grupo
            </button>
        </div>
        
        <div class="asignatura-card-body">
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
                                <th>Estado</th>
                                <th>Acciones</th>
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
                                    <span class="estado-badge {{ $grupo->estado == 'Activo' ? 'estado-activo' : 'estado-inactivo' }}">
                                        
                                        {{ $grupo->estado }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Editar -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditar{{ $grupo->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <!-- Eliminar -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar{{ $grupo->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @if($grupos_practica->isEmpty())
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="bi bi-collection"></i>
                                    <p class="mb-0">No se encontraron grupos de práctica registrados.</p>
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

<!-- Modales para editar y eliminar -->
@foreach ($grupos_practica as $grupo)
<!-- MODAL EDITAR -->
<div class="modal fade" id="modalEditar{{ $grupo->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ route('grupos.update', $grupo->id) }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="bi bi-pencil-square"></i>
            Editar Grupo
          </h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>
              <i class="bi bi-person-badge"></i>
              Docente
            </label>
            <select name="id_docente" class="form-control" required>
              @foreach($docentes as $docente)
                <option value="{{ $docente->id }}" {{ $docente->id == $grupo->id_docente ? 'selected' : '' }}>
                  {{ $docente->nombres }} {{ $docente->apellidos }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>
              <i class="bi bi-calendar3"></i>
              Semestre
            </label>
            <select name="id_semestre" class="form-control" required>
              @foreach($semestres as $semestre)
                <option value="{{ $semestre->id }}" {{ $semestre->id == $grupo->id_semestre ? 'selected' : '' }}>
                  {{ $semestre->codigo }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>
              <i class="bi bi-building"></i>
              Escuela
            </label>
            <select name="id_escuela" class="form-control" required>
              @foreach($escuelas as $escuela)
                <option value="{{ $escuela->id }}" {{ $escuela->id == $grupo->id_escuela ? 'selected' : '' }}>
                  {{ $escuela->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>
              <i class="bi bi-collection"></i>
              Nombre del Grupo
            </label>
            <input type="text" name="nombre_grupo" value="{{ $grupo->nombre_grupo }}" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i>
            Guardar cambios
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

<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modalEliminar{{ $grupo->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="bi bi-exclamation-triangle"></i>
            Eliminar Grupo
          </h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <i class="bi bi-trash text-danger" style="font-size: 3rem;"></i>
            <p class="mt-3">¿Estás seguro de eliminar el grupo <strong>{{ $grupo->nombre_grupo }}</strong>?</p>
            <small class="text-muted">Esta acción no se puede deshacer</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash"></i>
            Eliminar
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
@endforeach

<!-- MODAL CREAR GRUPO -->
<div class="modal fade" id="crearGrupoModal" tabindex="-1" aria-labelledby="crearGrupoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('grupos.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="crearGrupoLabel">
            <i class="bi bi-plus-circle"></i>
            Registrar Grupo de Práctica
          </h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <!-- Docente -->
          <div class="form-group">
            <label for="id_docente">
              <i class="bi bi-person-badge"></i>
              Docente
            </label>
            <select name="id_docente" class="form-control" required>
              <option value="">Seleccione un docente</option>
              @foreach($docentes as $docente)
                <option value="{{ $docente->id }}">{{ $docente->nombres }} {{ $docente->apellidos }}</option>
              @endforeach
            </select>
          </div>

          <!-- Semestre -->
          <div class="form-group">
            <label for="id_semestre">
              <i class="bi bi-calendar3"></i>
              Semestre
            </label>
            <select name="id_semestre" class="form-control" required>
              <option value="">Seleccione un semestre</option>
              @foreach($semestres as $semestre)
                <option value="{{ $semestre->id }}">{{ $semestre->codigo }}</option>
              @endforeach
            </select>
          </div>

          <!-- Facultad -->
          <div class="form-group">
              <label for="facultad_id">
                <i class="bi bi-bank"></i>
                Facultad
              </label>
              <select id="facultad_id" class="form-control" required>
                  <option value="">Seleccione una facultad</option>
                  @foreach($facultades as $facultad)
                      <option value="{{ $facultad->id }}">{{ $facultad->name }}</option>
                  @endforeach
              </select>
          </div>

          <!-- Escuela -->
          <div class="form-group">
              <label for="id_escuela">
                <i class="bi bi-building"></i>
                Escuela
              </label>
              <select name="id_escuela" id="id_escuela" class="form-control" required disabled>
                  <option value="">Seleccione una escuela</option>
                  @foreach($escuelas as $escuela)
                      <option value="{{ $escuela->id }}" data-facultad="{{ $escuela->facultad_id }}" hidden>
                          {{ $escuela->name }}
                      </option>
                  @endforeach
              </select>
          </div>

          <!-- Nombre del grupo -->
          <div class="form-group">
            <label for="nombre_grupo">
              <i class="bi bi-collection"></i>
              Nombre del Grupo
            </label>
            <input type="text" name="nombre_grupo" class="form-control" placeholder="Ej: Grupo A - Prácticas 2024" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i>
            Guardar
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

@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const facultadSelect = document.getElementById('facultad_id');
        const escuelaSelect = document.getElementById('id_escuela');

        // Función para manejar el cambio de facultad
        facultadSelect.addEventListener('change', function () {
            const selectedFacultad = this.value;

            if (!selectedFacultad) {
                escuelaSelect.disabled = true;
                escuelaSelect.value = "";
                escuelaSelect.classList.add('loading');
                Array.from(escuelaSelect.options).forEach(option => option.hidden = true);
                setTimeout(() => {
                    escuelaSelect.classList.remove('loading');
                }, 300);
                return;
            }

            escuelaSelect.classList.add('loading');
            
            setTimeout(() => {
                escuelaSelect.disabled = false;
                escuelaSelect.classList.remove('loading');

                Array.from(escuelaSelect.options).forEach(option => {
                    if (option.value === "") {
                        option.hidden = false;
                        return;
                    }

                    const facultadId = option.getAttribute('data-facultad');
                    option.hidden = facultadId !== selectedFacultad;
                });

                escuelaSelect.value = "";
                
                // Agregar clase de validación
                escuelaSelect.classList.add('is-valid');
            }, 300);
        });


            Array.from(escuelaSelect.options).forEach(option => {
                if (option.value === "") {
                    option.hidden = false; 
                    return;

        // Validación en tiempo real para selects
        const selects = document.querySelectorAll('select.form-control');
        selects.forEach(select => {
            select.addEventListener('change', function() {
                if (this.value && !this.disabled) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else if (!this.disabled) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');

                }
            });
        });

        // Validación para inputs de texto
        const textInputs = document.querySelectorAll('input[type="text"].form-control');
        textInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim().length >= 3) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                }
            });
        });

        // Animación para modales
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function() {
                this.querySelector('.modal-dialog').style.transform = 'translateY(-50px)';
                setTimeout(() => {
                    this.querySelector('.modal-dialog').style.transform = 'translateY(0)';
                }, 150);
            });
        });

        // Efecto hover para las filas de la tabla
        const tableRows = document.querySelectorAll('.table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Auto-dismiss para alertas después de 5 segundos
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(alert => {
            setTimeout(() => {
                const closeButton = alert.querySelector('.close');
                if (closeButton) {
                    closeButton.click();
                }
            }, 5000);
        });
    });
</script>
@endpush

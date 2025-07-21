@extends('template')
@section('title', 'Gestión de Preguntas')
@section('subtitle', 'Administrar preguntas para evaluaciones de prácticas')

{{-- CSS DataTables --}}
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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

    .pregunta-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    /* Card Principal */
    .pregunta-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .pregunta-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .pregunta-card-header {
        background: linear-gradient(135deg, var(--surface-color) 0%, #f8fafc 100%);
        border-bottom: 2px solid var(--border-color);
        padding: 1.5rem 2rem;
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pregunta-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .pregunta-card-title {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-transform: none;
    }

    .pregunta-card-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .pregunta-card-body {
        padding: 1.5rem;
    }

    /* Botón crear pregunta */
    .btn-crear-pregunta {
        background: var(--success-color);
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

    .btn-crear-pregunta:hover {
        background: #047857;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
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
        background: linear-gradient(135deg, #1e293b 0%, #374151 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 1rem 0.75rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: center;
    }

    .table tbody td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #f1f5f9;
        color: var(--text-primary);
        vertical-align: middle;
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

    /* Badges para ID */
    .id-badge {
        background: linear-gradient(135deg, var(--secondary-color), #475569);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .id-badge:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: var(--shadow-md);
    }

    /* Pregunta text */
    .pregunta-text {
        font-weight: 500;
        color: var(--text-primary);
        text-align: left;
        max-width: 300px;
        word-wrap: break-word;
        line-height: 1.4;
        padding: 0.5rem;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .pregunta-text:hover {
        background: rgba(30, 58, 138, 0.05);
        color: var(--primary-color);
        transform: translateX(4px);
    }

    /* Estados modernos */
    .estado-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all 0.3s ease;
    }

    .estado-habilitado {
        background: rgba(5, 150, 105, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(5, 150, 105, 0.2);
    }

    .estado-habilitado:hover {
        background: rgba(5, 150, 105, 0.2);
        transform: scale(1.05);
    }

    .estado-habilitado:hover i {
        transform: rotate(360deg);
    }

    .estado-deshabilitado {
        background: rgba(100, 116, 139, 0.1);
        color: var(--secondary-color);
        border: 1px solid rgba(100, 116, 139, 0.2);
    }

    .estado-deshabilitado:hover {
        background: rgba(100, 116, 139, 0.2);
        transform: scale(1.05);
    }

    .estado-deshabilitado:hover i {
        transform: scale(1.2);
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
        position: relative;
        overflow: hidden;
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

    .btn-warning::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-warning:hover::before {
        left: 100%;
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

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.8rem;
        min-width: auto;
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
        position: relative;
    }

    .modal-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .modal-header.header-crear {
        background: linear-gradient(135deg, var(--success-color), #047857);
    }

    .modal-header.header-eliminar {
        background: linear-gradient(135deg, var(--danger-color), #991b1b);
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-header .btn-close {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        opacity: 0.8;
        filter: invert(1);
    }

    .modal-header .btn-close:hover {
        opacity: 1;
        background: rgba(255, 255, 255, 0.3);
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
        resize: vertical;
        min-height: 100px;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        outline: none;
        transform: scale(1.01);
        min-height: 120px;
    }

    .form-text {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-top: 0.5rem;
        padding: 0.5rem;
        background: rgba(100, 116, 139, 0.05);
        border-radius: 0.25rem;
        border-left: 3px solid var(--info-color);
    }

    /* Alert personalizado */
    .alert {
        border: none;
        border-radius: 0.5rem;
        padding: 1rem;
        background: rgba(217, 119, 6, 0.1);
        border-left: 4px solid var(--warning-color);
        color: var(--text-primary);
    }

    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-secondary);
        background: rgba(100, 116, 139, 0.05);
        border: 2px dashed var(--border-color);
        border-radius: 0.75rem;
        margin: 1rem;
        transition: all 0.3s ease;
    }

    .empty-state:hover {
        border-color: var(--secondary-color);
        background: rgba(100, 116, 139, 0.1);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--border-color);
        margin-bottom: 1rem;
        display: block;
    }

    /* DataTables customizations */
    .dataTables_wrapper {
        font-family: 'Inter', sans-serif;
        padding: 0;
    }

    .dataTables_filter input {
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .dataTables_filter input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        outline: none;
    }

    .dataTables_length select {
        border: 2px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .dataTables_paginate .paginate_button {
        padding: 0.5rem 0.75rem;
        margin: 0 0.125rem;
        border-radius: 0.375rem;
        border: 1px solid var(--border-color);
        background: var(--surface-color);
        color: var(--text-primary);
        transition: all 0.2s ease;
    }

    .dataTables_paginate .paginate_button:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-1px);
    }

    .dataTables_paginate .paginate_button.current {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .pregunta-card-header {
            padding: 1.25rem 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .pregunta-card-body {
            padding: 1rem;
        }

        .btn-crear-pregunta {
            width: 100%;
            justify-content: center;
        }

        .pregunta-text {
            max-width: 200px;
        }

        .table {
            min-width: 600px;
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
</style>
@endpush

@section('content')
{{-- Alertas con SweetAlert2 --}}
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});
</script>
@endif
@endpush

<div class="pregunta-container">
    <div class="pregunta-card fade-in">
        <div class="pregunta-card-header">
            <h5 class="pregunta-card-title">
                <i class="bi bi-question-circle"></i>
                Gestión de Preguntas de Evaluación
            </h5>
            <button type="button" class="btn-crear-pregunta" data-bs-toggle="modal" data-bs-target="#modalNuevaPregunta">
                <i class="bi bi-plus-circle"></i> 
                Nueva Pregunta
            </button>
        </div>

        <div class="pregunta-card-body">
            <div class="table-container">
                <div class="table-responsive">
                    <table id="tablaPreguntas" class="table" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pregunta</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($preguntas as $pregunta)
                            <tr>
                                <td>
                                    <span class="pregunta-text">{{ $pregunta->id }}</span>
                                </td>
                                <td class="pregunta-text">{{ $pregunta->pregunta }}</td>
                                <td>
                                    @if($pregunta->estado)
                                        <span class="estado-badge estado-habilitado">
                                            <i class="bi bi-check-circle"></i>
                                            Habilitado
                                        </span>
                                    @else
                                        <span class="estado-badge estado-deshabilitado">
                                            <i class="bi bi-x-circle"></i>
                                            Deshabilitado
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Botón habilitar/deshabilitar --}}
                                    <form action="{{ route('pregunta.update', $pregunta->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="toggle_estado" value="1">
                                        <button type="submit" class="btn btn-sm {{ $pregunta->estado ? 'btn-warning' : 'btn-success' }}">
                                            <i class="bi bi-{{ $pregunta->estado ? 'toggle-off' : 'toggle-on' }}"></i>
                                            {{ $pregunta->estado ? 'Deshabilitar' : 'Habilitar' }}
                                        </button>
                                    </form>
                                    {{-- Botón editar --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalEditarPregunta-{{ $pregunta->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    {{-- Botón eliminar --}}
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar-{{ $pregunta->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    <i class="bi bi-question-circle-fill"></i>
                                    <p class="mb-0">No hay preguntas registradas.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Nueva Pregunta --}}
<div class="modal fade" id="modalNuevaPregunta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form action="{{ route('pregunta.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header header-crear">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle"></i>
                    Registrar Nueva Pregunta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        <i class="bi bi-question-circle"></i>
                        Pregunta de Evaluación
                    </label>
                    <textarea name="pregunta" class="form-control" rows="3" 
                              placeholder="Escriba la pregunta de evaluación..."
                              required></textarea>
                    <small class="form-text">
                        La pregunta será utilizada en las evaluaciones de prácticas profesionales.
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Guardar Pregunta
                </button>
            </div>
        </form>
    </div>
</div>
{{-- Modales Editar --}}
@foreach($preguntas as $pregunta)
<div class="modal fade" id="modalEditarPregunta-{{ $pregunta->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('pregunta.update', $pregunta->id) }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header header-editar">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square"></i>
                    Editar Pregunta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        <i class="bi bi-question-circle"></i>
                        Modificar Pregunta
                    </label>
                    <textarea name="pregunta" class="form-control" rows="3" required>{{ $pregunta->pregunta }}</textarea>
                    <small class="form-text">Puedes editar el texto de esta pregunta.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- Modales Eliminar --}}
@foreach($preguntas as $pregunta)
<div class="modal fade" id="modalEliminar-{{ $pregunta->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('pregunta.destroy', $pregunta->id) }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header header-eliminar">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle"></i>
                    Eliminar Pregunta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="bi bi-question-circle-fill text-danger" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
                    <p class="mb-3">¿Estás seguro de eliminar esta pregunta?</p>
                    <div class="alert alert-warning" role="alert">
                        <strong>Pregunta a eliminar:</strong><br>
                        "{{ $pregunta->pregunta }}"
                    </div>
                    <small class="text-muted">Esta acción no se puede deshacer</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i>
                    Cancelar
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                    Confirmar Eliminación
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection

{{-- JS DataTables --}}
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    console.log("JS de gestión de preguntas cargado");

    // Inicializar DataTable
    $('#tablaPreguntas').DataTable({
        language: {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    // Animación para estados de preguntas
    document.querySelectorAll('.estado-badge').forEach(function(badge) {
        badge.addEventListener('mouseenter', function() {
            let icon = this.querySelector('i');
            if (icon) {
                if (this.classList.contains('estado-habilitado')) {
                    icon.style.transform = 'rotate(360deg)';
                } else {
                    icon.style.transform = 'scale(1.2)';
                }
            }
        });
        
        badge.addEventListener('mouseleave', function() {
            let icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });

    // Animación suave para modales
    document.querySelectorAll('.modal').forEach(function(modal) {
        modal.addEventListener('show.bs.modal', function() {
            this.querySelector('.modal-dialog').style.transform = 'translateY(-50px) scale(0.95)';
            
            setTimeout(() => {
                this.querySelector('.modal-dialog').style.transform = 'translateY(0) scale(1)';
            }, 150);
        });
        
        modal.addEventListener('hidden.bs.modal', function() {
            this.querySelector('.modal-dialog').style.transform = 'translateY(-50px) scale(0.95)';
        });
    });

    // Efecto especial en botón crear pregunta
    document.querySelector('.btn-crear-pregunta').addEventListener('click', function() {
        this.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 150);
    });

    // Contador de caracteres para textarea
    const textarea = document.querySelector('textarea[name="pregunta"]');
    if (textarea) {
        textarea.addEventListener('input', function() {
            const charCount = this.value.length;
            const maxChars = 500; // Límite sugerido
            
            // Crear o actualizar contador
            let counter = this.parentNode.querySelector('.char-counter');
            if (!counter) {
                counter = document.createElement('div');
                counter.className = 'char-counter';
                counter.style.cssText = `
                    position: absolute;
                    bottom: 0.5rem;
                    right: 0.75rem;
                    font-size: 0.75rem;
                    color: var(--text-secondary);
                    background: var(--surface-color);
                    padding: 0.25rem 0.5rem;
                    border-radius: 0.25rem;
                    box-shadow: var(--shadow-sm);
                `;
                this.parentNode.style.position = 'relative';
                this.parentNode.appendChild(counter);
            }
            
            counter.textContent = `${charCount}/${maxChars}`;
            counter.style.color = charCount > maxChars ? 'var(--danger-color)' : 'var(--text-secondary)';
        });
    }

    // Efectos en botones de formulario
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const button = form.querySelector('button[type="submit"]');
            if (button) {
                button.classList.add('loading');
                button.disabled = true;
            }
        });
    });

    // Efecto ripple en botones
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(e) {
            let ripple = document.createElement('span');
            let rect = this.getBoundingClientRect();
            let size = Math.max(rect.width, rect.height);
            let x = e.clientX - rect.left - size / 2;
            let y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Efecto especial para texto de pregunta
    document.querySelectorAll('.pregunta-text').forEach(function(text) {
        text.addEventListener('click', function() {
            // Efecto de selección temporal
            this.style.backgroundColor = 'rgba(30, 58, 138, 0.1)';
            this.style.color = 'var(--primary-color)';
            
            setTimeout(() => {
                this.style.backgroundColor = '';
                this.style.color = 'var(--text-primary)';
            }, 1000);
        });
    });

    // CSS para efectos adicionales
    if (!document.querySelector('#pregunta-effects-styles')) {
        let effectsCSS = document.createElement('style');
        effectsCSS.id = 'pregunta-effects-styles';
        effectsCSS.innerHTML = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            .btn.loading {
                position: relative;
                pointer-events: none;
                opacity: 0.7;
            }
            .btn.loading::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 1rem;
                height: 1rem;
                border: 2px solid transparent;
                border-top: 2px solid currentColor;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                0% { transform: translate(-50%, -50%) rotate(0deg); }
                100% { transform: translate(-50%, -50%) rotate(360deg); }
            }
            .pregunta-text {
                cursor: pointer;
                user-select: none;
            }
            .id-badge {
                cursor: default;
            }
        `;
        document.head.appendChild(effectsCSS);
    }
});
</script>
@endpush

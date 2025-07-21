@extends('template')
@section('title', 'Gestión de Jefes Inmediatos')
@section('subtitle', 'Administrar información de jefes inmediatos de empresas')

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

    .jefe-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    /* Card Principal */
    .jefe-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .jefe-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .jefe-card-header {
        background: linear-gradient(135deg, var(--surface-color) 0%, #f8fafc 100%);
        border-bottom: 2px solid var(--border-color);
        padding: 1.5rem 2rem;
        position: relative;
    }

    .jefe-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .jefe-card-title {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-transform: none;
    }

    .jefe-card-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .jefe-card-body {
        padding: 1.5rem;
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

    /* Badges modernos */
    .numero-badge {
        background: linear-gradient(135deg, var(--secondary-color), #475569);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: var(--shadow-sm);
    }

    .dni-badge {
        background: linear-gradient(135deg, var(--warning-color), #b45309);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        font-family: 'Courier New', monospace;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .jefe-name {
        font-weight: 600;
        color: var(--text-primary);
        text-align: left;
        text-transform: uppercase;
    }

    .cargo-badge {
        background: linear-gradient(135deg, var(--success-color), #047857);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
        text-transform: uppercase;
    }

    .telefono-info {
        font-family: 'Courier New', monospace;
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Botón de acción */
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
        background: linear-gradient(135deg, var(--warning-color), #b45309);
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

    /* Información en modal */
    .info-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        margin-bottom: 0.75rem;
        background: var(--background-color);
        border-left: 4px solid var(--warning-color);
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(217, 119, 6, 0.02);
        transform: translateX(2px);
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-item i {
        color: var(--warning-color);
        font-size: 1.25rem;
        margin-right: 1rem;
        width: 1.5rem;
        text-align: center;
    }

    .info-content strong {
        color: var(--text-primary);
        font-weight: 600;
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-content span {
        color: var(--text-secondary);
        font-size: 1rem;
        font-weight: 500;
    }

    .info-content .dni-value {
        font-family: 'Courier New', monospace;
        color: var(--warning-color);
        font-weight: 600;
        letter-spacing: 1px;
    }

    .info-content .jefe-value {
        color: var(--primary-color);
        font-weight: 600;
        text-transform: uppercase;
    }

    .info-content .cargo-value {
        color: var(--success-color);
        font-weight: 600;
        text-transform: uppercase;
    }

    .info-content .telefono-value {
        font-family: 'Courier New', monospace;
        color: var(--info-color);
        font-weight: 600;
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

    /* Hover effects para badges */
    .numero-badge:hover,
    .dni-badge:hover,
    .cargo-badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
    }

    .jefe-name:hover {
        color: var(--primary-light);
        transform: translateX(2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .jefe-card-header {
            padding: 1.25rem 1.5rem;
        }

        .jefe-card-body {
            padding: 1rem;
        }

        .jefe-card-title {
            font-size: 1.25rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            min-width: 700px;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1.25rem 1.5rem;
        }

        .info-item {
            padding: 0.75rem;
            flex-direction: column;
            text-align: center;
        }

        .info-item i {
            margin-right: 0;
            margin-bottom: 0.5rem;
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

    /* Mejoras adicionales */
    /* DataTables customizations */
    .dataTables_wrapper {
        font-family: 'Inter', sans-serif;
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

    .dataTables_length select:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    .dataTables_info {
        color: var(--text-secondary);
        font-size: 0.875rem;
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

    /* Badges con efectos mejorados */
    .numero-badge,
    .dni-badge,
    .cargo-badge {
        transition: all 0.3s ease;
        cursor: default;
    }

    .numero-badge:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-md);
    }

    .dni-badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
        background: linear-gradient(135deg, #b45309, var(--warning-color));
    }

    .cargo-badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
        background: linear-gradient(135deg, #047857, var(--success-color));
    }

    /* Jefe name con mejor hover */
    .jefe-name {
        transition: all 0.3s ease;
        cursor: default;
    }

    .jefe-name:hover {
        color: var(--primary-color);
        transform: translateX(4px);
        font-weight: 700;
    }

    /* Teléfono info mejorado */
    .telefono-info {
        transition: all 0.3s ease;
        position: relative;
    }

    .telefono-info:hover {
        color: var(--info-color);
        transform: scale(1.05);
    }

    .telefono-info::before {
        content: '📞';
        margin-right: 0.5rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .telefono-info:hover::before {
        opacity: 1;
    }

    /* Modal animations */
    .modal.fade .modal-dialog {
        transform: translateY(-50px) scale(0.95);
        transition: all 0.3s ease;
    }

    .modal.show .modal-dialog {
        transform: translateY(0) scale(1);
    }

    /* Info items con mejor hover */
    .info-item {
        border: 1px solid transparent;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(217, 119, 6, 0.05);
        border-color: var(--warning-color);
        transform: translateX(4px);
        box-shadow: var(--shadow-sm);
    }

    /* Iconos en info items */
    .info-item i {
        transition: all 0.3s ease;
    }

    .info-item:hover i {
        transform: scale(1.2);
        color: #b45309;
    }

    /* Valores especiales con backgrounds */
    .dni-value {
        font-size: 1.1rem;
        background: rgba(217, 119, 6, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        display: inline-block;
        margin-top: 0.25rem;
    }

    .jefe-value {
        font-size: 1.1rem;
        background: rgba(30, 58, 138, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        display: inline-block;
        margin-top: 0.25rem;
    }

    .cargo-value {
        font-size: 1.1rem;
        background: rgba(5, 150, 105, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        display: inline-block;
        margin-top: 0.25rem;
    }

    .telefono-value {
        font-size: 1.1rem;
        background: rgba(8, 145, 178, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        display: inline-block;
        margin-top: 0.25rem;
    }

    /* Loading states */
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

    /* Rows con mejor hover effect */
    .table tbody tr {
        cursor: pointer;
    }

    .table tbody tr:hover .numero-badge {
        transform: scale(1.1);
    }

    .table tbody tr:hover .dni-badge {
        transform: scale(1.05);
        background: linear-gradient(135deg, #b45309, var(--warning-color));
    }

    .table tbody tr:hover .cargo-badge {
        transform: scale(1.05);
        background: linear-gradient(135deg, #047857, var(--success-color));
    }

    /* Empty state mejorado */
    .empty-state {
        background: rgba(100, 116, 139, 0.05);
        border: 2px dashed var(--border-color);
        border-radius: 0.75rem;
        margin: 1rem;
    }

    .empty-state:hover {
        border-color: var(--secondary-color);
        background: rgba(100, 116, 139, 0.1);
    }

    /* Scroll personalizado para modal */
    .modal-body::-webkit-scrollbar {
        width: 6px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: var(--background-color);
        border-radius: 3px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 3px;
        transition: background 0.3s ease;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-color);
    }

    /* Efectos para filas específicas */
    tr[data-jefe-id] {
        transition: all 0.3s ease;
    }

    tr[data-jefe-id]:hover {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.02), rgba(59, 130, 246, 0.02));
    }

    /* Focus states mejorados */
    .btn:focus,
    .close:focus {
        outline: 0;
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.25);
    }

    /* Responsive mejoras adicionales */
    @media (max-width: 576px) {
        .numero-badge,
        .dni-badge,
        .cargo-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }

        .jefe-name {
            font-size: 0.875rem;
        }

        .telefono-info {
            font-size: 0.8rem;
        }

        .btn {
            font-size: 0.75rem;
            padding: 0.375rem 0.5rem;
        }

        .info-item {
            padding: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .info-item i {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .modal-dialog {
            margin: 1rem;
        }
    }

    /* Efectos de entrada para elementos */
    .numero-badge,
    .dni-badge,
    .jefe-name,
    .cargo-badge,
    .telefono-info,
    .btn {
        animation: fadeIn 0.3s ease;
    }

    /* Delay en animaciones para crear efecto cascada */
    .numero-badge { animation-delay: 0.1s; }
    .dni-badge { animation-delay: 0.2s; }
    .jefe-name { animation-delay: 0.3s; }
    .cargo-badge { animation-delay: 0.4s; }
    .telefono-info { animation-delay: 0.5s; }
    .btn { animation-delay: 0.6s; }

    /* Mejoras en el modal específico */
    .modal-header {
        background: linear-gradient(135deg, var(--warning-color), #b45309);
    }

    .modal-title i {
        font-size: 1.125rem;
    }

    /* Tooltip mejorado */
    .btn[title]:hover::after {
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
        animation: fadeIn 0.2s ease;
        margin-bottom: 0.25rem;
    }
</style>
@endpush

@section('content')
<div class="jefe-container">
    <div class="jefe-card fade-in">
        <div class="jefe-card-header">
            <h5 class="jefe-card-title">
                <i class="bi bi-person-badge"></i>
                Lista de Jefes Inmediatos
            </h5>
        </div>
        <div class="jefe-card-body">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>Cargo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jefes as $index => $jefe)
                            <tr data-jefe-id="{{ $jefe->id }}">
                                <td>
                                    <span class="jefe-name">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <span class="jefe-name">{{ $jefe->dni }}</span>
                                </td>
                                <td class="jefe-name">{{ strtoupper($jefe->apellidos . ' ' . $jefe->nombres) }}</td>
                                <td>
                                    <span class="jefe-name">{{ $jefe->cargo }}</span>
                                </td>
                                <td class="telefono-info">{{ $jefe->telefono }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato{{ $jefe->id }}" title="Ver información detallada">
                                        <i class="bi bi-eye"></i>
                                        Ver
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @if($jefes->isEmpty())
                            <tr>
                                <td colspan="6" class="empty-state">
                                    <i class="bi bi-person-x"></i>
                                    <p class="mb-0">No se encontraron jefes inmediatos registrados.</p>
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

@foreach ($jefes as $jefe)
<div class="modal fade" id="modalJefeInmediato{{ $jefe->id }}" tabindex="-1" role="dialog" aria-labelledby="modalJefeInmediatoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJefeInmediatoLabel">
                    <i class="bi bi-person-circle"></i>
                    Información del Jefe Inmediato
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="info-item">
                    <i class="bi bi-card-text"></i>
                    <div class="info-content">
                        <strong>Documento de Identidad</strong>
                        <span class="dni-value">{{ $jefe->dni }}</span>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="bi bi-person"></i>
                    <div class="info-content">
                        <strong>Apellidos y Nombres</strong>
                        <span class="jefe-value">{{ $jefe->apellidos . ' ' . $jefe->nombres }}</span>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="bi bi-briefcase"></i>
                    <div class="info-content">
                        <strong>Cargo</strong>
                        <span class="cargo-value">{{ $jefe->cargo }}</span>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="bi bi-telephone"></i>
                    <div class="info-content">
                        <strong>Teléfono</strong>
                        <span class="telefono-value">{{ $jefe->telefono }}</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="bi bi-x-circle"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("JS de jefes inmediatos cargado");

    // Agregar efectos de loading a los botones
    document.querySelectorAll('.btn[data-bs-toggle="modal"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.classList.add('loading');
            
            setTimeout(() => {
                this.classList.remove('loading');
            }, 800);
        });
    });

    // Efecto hover mejorado para las filas
    document.querySelectorAll('.table tbody tr').forEach(function(row) {
        row.addEventListener('mouseenter', function() {
            // Animar badges
            let badges = this.querySelectorAll('.numero-badge, .dni-badge, .cargo-badge');
            badges.forEach(badge => {
                badge.style.transform = 'scale(1.05)';
            });
            
            // Animar nombre de jefe
            let jefeName = this.querySelector('.jefe-name');
            if (jefeName) {
                jefeName.style.transform = 'translateX(4px)';
            }

            // Animar información de teléfono
            let telefonoInfo = this.querySelector('.telefono-info');
            if (telefonoInfo) {
                telefonoInfo.style.color = 'var(--info-color)';
                telefonoInfo.style.transform = 'scale(1.05)';
            }
        });
        
        row.addEventListener('mouseleave', function() {
            // Resetear animaciones
            let badges = this.querySelectorAll('.numero-badge, .dni-badge, .cargo-badge');
            badges.forEach(badge => {
                badge.style.transform = 'scale(1)';
            });
            
            let jefeName = this.querySelector('.jefe-name');
            if (jefeName) {
                jefeName.style.transform = 'translateX(0)';
            }

            let telefonoInfo = this.querySelector('.telefono-info');
            if (telefonoInfo) {
                telefonoInfo.style.color = 'var(--text-secondary)';
                telefonoInfo.style.transform = 'scale(1)';
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

    // Efectos en info-items dentro del modal
    document.querySelectorAll('.info-item').forEach(function(item) {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
            this.style.backgroundColor = 'rgba(217, 119, 6, 0.05)';
            this.style.borderColor = 'var(--warning-color)';
            
            let icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'scale(1.2)';
                icon.style.color = '#b45309';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.backgroundColor = 'var(--background-color)';
            this.style.borderColor = 'transparent';
            
            let icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'scale(1)';
                icon.style.color = 'var(--warning-color)';
            }
        });
    });

    // Efecto de aparición progresiva para elementos de la tabla
    function animateTableElements() {
        const rows = document.querySelectorAll('.table tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Aplicar animación de entrada si hay elementos
    if (document.querySelectorAll('.table tbody tr').length > 0) {
        setTimeout(animateTableElements, 300);
    }

    // Efecto especial para DNI (validación visual)
    document.querySelectorAll('.dni-badge').forEach(function(badge) {
        badge.addEventListener('click', function() {
            const dniValue = this.textContent.trim();
            
            // Efecto de validación visual
            this.style.animation = 'pulse 0.5s ease';
            
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
        });
    });

    // Efecto especial para cargos (mostrar descripción)
    document.querySelectorAll('.cargo-badge').forEach(function(badge) {
        badge.addEventListener('mouseenter', function() {
            this.setAttribute('data-original-title', 'Cargo: ' + this.textContent);
        });
    });

    // Efecto ripple en botones (opcional)
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

    // Efecto especial para números de fila
    document.querySelectorAll('.numero-badge').forEach(function(badge, index) {
        badge.addEventListener('mouseenter', function() {
            this.style.background = `linear-gradient(135deg, #475569, var(--secondary-color))`;
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.background = `linear-gradient(135deg, var(--secondary-color), #475569)`;
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // CSS para efectos adicionales
    if (!document.querySelector('#jefe-effects-styles')) {
        let effectsCSS = document.createElement('style');
        effectsCSS.id = 'jefe-effects-styles';
        effectsCSS.innerHTML = `
            .btn {
                position: relative;
                overflow: hidden;
            }
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
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); box-shadow: 0 0 20px rgba(217, 119, 6, 0.5); }
                100% { transform: scale(1); }
            }
            .dni-badge:hover {
                cursor: pointer;
            }
            .cargo-badge:hover {
                cursor: help;
            }
        `;
        document.head.appendChild(effectsCSS);
    }

    // Funcionalidad de tooltip para información adicional
    document.querySelectorAll('[data-original-title]').forEach(function(element) {
        element.addEventListener('mouseenter', function() {
            const title = this.getAttribute('data-original-title');
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = title;
            tooltip.style.cssText = `
                position: absolute;
                background: var(--text-primary);
                color: white;
                padding: 0.5rem;
                border-radius: 0.25rem;
                font-size: 0.75rem;
                z-index: 1000;
                pointer-events: none;
                white-space: nowrap;
            `;
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
            tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
            
            this._tooltip = tooltip;
        });
        
        element.addEventListener('mouseleave', function() {
            if (this._tooltip) {
                this._tooltip.remove();
                this._tooltip = null;
            }
        });
    });
});
</script>
@endpush
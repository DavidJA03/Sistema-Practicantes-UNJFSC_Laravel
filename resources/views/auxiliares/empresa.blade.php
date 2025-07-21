@extends('template')
@section('title', 'Gestión de Empresas')
@section('subtitle', 'Administrar información de empresas colaboradoras')

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

    .empresa-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0;
    }

    /* Card Principal */
    .empresa-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .empresa-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .empresa-card-header {
        background: linear-gradient(135deg, var(--surface-color) 0%, #f8fafc 100%);
        border-bottom: 2px solid var(--border-color);
        padding: 1.5rem 2rem;
        position: relative;
    }

    .empresa-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .empresa-card-title {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-transform: none;
    }

    .empresa-card-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .empresa-card-body {
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

    .ruc-badge {
        background: linear-gradient(135deg, var(--info-color), #0e7490);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        font-family: 'Courier New', monospace;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .empresa-name {
        font-weight: 600;
        color: var(--text-primary);
        text-align: left;
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
        background: linear-gradient(135deg, var(--info-color), #0e7490);
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
        border-left: 4px solid var(--primary-color);
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: rgba(30, 58, 138, 0.02);
        transform: translateX(2px);
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-item i {
        color: var(--primary-color);
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

    .info-content .ruc-value {
        font-family: 'Courier New', monospace;
        color: var(--info-color);
        font-weight: 600;
        letter-spacing: 1px;
    }

    .info-content .empresa-value {
        color: var(--primary-color);
        font-weight: 600;
        text-transform: uppercase;
    }

    .info-content .telefono-value {
        font-family: 'Courier New', monospace;
        color: var(--success-color);
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
    .ruc-badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
    }

    .empresa-name:hover {
        color: var(--primary-light);
        transform: translateX(2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .empresa-card-header {
            padding: 1.25rem 1.5rem;
        }

        .empresa-card-body {
            padding: 1rem;
        }

        .empresa-card-title {
            font-size: 1.25rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            min-width: 600px;
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
    .ruc-badge {
        transition: all 0.3s ease;
        cursor: default;
    }

    .numero-badge:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-md);
    }

    .ruc-badge:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-md);
        background: linear-gradient(135deg, #0e7490, var(--info-color));
    }

    /* Empresa name con mejor hover */
    .empresa-name {
        transition: all 0.3s ease;
        cursor: default;
    }

    .empresa-name:hover {
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
        color: var(--success-color);
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
        background: rgba(30, 58, 138, 0.05);
        border-color: var(--primary-color);
        transform: translateX(4px);
        box-shadow: var(--shadow-sm);
    }

    /* Iconos en info items */
    .info-item i {
        transition: all 0.3s ease;
    }

    .info-item:hover i {
        transform: scale(1.2);
        color: var(--primary-light);
    }

    /* Valores especiales */
    .ruc-value {
        font-size: 1.1rem;
        background: rgba(8, 145, 178, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        display: inline-block;
        margin-top: 0.25rem;
    }

    .empresa-value {
        font-size: 1.1rem;
        background: rgba(30, 58, 138, 0.1);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        display: inline-block;
        margin-top: 0.25rem;
    }

    .telefono-value {
        font-size: 1.1rem;
        background: rgba(5, 150, 105, 0.1);
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

    .table tbody tr:hover .ruc-badge {
        transform: scale(1.05);
        background: linear-gradient(135deg, #0e7490, var(--info-color));
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
    tr[data-empresa-id] {
        transition: all 0.3s ease;
    }

    tr[data-empresa-id]:hover {
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
        .ruc-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }

        .empresa-name {
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
    .ruc-badge,
    .empresa-name,
    .telefono-info,
    .btn {
        animation: fadeIn 0.3s ease;
    }

    /* Delay en animaciones para crear efecto cascada */
    .numero-badge { animation-delay: 0.1s; }
    .ruc-badge { animation-delay: 0.2s; }
    .empresa-name { animation-delay: 0.3s; }
    .telefono-info { animation-delay: 0.4s; }
    .btn { animation-delay: 0.5s; }
</style>
@endpush

@section('content')
<div class="empresa-container">
    <div class="empresa-card fade-in">
        <div class="empresa-card-header">
            <h5 class="empresa-card-title">
                <i class="bi bi-building"></i>
                Lista de Empresas Colaboradoras
            </h5>
        </div>
        <div class="empresa-card-body">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>RUC</th>
                                <th>Nombre de la Empresa</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empresas as $index => $empresa)
                            <tr data-empresa-id="{{ $empresa->id }}">
                                <td>
                                    <span class="empresa-name">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <span class="empresa-name">{{ $empresa->ruc }}</span>
                                </td>
                                <td class="empresa-name">{{ strtoupper($empresa->nombre) }}</td>
                                <td class="telefono-info">{{ $empresa->telefono }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalVer{{ $empresa->id }}" title="Ver información detallada">
                                        <i class="bi bi-eye"></i>
                                        Ver
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @if($empresas->isEmpty())
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="bi bi-building-x"></i>
                                    <p class="mb-0">No se encontraron empresas registradas.</p>
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

<!-- Modal Ver -->
@foreach ($empresas as $empresa)
<div class="modal fade" id="modalVer{{ $empresa->id }}" tabindex="-1" role="dialog" aria-labelledby="modalVerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerLabel">
                    <i class="bi bi-info-circle"></i>
                    Información de la Empresa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="info-item">
                    <i class="bi bi-card-checklist"></i>
                    <div class="info-content">
                        <strong>RUC</strong>
                        <span class="ruc-value">{{ $empresa->ruc }}</span>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="bi bi-building"></i>
                    <div class="info-content">
                        <strong>Nombre de la Empresa</strong>
                        <span class="empresa-value">{{ $empresa->nombre }}</span>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="bi bi-telephone"></i>
                    <div class="info-content">
                        <strong>Teléfono</strong>
                        <span class="telefono-value">{{ $empresa->telefono }}</span>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="bi bi-geo-alt"></i>
                    <div class="info-content">
                        <strong>Dirección</strong>
                        <span>{{ $empresa->direccion }}</span>
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
    console.log("JS de empresas cargado");

    // Agregar efectos de loading a los botones
    document.querySelectorAll('.btn[data-toggle="modal"]').forEach(function(btn) {
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
            let badges = this.querySelectorAll('.numero-badge, .ruc-badge');
            badges.forEach(badge => {
                badge.style.transform = 'scale(1.05)';
            });
            
            // Animar nombre de empresa
            let empresaName = this.querySelector('.empresa-name');
            if (empresaName) {
                empresaName.style.transform = 'translateX(4px)';
            }
        });
        
        row.addEventListener('mouseleave', function() {
            // Resetear animaciones
            let badges = this.querySelectorAll('.numero-badge, .ruc-badge');
            badges.forEach(badge => {
                badge.style.transform = 'scale(1)';
            });
            
            let empresaName = this.querySelector('.empresa-name');
            if (empresaName) {
                empresaName.style.transform = 'translateX(0)';
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
            this.style.backgroundColor = 'rgba(30, 58, 138, 0.05)';
            this.style.borderColor = 'var(--primary-color)';
            
            let icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'scale(1.2)';
                icon.style.color = 'var(--primary-light)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.backgroundColor = 'var(--background-color)';
            this.style.borderColor = 'transparent';
            
            let icon = this.querySelector('i');
            if (icon) {
                icon.style.transform = 'scale(1)';
                icon.style.color = 'var(--primary-color)';
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

    // Tooltip mejorado para botones
    document.querySelectorAll('.btn[title]').forEach(function(btn) {
        btn.addEventListener('mouseenter', function() {
            this.style.position = 'relative';
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

    // CSS para el efecto ripple
    if (!document.querySelector('#ripple-styles')) {
        let rippleCSS = document.createElement('style');
        rippleCSS.id = 'ripple-styles';
        rippleCSS.innerHTML = `
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
        `;
        document.head.appendChild(rippleCSS);
    }
});
</script>
@endpush
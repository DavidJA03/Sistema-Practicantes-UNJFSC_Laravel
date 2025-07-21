@extends('template')
@section('title', 'Mi Perfil')
@section('subtitle', 'Gestionar información personal y configuración de cuenta')

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

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0;
    }

    /* Card Styles */
    .profile-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .profile-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .profile-card-header {
        background: linear-gradient(135deg, var(--surface-color) 0%, #f8fafc 100%);
        border-bottom: 2px solid var(--border-color);
        padding: 1.5rem 2rem;
        position: relative;
    }

    .profile-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    }

    .profile-card-title {
        font-size: 1.375rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .profile-card-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .profile-card-body {
        padding: 2rem;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 500;
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

    .form-control[readonly] {
        background-color: #f8fafc;
        border-color: #e2e8f0;
        color: var(--text-secondary);
        cursor: not-allowed;
    }

    .form-control[readonly]:focus {
        box-shadow: none;
        border-color: #e2e8f0;
    }

    /* Button Styles */
    .btn {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-light);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    .btn-success {
        background: var(--success-color);
        color: white;
    }

    .btn-success:hover {
        background: #047857;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    .btn-info {
        background: var(--info-color);
        color: white;
    }

    .btn-info:hover {
        background: #0e7490;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    /* Photo Section */
    .photo-container {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--border-color);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
    }

    .profile-photo:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-lg);
    }

    .default-avatar {
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 4rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
    }

    .default-avatar:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-lg);
    }

    .photo-divider {
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        margin: 1.5rem 0;
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
        font-size: 1.375rem;
        font-weight: 600;
        margin: 0;
    }

    .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .btn-close:hover {
        opacity: 1;
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

    /* File Input Styles */
    .file-input-container {
        position: relative;
        display: block;
        width: 100%;
    }

    .file-input-container input[type="file"] {
        width: 100%;
        padding: 1rem;
        border: 2px dashed var(--border-color);
        border-radius: 0.75rem;
        background: var(--background-color);
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .file-input-container input[type="file"]:hover {
        border-color: var(--primary-color);
        background: rgba(30, 58, 138, 0.02);
    }

    .file-input-container input[type="file"]:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    /* Alerts y notificaciones */
    .alert {
        border: none;
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        border-left: 4px solid;
    }

    .alert-info {
        background: rgba(8, 145, 178, 0.1);
        border-left-color: var(--info-color);
        color: #0e7490;
    }

    .alert-success {
        background: rgba(5, 150, 105, 0.1);
        border-left-color: var(--success-color);
        color: #047857;
    }

    .alert-warning {
        background: rgba(217, 119, 6, 0.1);
        border-left-color: var(--warning-color);
        color: #92400e;
    }

    .alert-danger {
        background: rgba(220, 38, 38, 0.1);
        border-left-color: var(--danger-color);
        color: #991b1b;
    }

    /* Texto secundario mejorado */
    .text-secondary {
        color: var(--text-secondary) !important;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    /* Estados de formulario editables */
    .form-control:not([readonly]):not([disabled]) {
        border-color: var(--primary-color);
        background: var(--surface-color);
    }

    .form-control:not([readonly]):not([disabled]):focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Mejoras para la transición de estados */
    .form-control {
        transition: all 0.3s ease;
    }

    /* Estilo para campos deshabilitados en modo edición */
    .form-control[disabled] {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: #64748b;
        opacity: 0.8;
    }

    /* Mejoras en el layout del header de las cards */
    .profile-card-header .d-flex {
        flex-wrap: wrap;
        gap: 1rem;
    }

    @media (max-width: 768px) {
        .profile-card-header .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .action-buttons {
            width: 100%;
            margin-top: 0.5rem;
        }
    }

    /* Estados de hover para botones */
    .btn:not(:disabled):not(.disabled):hover {
        text-decoration: none;
    }

    /* Mejoras en la tipografía */
    .profile-card-body p {
        margin-bottom: 0.75rem;
        line-height: 1.6;
    }

    /* Efectos de enfoque mejorados */
    .btn:focus,
    .btn.focus {
        outline: 0;
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.25);
    }

    /* Separadores mejorados */
    .photo-divider {
        position: relative;
    }

    .photo-divider::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        background: var(--primary-color);
        border-radius: 50%;
        box-shadow: var(--shadow-sm);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-card-header {
            padding: 1.25rem 1.5rem;
        }

        .profile-card-body {
            padding: 1.5rem;
        }

        .profile-card-title {
            font-size: 1.25rem;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }

        .profile-photo,
        .default-avatar {
            width: 150px;
            height: 150px;
        }

        .default-avatar {
            font-size: 3rem;
        }
    }

    /* Loading State */
    .btn.loading {
        position: relative;
        color: transparent;
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
        color: white;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="row">
        <!-- Datos Personales -->
        <div class="col-xl-8 col-lg-7">
            <div class="profile-card mb-4">
                <div class="profile-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="profile-card-title">
                            <i class="bi bi-person-lines-fill"></i>
                            Datos Personales
                        </h5>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-info" id="perfEdit">
                                <i class="bi bi-pencil-square"></i>    
                                Editar 
                            </button>
                            <button type="submit" form="formEditPerfil" class="btn btn-success d-none" id="perfUpdate">
                                <i class="bi bi-check-circle"></i>
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
                <div class="profile-card-body">
                    <form id="formEditPerfil" method="POST" action="{{ route('persona.editar') }}" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="persona_id" name="persona_id" value="{{ $persona->id }}">
                        
                        <!-- Fila 1: Código, DNI, Celular -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $persona->codigo ?? '' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" value="{{ $persona->dni ?? '' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular" value="{{ $persona->celular ?? '' }}" disabled>
                                </div>
                            </div>
                        </div>  
                        
                        <!-- Fila 2: Nombres y Apellidos -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $persona->nombres ?? '' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $persona->apellidos ?? '' }}" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fila 3: Correo y Departamento -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo_inst">Correo Institucional</label>
                                    <input type="email" class="form-control" id="correo_inst" name="correo_inst" value="{{ $persona->correo_inst ?? '' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input type="text" class="form-control" id="departamento" name="departamento" value="{{ $persona->departamento ?? '' }}" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fila 4: Provincia y Distrito -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provincia">Provincia</label>
                                    <select class="form-control" id="provincia" name="provincia" data-valor="{{ $persona->provincia ?? '' }}" disabled>
                                        <option value="">Seleccione una provincia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distrito">Distrito</label>
                                    <select class="form-control" id="distrito" name="distrito" data-valor="{{ $persona->distrito ?? '' }}" disabled>
                                        <option value="">Seleccione un distrito</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Fotografía -->
        <div class="col-xl-4 col-lg-5">
            <div class="profile-card mb-4">
                <div class="profile-card-header">
                    <h5 class="profile-card-title">
                        <i class="bi bi-camera"></i>
                        Fotografía de Perfil
                    </h5>
                </div>
                <div class="profile-card-body">
                    <div class="photo-container">
                        @if ($persona->ruta_foto)
                            <img src="{{ asset($persona->ruta_foto) }}" alt="Foto de perfil" class="profile-photo">
                        @else
                            <div class="default-avatar">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                        
                        <div class="photo-divider"></div>
                        
                        <p class="text-secondary mb-3">
                            Formatos permitidos: JPG, PNG, GIF<br>
                            Tamaño máximo: 2MB
                        </p>
                        
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFoto">
                            <i class="bi bi-cloud-upload"></i>
                            Cambiar Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Subir Foto -->
<div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFotoLabel">
                    <i class="bi bi-camera me-2"></i>
                    Editar Fotografía de Perfil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.foto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $persona->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Seleccionar Nueva Fotografía</label>
                        <div class="file-input-container">
                            <input type="file" name="foto" id="foto" accept="image/*" required class="form-control">
                        </div>
                    </div>
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Requisitos:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Formatos permitidos: JPG, PNG, GIF</li>
                            <li>Tamaño máximo: 2MB</li>
                            <li>Dimensiones recomendadas: 500x500 píxeles</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-cloud-upload me-2"></i>
                        Subir Fotografía
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/perfil_edit.js') }}"></script>
@endpush

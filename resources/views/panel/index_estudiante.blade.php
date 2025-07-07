@extends('estudiante')

@push('css')
    
@endpush

@section('content')
    <!-- Main Content -->
    <div class="container-fluid main-content">
        <div class="container">
            <!-- Welcome Header -->
            <div class="welcome-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="h3 mb-2">Bienvenida, María González</h1>
                        <p class="mb-0 opacity-90">Aquí encontrarás toda la información y herramientas para gestionar tus prácticas pre-profesionales</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <i class="bi bi-calendar-check" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Perfil del Estudiante -->
                <div class="col-lg-4 mb-4">
                    <div class="section-card h-100">
                        <h2 class="section-title">
                            <i class="bi bi-person-circle"></i>
                            PERFIL
                        </h2>
                        
                        <div class="text-center mb-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face" 
                                 alt="Foto de perfil" class="profile-avatar mb-3">
                            <h5 class="mb-1">María González Rodríguez</h5>
                            <p class="text-muted small">Estudiante de Ingeniería</p>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Correo Institucional</div>
                            <div class="info-value">maria.gonzalez@universidad.edu</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Carrera</div>
                            <div class="info-value">Ingeniería en Sistemas</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Semestre</div>
                            <div class="info-value">8vo Semestre</div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-outline-custom w-100">
                                <i class="bi bi-pencil me-2"></i>Editar Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Matrícula -->
                <div class="col-lg-4 mb-4">
                    <div class="section-card h-100 clickable-card" data-bs-toggle="modal" data-bs-target="#modalMatricula" style="cursor: pointer;">
                        <h2 class="section-title">
                            <i class="bi bi-journal-bookmark"></i>
                            Matrícula Académica
                        </h2>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Estado de Inscripción</span>
                                <span class="status-badge status-active">Activa</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Período Académico</div>
                            <div class="info-value">2024-1</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Materias Inscritas</div>
                            <div class="info-value">6 materias</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Créditos Totales</div>
                            <div class="info-value">18 créditos</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Fecha Límite Retiro</div>
                            <div class="info-value">15 de Marzo, 2024</div>
                        </div>
                    </div>
                </div>

                <!-- Prácticas -->
                <div class="col-lg-4 mb-4">
                    <div class="section-card h-100">
                        <h2 class="section-title">
                            <i class="bi bi-briefcase"></i>
                            Prácticas Pre-profesionales
                        </h2>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Estado Actual</span>
                                <span class="status-badge status-active">En Progreso</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Empresa</div>
                            <div class="info-value">TechSolutions S.A.</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Tutor Asignado</div>
                            <div class="info-value">Ing. Carlos Mendoza</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Período</div>
                            <div class="info-value">Enero - Abril 2024</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Horas Completadas</div>
                            <div class="info-value">120 / 240 horas</div>
                        </div>
                    </div>
                </div>
            </div>
            @include('matricula.view_estu')
        </div>
    </div>
@endsection

@push('js')
    
@endpush
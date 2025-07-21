@php
    $supervisor = $persona->gruposEstudiante->supervisor;
    $docente = $persona->gruposEstudiante->grupo->docente;
    $periodo = $persona->gruposEstudiante->grupo->semestre;
@endphp

<div class="container-fluid practice-development-view">
    <div class="container">
        <div class="section-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="section-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Detalles de la Práctica Desarrollo
                </h3>
                <button class="btn btn-outline-secondary btn-sm" onclick="goHome()">
                    <i class="bi bi-arrow-left me-1"></i>
                    Volver al Inicio
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Docente Titular</div>
                        <div class="info-value">{{ $docente->apellidos }} {{ $docente->nombres }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Supervisor Asignado</div>
                        <div class="info-value">{{ $supervisor->apellidos }} {{ $supervisor->nombres }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Estado</div>
                        <div class="info-value">
                            @if($practicas->estado == 5)
                            <span class="status-badge status-completed">Completo</span>
                            <span class="text-success">✓</span>
                            @else
                            <span class="status-badge status-active">Activo</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Período</div>
                        <div class="info-value">{{ $periodo->codigo }}</div>
                    </div>
                </div>
            </div>
        </div>
        @if($practicas->estado == 1)
            @include('practicas.estudiante.desarrollo.est_des_1')
        @elseif($practicas->estado == 2)
            @include('practicas.estudiante.desarrollo.est_des_2')
        @elseif($practicas->estado == 3)
            @include('practicas.estudiante.desarrollo.est_des_3')
        @elseif($practicas->estado == 4)
            @include('practicas.estudiante.desarrollo.est_des_4')
        @elseif($practicas->estado == 5)
            @if ($practicas->estado_proceso === 'completo')
                <div class="alert alert-success mt-4" id="completionAlert">
                    <div class="text-center">
                        <i class="bi bi-check-circle" style="font-size: 3rem; color: #16a34a;"></i>
                        <h4 class="mt-3 mb-3">¡Felicitaciones!</h4>
                        <p class="mb-0">
                            Has completado exitosamente todas las etapas de tus prácticas pre-profesionales. Tu proceso ha sido aprobado.
                        </p>
                    </div>
                </div>
            @endif
        @endif

    </div>
</div>

<style>
    
    .practice-development-view {
        background-color: #f8f9fa;
        min-height: 100vh;
        padding: 2rem 0;
        padding-top: 120px;
    }
    
    .info-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .info-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: #0d6efd;
    }
    
    .info-header i {
        font-size: 1.5rem;
        margin-right: 0.75rem;
    }
    
    .info-header h4 {
        margin: 0;
        font-weight: 600;
    }
    
    .info-content p {
        margin: 0;
        font-size: 1.1rem;
    }
    
    .section-title {
        color: var(--primary-blue);
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>
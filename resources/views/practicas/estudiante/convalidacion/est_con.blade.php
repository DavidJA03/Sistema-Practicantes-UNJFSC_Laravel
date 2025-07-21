<div class="container-fluid practice-development-view">
    <div class="container">
        <div class="section-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="section-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Detalles de la Práctica Convalidación
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
                        <div class="info-value">Dr. Carlos Mendoza Pérez</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Supervisor Asignado</div>
                        <div class="info-value">Ing. Ana García López</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Estado</div>
                        <div class="info-value">
                            <span class="status-badge status-active">Activo</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">Período</div>
                        <div class="info-value">2024-1</div>
                    </div>
                </div>
            </div>
        </div>
        @if($practicas->estado == 1)
            @include('practicas.estudiante.convalidacion.est_con_1')
        @elseif($practicas->estado == 2)
            @include('practicas.estudiante.convalidacion.est_con_2')
        @elseif($practicas->estado == 3)
            @include('practicas.estudiante.convalidacion.est_con_3')
        @elseif($practicas->estado == 4)
            @include('practicas.estudiante.convalidacion.est_con_4')
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
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
</style>
@php
    $practicaData = $practicas;
@endphp
<!-- Tercera Etapa - Convalidación -->
<div class="section-card">
    <h3 class="section-title text-center mb-4">
        <i class="bi bi-3-circle me-2"></i>
        Tercera Etapa - Documentación de Informes
    </h3>

    <div class="row">
        <!-- Registro de Actividades -->
        <div class="col-md-6 mb-4">
            <div class="practice-stage-card text-center h-100">
                <div class="stage-icon" style="background: linear-gradient(135deg, #06b6d4, #0891b2); color: white;">
                    <i class="bi bi-journal-text"></i>
                </div>
                <h5 class="text-primary font-weight-bold text-uppercase mb-3">Registro de Actividades</h5>
                <div id="registroActividadesStatus">
                    @if ($practicaData->ruta_registro_actividades != null)
                        @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                            <p class="text-muted mb-3">Visualiza o edita tu registro de actividades</p>
                            <div class="d-flex flex-column gap-2 align-items-center">
                                <a href="{{ asset($practicaData->ruta_registro_actividades) }}" target="_blank" class="btn btn-warning btn-sm">
                                    <i class="bi bi-file-pdf me-1"></i> Ver PDF
                                </a>
                                <button class="btn btn-primary-custom btn-sm" data-bs-toggle="modal" data-bs-target="#modalRegistroActividades">
                                    <i class="bi bi-pencil-square me-1"></i> Editar Documento
                                </button>
                            </div>
                        @elseif ($practicaData->estado_proceso === 'completo')
                            <p class="text-muted mb-3">Visualiza tu registro de actividades aprobado</p>
                            <a href="{{ asset($practicaData->ruta_registro_actividades) }}" target="_blank" class="btn btn-warning btn-sm">
                                <i class="bi bi-file-pdf me-1"></i> Ver PDF
                            </a>
                        @endif
                    @else
                        <p class="text-muted mb-3">Sube el registro detallado de tus actividades laborales</p>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalRegistroActividades">
                            <i class="bi bi-cloud-upload me-1"></i> Subir Documento
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Control Mensual de Actividades -->
        <div class="col-md-6 mb-4">
            <div class="practice-stage-card text-center h-100">
                <div class="stage-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h5 class="text-primary font-weight-bold text-uppercase mb-3">Control Mensual de Actividades</h5>
                <div id="controlMensualStatus">
                    @if ($practicaData->ruta_control_actividades != null)
                        @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                            <p class="text-muted mb-3">Visualiza o edita tu control mensual</p>
                            <div class="d-flex flex-column gap-2 align-items-center">
                                <a href="{{ asset($practicaData->ruta_control_actividades) }}" target="_blank" class="btn btn-warning btn-sm">
                                    <i class="bi bi-file-pdf me-1"></i> Ver PDF
                                </a>
                                <button class="btn btn-primary-custom btn-sm" data-bs-toggle="modal" data-bs-target="#modalControlMensual">
                                    <i class="bi bi-pencil-square me-1"></i> Editar Documento
                                </button>
                            </div>
                        @elseif ($practicaData->estado_proceso === 'completo')
                            <p class="text-muted mb-3">Visualiza tu control mensual aprobado</p>
                            <a href="{{ asset($practicaData->ruta_control_actividades) }}" target="_blank" class="btn btn-warning btn-sm">
                                <i class="bi bi-file-pdf me-1"></i> Ver PDF
                            </a>
                        @endif
                    @else
                        <p class="text-muted mb-3">Sube el control mensual de tus actividades</p>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalControlMensual">
                            <i class="bi bi-cloud-upload me-1"></i> Subir Documento
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Estado de Rechazo -->
    @if ($practicaData->estado_proceso === 'rechazado')
        <div class="alert alert-danger mt-4" id="rejectionAlert">
            <div class="text-center">
                <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: #dc2626;"></i>
                <h4 class="mt-3 mb-3">¡Atención!</h4>
                <p class="mb-0">
                    Debes corregir los archivos ingresados en la sección de Registro de Actividades y/o Control Mensual de Actividades antes de continuar con el proceso de convalidación.
                </p>
            </div>
        </div>
    @endif
</div>

<!-- Modal Registro de Actividades -->
<div class="modal fade" id="modalRegistroActividades" tabindex="-1" aria-labelledby="modalRegistroActividadesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), #1d4ed8); color: white;">
                <h5 class="modal-title" id="modalRegistroActividadesLabel">
                    <i class="bi bi-journal-text me-2"></i>
                    Registro de Actividades
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.registroactividades') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <div class="upload-area-modal border-2 border-dashed p-4 text-center" style="border-color: var(--border-gray); border-radius: 12px;">
                        <i class="bi bi-cloud-upload" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h6 class="mb-3">Selecciona tu registro de actividades</h6>
                        <p class="text-muted mb-3">Solo se permiten archivos PDF (máximo 10MB)</p>
                        <input type="file" name="registro_actividades" accept="application/pdf" required class="form-control" style="border-radius: 8px;">
                    </div>
                    <div class="mt-3">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Importante:</strong> El registro debe incluir un detalle completo de todas las actividades, tareas y responsabilidades que desempeñaste durante tu experiencia laboral.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-cloud-upload me-1"></i> Subir Documento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Control Mensual de Actividades -->
<div class="modal fade" id="modalControlMensual" tabindex="-1" aria-labelledby="modalControlMensualLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), #1d4ed8); color: white;">
                <h5 class="modal-title" id="modalControlMensualLabel">
                    <i class="bi bi-calendar-check me-2"></i>
                    Control Mensual de Actividades
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.controlmensualactividades') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <div class="upload-area-modal border-2 border-dashed p-4 text-center" style="border-color: var(--border-gray); border-radius: 12px;">
                        <i class="bi bi-cloud-upload" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h6 class="mb-3">Selecciona tu control mensual</h6>
                        <p class="text-muted mb-3">Solo se permiten archivos PDF (máximo 10MB)</p>
                        <input type="file" name="control_mensual_actividades" accept="application/pdf" required class="form-control" style="border-radius: 8px;">
                    </div>
                    <div class="mt-3">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Importante:</strong> El control debe mostrar la distribución mensual de tus actividades laborales, firmado y validado por tu jefe inmediato.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-cloud-upload me-1"></i> Subir Documento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

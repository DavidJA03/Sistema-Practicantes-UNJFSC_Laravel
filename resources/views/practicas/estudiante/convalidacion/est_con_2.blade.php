@php
    $practicaData = $practicas;
@endphp
<!-- Segunda Etapa - Convalidación -->
<div class="section-card">
    <h3 class="section-title text-center mb-4">
        <i class="bi bi-2-circle me-2"></i>
        Segunda Etapa - Documentación
    </h3>

    <div class="row">
        <!-- Formulario de Trámite (FUT) -->
        <div class="col-md-6 mb-4">
            <div class="practice-stage-card text-center h-100">
                <div class="stage-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white;">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h5 class="text-primary font-weight-bold text-uppercase mb-3">Formulario de Trámite (FUT)</h5>
                <div id="futStatus">
                    @if ($practicaData->ruta_fut != null)
                        @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                            <p class="text-muted mb-3">Visualiza o edita tu formulario de trámite</p>
                            <div class="d-flex flex-column gap-2 align-items-center">
                                <a href="{{ asset($practicaData->ruta_fut) }}" target="_blank" class="btn btn-warning btn-sm">
                                    <i class="bi bi-file-pdf me-1"></i> Ver PDF
                                </a>
                                <button class="btn btn-primary-custom btn-sm" data-bs-toggle="modal" data-bs-target="#modalFUT">
                                    <i class="bi bi-pencil-square me-1"></i> Editar Documento
                                </button>
                            </div>
                        @elseif ($practicaData->estado_proceso === 'completo')
                            <p class="text-muted mb-3">Visualiza tu formulario de trámite aprobado</p>
                            <a href="{{ asset($practicaData->ruta_fut) }}" target="_blank" class="btn btn-warning btn-sm">
                                <i class="bi bi-file-pdf me-1"></i> Ver PDF
                            </a>
                        @endif
                    @else
                        <p class="text-muted mb-3">Sube tu formulario de trámite para convalidación</p>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalFUT">
                            <i class="bi bi-cloud-upload me-1"></i> Subir Documento
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Carta de Aceptación -->
        <div class="col-md-6 mb-4">
            <div class="practice-stage-card text-center h-100">
                <div class="stage-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white;">
                    <i class="bi bi-envelope-check"></i>
                </div>
                <h5 class="text-primary font-weight-bold text-uppercase mb-3">Carta de Aceptación</h5>
                <div id="cartaAceptacionStatus">
                    @if ($practicaData->ruta_carta_aceptacion != null)
                        @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                            <p class="text-muted mb-3">Visualiza o edita tu carta de aceptación</p>
                            <div class="d-flex flex-column gap-2 align-items-center">
                                <a href="{{ asset($practicaData->ruta_carta_aceptacion) }}" target="_blank" class="btn btn-warning btn-sm">
                                    <i class="bi bi-file-pdf me-1"></i> Ver PDF
                                </a>
                                <button class="btn btn-primary-custom btn-sm" data-bs-toggle="modal" data-bs-target="#modalCartaAceptacion">
                                    <i class="bi bi-pencil-square me-1"></i> Editar Documento
                                </button>
                            </div>
                        @elseif ($practicaData->estado_proceso === 'completo')
                            <p class="text-muted mb-3">Visualiza tu carta de aceptación aprobada</p>
                            <a href="{{ asset($practicaData->ruta_carta_aceptacion) }}" target="_blank" class="btn btn-warning btn-sm">
                                <i class="bi bi-file-pdf me-1"></i> Ver PDF
                            </a>
                        @endif
                    @else
                        <p class="text-muted mb-3">Sube la carta de aceptación de la empresa</p>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalCartaAceptacion">
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
                    Debes corregir los archivos ingresados en la sección de Formulario de Trámite (FUT) y/o Carta de Aceptación antes de continuar con el proceso de convalidación.
                </p>
            </div>
        </div>
    @endif
</div>

<!-- Modal Formulario de Trámite (FUT) -->
<div class="modal fade" id="modalFUT" tabindex="-1" aria-labelledby="modalFUTLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), #1d4ed8); color: white;">
                <h5 class="modal-title" id="modalFUTLabel">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Formulario de Trámite (FUT)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.fut') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <div class="upload-area-modal border-2 border-dashed p-4 text-center" style="border-color: var(--border-gray); border-radius: 12px;">
                        <i class="bi bi-cloud-upload" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h6 class="mb-3">Selecciona tu archivo FUT</h6>
                        <p class="text-muted mb-3">Solo se permiten archivos PDF (máximo 10MB)</p>
                        <input type="file" name="fut" accept="application/pdf" required class="form-control" style="border-radius: 8px;">
                    </div>
                    <div class="mt-3">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Importante:</strong> El formulario debe estar completamente lleno y firmado, específicamente solicitando la convalidación de tu experiencia laboral.
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

<!-- Modal Carta de Aceptación -->
<div class="modal fade" id="modalCartaAceptacion" tabindex="-1" aria-labelledby="modalCartaAceptacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), #1d4ed8); color: white;">
                <h5 class="modal-title" id="modalCartaAceptacionLabel">
                    <i class="bi bi-envelope-check me-2"></i>
                    Carta de Aceptación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.cartaaceptacion') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <div class="upload-area-modal border-2 border-dashed p-4 text-center" style="border-color: var(--border-gray); border-radius: 12px;">
                        <i class="bi bi-cloud-upload" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h6 class="mb-3">Selecciona tu carta de aceptación</h6>
                        <p class="text-muted mb-3">Solo se permiten archivos PDF (máximo 10MB)</p>
                        <input type="file" name="carta_aceptacion" accept="application/pdf" required class="form-control" style="border-radius: 8px;">
                    </div>
                    <div class="mt-3">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Importante:</strong> La carta debe estar firmada por la empresa confirmando que trabajaste allí y detallando las funciones que desempeñaste.
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

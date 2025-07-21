@php
    $practicaData = $practicas;
    $empresaExiste = isset($practicaData->empresa);
    $jefeExiste = isset($practicaData->jefeInmediato);
@endphp

<!-- Primera Etapa - Convalidación -->
<div class="section-card">
    <h3 class="section-title text-center mb-4">
        <i class="bi bi-1-circle me-2"></i>
        Primera Etapa - Información General
    </h3>

    <div class="row">
        <!-- Datos de la Empresa -->
        <div class="col-md-6 mb-4">
            <div class="practice-stage-card text-center h-100">
                <div class="stage-icon company">
                    <i class="bi bi-building"></i>
                </div>
                <h5 class="text-primary font-weight-bold text-uppercase mb-3">Datos de la Empresa</h5>
                <div id="companyStatus">
                    @if ($empresaExiste)
                        @php $empresa = $practicaData->empresa; @endphp
                        @if (($empresa->estado == 1 && $practicaData->estado_proceso == 'en proceso') || $practicaData->estado_proceso == 'completo')
                            <p class="text-muted mb-3">Visualiza los datos de la empresa registrada</p>
                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                                <i class="bi bi-eye-fill me-1"></i> Visualizar
                            </a>
                        @elseif ($empresa->estado == 2)
                            <p class="text-muted mb-3">Corrige los datos observados de la empresa</p>
                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                                <i class="bi bi-pencil-square me-1"></i> Editar
                            </a>
                        @endif
                    @else
                        <p class="text-muted mb-3">Registra la información de la empresa donde trabajaste</p>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                            <i class="bi bi-plus-circle me-1"></i> Registrar Datos
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Datos del Jefe Inmediato -->
        <div class="col-md-6 mb-4">
            <div class="practice-stage-card text-center h-100">
                <div class="stage-icon supervisor">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h5 class="text-primary font-weight-bold text-uppercase mb-3">Datos del Jefe Inmediato</h5>
                <div id="supervisorStatus">
                    @if ($jefeExiste)
                        @php $jefeInmediato = $practicaData->jefeInmediato; @endphp
                        @if (($jefeInmediato->estado == 1 && $practicaData->estado_proceso === 'en proceso') || $practicaData->estado_proceso === 'completo')
                            <p class="text-muted mb-3">Visualiza los datos de tu jefe inmediato</p>
                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato">
                                <i class="bi bi-eye-fill me-1"></i> Visualizar
                            </a>
                        @elseif ($jefeInmediato->estado == 2)
                            <p class="text-muted mb-3">Corrige los datos observados del jefe inmediato</p>
                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato">
                                <i class="bi bi-pencil-square me-1"></i> Editar
                            </a>
                        @endif
                    @else
                        <p class="text-muted mb-3">Registra la información de tu jefe inmediato laboral</p>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato">
                            <i class="bi bi-plus-circle me-1"></i> Registrar Datos
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
                    Debes corregir los datos ingresados en la sección de Empresa y Jefe Inmediato antes de continuar con el proceso de convalidación.
                </p>
            </div>
        </div>
    @endif
</div>

<!-- Modal Empresa -->
<div class="modal fade" id="modalEmpresa" tabindex="-1" aria-labelledby="modalEmpresaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), #1d4ed8); color: white;">
                <h5 class="modal-title" id="modalEmpresaLabel">
                    <i class="bi bi-building me-2"></i>
                    Datos de la Empresa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($empresaExiste)
                    @if ($practicaData->empresa->estado == 2)
                        <form id="formEmpresa" action="{{ route('empresa.edit', $practicaData->id) }}" method="POST">
                    @else
                        <form id="formEmpresa" action="{{ route('empresas.store', $practicaData->id) }}" method="POST">
                    @endif
                @else
                    <form id="formEmpresa" action="{{ route('empresas.store', $practicaData->id) }}" method="POST">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="empresa" class="form-label">Nombre de la Empresa</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" value="{{ $practicaData->empresa->nombre  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ruc" class="form-label">RUC</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" maxlength="11" placeholder="Ej: 20123456789" value="{{ $practicaData->empresa->ruc  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="razon_social" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $practicaData->empresa->razon_social  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Av. Siempre Viva #123" value="{{ $practicaData->empresa->direccion  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono_empresa" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono_empresa" name="telefono" placeholder="Ej: 987654321" value="{{ $practicaData->empresa->telefono  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email_empresa" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email_empresa" name="email" placeholder="empresa@dominio.com" value="{{ $practicaData->empresa->correo  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sitio_web_empresa" class="form-label">Sitio web (opcional)</label>
                        <input type="url" class="form-control" id="sitio_web_empresa" name="sitio_web" placeholder="https://www.empresa.com" value="{{ $practicaData->empresa->web  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if($empresaExiste)
                    @if ($practicaData->empresa->estado == 2)
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formEmpresa" class="btn btn-primary-custom">
                            <i class="bi bi-check-circle me-1"></i> Actualizar
                        </button>
                    @else
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @endif
                @else
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="formEmpresa" class="btn btn-primary-custom">
                        <i class="bi bi-save me-1"></i> Guardar
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Jefe Inmediato -->
<div class="modal fade" id="modalJefeInmediato" tabindex="-1" aria-labelledby="modalJefeInmediatoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), #1d4ed8); color: white;">
                <h5 class="modal-title" id="modalJefeInmediatoLabel">
                    <i class="bi bi-person-badge me-2"></i>
                    Datos del Jefe Inmediato
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($jefeExiste)
                    @if ($practicaData->jefeInmediato->estado == 2)
                        <form id="formJefeInmediato" action="{{ route('jefe_inmediato.edit', $practicaData->id) }}" method="POST">
                    @else
                        <form id="formJefeInmediato" action="{{ route('jefe_inmediato.store', $practicaData->id) }}" method="POST">
                    @endif
                @else
                    <form id="formJefeInmediato" action="{{ route('jefe_inmediato.store', $practicaData->id) }}" method="POST">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Apellidos y Nombres</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $practicaData->jefeInmediato->nombres  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" maxlength="8" value="{{ $practicaData->jefeInmediato->dni  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sitio_web_jefe" class="form-label">Sitio web (opcional)</label>
                                <input type="url" class="form-control" id="sitio_web_jefe" name="sitio_web" placeholder="https://www.linkedin.com" value="{{ $practicaData->jefeInmediato->web  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area" class="form-label">Área o Departamento</label>
                                <input type="text" class="form-control" id="area" name="area" value="{{ $practicaData->jefeInmediato->area  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo o Puesto</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $practicaData->jefeInmediato->cargo  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono_jefe" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono_jefe" name="telefono" maxlength="9" placeholder="Ej: 987654321" value="{{ $practicaData->jefeInmediato->telefono  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email_jefe" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email_jefe" name="email" placeholder="jefe@empresa.com" value="{{ $practicaData->jefeInmediato->correo  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if($jefeExiste)
                    @if ($practicaData->jefeInmediato->estado == 2)
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formJefeInmediato" class="btn btn-primary-custom">
                            <i class="bi bi-check-circle me-1"></i> Actualizar
                        </button>
                    @else
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @endif
                @else
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="formJefeInmediato" class="btn btn-primary-custom">
                        <i class="bi bi-save me-1"></i> Guardar
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

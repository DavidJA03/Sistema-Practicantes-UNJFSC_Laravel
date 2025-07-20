<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase text-center">Primera Etapa - Información General</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row w-100">
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-building mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                @if ($empresaExiste)
                                    @if (($practicaData->empresa->estado == 1) && $practicaData->estado_proceso == 'en proceso' || $practicaData->estado_proceso == 'completo')
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Datos de la Empresa</h5>
                                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                                                Visualizar
                                            </a>
                                        </div>
                                    @elseif ($practicaData->empresa->estado == 2)
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Datos de la Empresa</h5>
                                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                                                Editar
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Datos de la Empresa</h5>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                                            Registrar Datos
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-user-tie mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                @if ($jefeExiste)
                                    @if (($practicaData->jefeInmediato->estado == 1) && $practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'completo' )
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Datos del Jefe Inmediato</h4>
                                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato">
                                                Visualizar
                                            </a>
                                        </div>
                                    @elseif ($practicaData->jefeInmediato->estado == 2)
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Datos del Jefe Inmediato</h4>
                                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato">
                                                Editar
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Datos del Jefe Inmediato</h4>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato">
                                        Registrar Datos
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($practicaData->estado_proceso === 'rechazado')
    <div class="d-flex justify-content-center align-items-center my-5">
        <div class="alert alert-danger shadow-lg p-5 rounded-lg text-center" style="max-width: 400px; width: 100%;">
            <div class="mb-4">
                <i class="fas fa-exclamation-triangle fa-4x text-warning"></i>
            </div>
            <h2 class="font-weight-bold mb-3">¡Atención!</h2>
            <p class="mb-0" style="font-size: 20px;">
                Debes corregir los datos ingresados en la sección de Empresa y Jefe Inmediato antes de continuar con el proceso.
            </p>
        </div>
    </div>
@endif


<!-- Modal Empresa -->
<div class="modal fade" id="modalEmpresa" tabindex="-1" aria-labelledby="modalEmpresaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEmpresaLabel">Datos de la Empresa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($practicaData->empresa->estado == 2)
                    <form id="formEmpresa" action="{{ route('empresa.edit', $practicaData->id) }}" method="POST">
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
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej: 987654321" value="{{ $practicaData->empresa->telefono  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="empresa@dominio.com" value="{{ $practicaData->empresa->correo  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sitio_web" class="form-label">Sitio web (opcional)</label>
                        <input type="url" class="form-control" id="sitio_web" name="sitio_web" placeholder="https://www.linkedin.com" value="{{ $practicaData->empresa->web  ?? '' }}" @if(($empresaExiste ) && $practicaData->empresa->estado == 1) readonly @endif>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if($empresaExiste)
                    @if ($practicaData->empresa->estado == 2)
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formEmpresa" class="btn btn-primary">Actualizar</button>
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @endif
                @else
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="formEmpresa" class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Jefe Inmediato -->
<div class="modal fade" id="modalJefeInmediato" tabindex="-1" aria-labelledby="modalJefeInmediatoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalJefeInmediatoLabel">Datos del Jefe Inmediato</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($practicaData->jefeInmediato->estado == 2)
                    <form id="formJefeInmediato" action="{{ route('jefe_inmediato.edit', $practicaData->id) }}" method="POST">
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
                                <label for="sitio_web" class="form-label">Sitio web (opcional)</label>
                                <input type="url" class="form-control" id="sitio_web" name="sitio_web" placeholder="https://www.linkedin.com" value="{{ $practicaData->jefeInmediato->web  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area" class="form-label">Area o Departamento</label>
                                <input type="text" class="form-control" id="area" name="area" maxlength="11" value="{{ $practicaData->jefeInmediato->area  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
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
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" placeholder="Ej: 987654321" value="{{ $practicaData->jefeInmediato->telefono  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="empresa@dominio.com" value="{{ $practicaData->jefeInmediato->correo  ?? '' }}" @if($jefeExiste && $practicaData->jefeInmediato->estado == 1) readonly @endif required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if($jefeExiste)
                    @if ($practicaData->jefeInmediato->estado == 2)
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formJefeInmediato" class="btn btn-primary">Actualizar</button>
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @endif
                @else
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formJefeInmediato" class="btn btn-primary">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
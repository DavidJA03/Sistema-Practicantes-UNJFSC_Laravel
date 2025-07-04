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
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Datos de la Empresa</h4>
                                    <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                                        Visualizar
                                    </a>
                                </div>
                                @else
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Datos de la Empresa</h4>
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
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Datos del Jefe Inmediato</h4>
                                    <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato">
                                        Visualizar
                                    </a>
                                </div>
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


<!-- Modal Empresa -->
<div class="modal fade" id="modalEmpresa" tabindex="-1" aria-labelledby="modalEmpresaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEmpresaLabel">Datos de la Empresa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEmpresa" action="{{ route('empresas.store', $practicaData->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="empresa" class="form-label">Nombre de la Empresa</label>
                        <input type="text" class="form-control" id="empresa" name="empresa" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ruc" class="form-label">RUC</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" maxlength="11" placeholder="Ej: 20123456789" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="razon_social" class="form-label">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" maxlength="11" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Av. Siempre Viva #123" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej: 987654321" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="empresa@dominio.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sitio_web" class="form-label">Sitio web (opcional)</label>
                        <input type="url" class="form-control" id="sitio_web" name="sitio_web" placeholder="https://www.miempresa.com">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formEmpresa" class="btn btn-primary">Guardar</button>
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
                <form id="formJefeInmediato" action="{{ route('jefe_inmediato.store', $practicaData->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Apellidos y Nombres</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" maxlength="8" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección (opcional)</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area" class="form-label">Area o Departamento</label>
                                <input type="text" class="form-control" id="area" name="area" maxlength="11" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo o Puesto</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" placeholder="Ej: 987654321" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="empresa@dominio.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sitio_web" class="form-label">Sitio web (opcional)</label>
                        <input type="url" class="form-control" id="sitio_web" name="sitio_web" placeholder="https://www.miempresa.com">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formJefeInmediato" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
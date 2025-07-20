@if($etapa == 1)
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
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Datos de la Empresa</h4>
                                    <a class="btn btn-dark btn-sm text-white" id="btnEtapa2">
                                        Visualizar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-user-tie mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Datos del Jefe</h4>
                                    <a class="btn btn-warning btn-sm" id="btnEtapa3">
                                        Visualizar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form id="formProcesoE1" class="form-etapa" action="{{ route('proceso') }}" method="POST" data-estado="1">
                @csrf
                <input type="hidden" name="id" id="idE1">
                <input type="hidden" name="test" id="test"  value="1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estadoE1" name="estado" required>
                                <option value="" selected disabled>Seleccione un estado</option>
                                <option value="rechazado">Rechazado</option>
                                <option value="aprobado">Aprobado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 d-flex align-items-center h-100" style="height: 100%;">
                            <button type="submit" form="formProcesoE1" class="btn btn-primary btn-sm">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@elseif($etapa == 2)
<div class="etapa-content">
    <h5 class="text-primary mb-3">Datos de la Empresa</h5>
    <div class="mb-3">
        <label class="form-label">Nombre de la Empresa</label>
        <div class="form-control bg-light"><span id="modal-nombre-empresa"></span></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="ruc" class="form-label">RUC</label>
                <div class="form-control bg-light"><span id="modal-ruc-empresa"></span></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="razon_social" class="form-label">Razón Social</label>
                <div class="form-control bg-light"><span id="modal-razon_social-empresa"></span></div>
            </div>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <div class="form-control bg-light"><span id="modal-direccion-empresa"></span></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <div class="form-control bg-light"><span id="modal-telefono-empresa"></span></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <div class="form-control bg-light"><span id="modal-email-empresa"></span></div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="sitio_web" class="form-label">Sitio web (opcional)</label>
            <div class="form-control bg-light"><span id="modal-sitio_web-empresa"></span></div>
        </div>
    </div>
    <div class="text-end mt-3">
        <button type="button" class="btn btn-secondary btn-regresar-etapa1 btn-sm">Regresar</button>
    </div>
</div>
@elseif($etapa == 3)
<div class="etapa-content">
    <h5 class="text-primary mb-3">Datos del Jefe Inmediato</h5>
    <div class="mb-3">
        <label for="name" class="form-label">Apellidos y Nombres</label>
        <div class="form-control bg-light"><span id="modal-name-jefe"></span></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <div class="form-control bg-light"><span id="modal-dni-jefe"></span></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="sitio_web" class="form-label">Sitio web (opcional)</label>
                <div class="form-control bg-light"><span id="modal-sitio_web-jefe"></span></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="area" class="form-label">Area o Departamento</label>
                <div class="form-control bg-light"><span id="modal-area-jefe"></span></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo o Puesto</label>
                <div class="form-control bg-light"><span id="modal-cargo-jefe"></span></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <div class="form-control bg-light"><span id="modal-telefono-jefe"></span></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <div class="form-control bg-light"><span id="modal-email-jefe"></span></div>
            </div>
        </div>
    </div>
    <div class="text-end mt-3">
        <button type="button" class="btn btn-secondary btn-regresar-etapa2 btn-sm">Regresar</button>
    </div>
</div>
@endif


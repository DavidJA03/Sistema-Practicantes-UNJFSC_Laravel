<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase text-center">Tercera Etapa - Documentación de Informes</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">

            <div id="seccion-desarrollo-E3" style="display: none;">
                <div class="row w-100">
                    <div class="col-xl-6 col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="py-3 text-center">
                                <div class="d-flex flex-row align-items-center justify-content-center">
                                    <i class="fas fa-envelope mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Carta de Aceptación</h5>
                                        <a href="" target="_blank" class="btn btn-warning btn-sm" id="btn-ruta-carta-aceptacion-E3">
                                            Ver PDF
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
                                    <i class="fas fa-file-signature mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Plan de Actividades de las PPP</h5>
                                        <a href="" target="_blank" class="btn btn-warning btn-sm" id="btn-ruta-plan-actividades">
                                            Ver PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="seccion-convalidacion-E3" style="display: none;">
                <div class="row w-100">
                    <div class="col-xl-6 col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="py-3 text-center">
                                <div class="d-flex flex-row align-items-center justify-content-center">
                                    <i class="fas fa-envelope mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Registro de Actividades</h5>
                                        <a href="" target="_blank" class="btn btn-warning btn-sm" id="btn-ruta-registro-actividades">
                                            Ver PDF
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
                                    <i class="fas fa-file-signature mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Control Mensual de Actividades</h5>
                                        <a href="" target="_blank" class="btn btn-warning btn-sm" id="btn-ruta-control-mensual-actividades">
                                            Ver PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <form id="formProcesoE3" class="form-etapa" action="{{ route('proceso') }}" method="POST" data-estado="3">
                @csrf
                <input type="hidden" name="id" id="idE3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estadoE3" name="estado" required>
                                <option value="" selected disabled>Seleccione un estado</option>
                                <option value="rechazado">Rechazado</option>
                                <option value="aprobado">Aprobado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 d-flex align-items-center h-100" style="height: 100%;">
                            <button type="submit" form="formProcesoE3" class="btn btn-primary btn-sm">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

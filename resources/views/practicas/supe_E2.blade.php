<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase text-center">Segunda Etapa - Documentación</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row w-100">
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-file-invoice mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Formulario (FUT)</h5>
                                    <a href="" target="_blank" class="btn btn-warning btn-sm" id="btn-ruta-fut">
                                        Ver PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6" id="seccion-desarrollo-E2" style="display: none;">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-envelope mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Carta de Presentación</h5>
                                    <a href="" target="_blank" class="btn btn-warning btn-sm" id="btn-ruta-carta-presentacion">
                                        Ver PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6" id="seccion-convalidacion-E2" style="display: none;">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-envelope mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Carta de Aceptación</h5>
                                    <a href="" target="_blank" class="btn btn-warning btn-sm" id="btn-ruta-carta-aceptacion-C2">
                                        Ver PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form id="formProcesoE2" class="form-etapa" action="{{ route('proceso') }}" method="POST" data-estado="2">
                @csrf
                <input type="hidden" name="id" id="idE2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estadoE2" name="estado" required>
                                <option value="" selected disabled>Seleccione un estado</option>
                                <option value="rechazado">Rechazado</option>
                                <option value="aprobado">Aprobado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 d-flex align-items-center h-100" style="height: 100%;">
                            <button type="submit" form="formProcesoE2" class="btn btn-primary btn-sm">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase text-center">Tercera Etapa - Documentación de Informes</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row w-100">
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-envelope mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                @if ($practicaData->ruta_carta_aceptacion != null)
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Carta de Aceptación</h4>
                                    <a href="{{ asset($practicaData->ruta_carta_aceptacion) }}" target="_blank" class="btn btn-warning btn-sm">
                                        Ver PDF
                                    </a>
                                </div>
                                @else
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Carta de Aceptación</h4>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCartaAceptacion">
                                        Subir Documento
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
                                <i class="fas fa-file-signature mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                @if ($practicaData->ruta_plan_actividades != null)
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Plan de Actividades de las PPP</h4>
                                    <a href="{{ asset($practicaData->ruta_plan_actividades) }}" target="_blank" class="btn btn-warning btn-sm">
                                        Ver PDF
                                    </a>
                                </div>
                                @else
                                <div class="flex-column">
                                    <h5 class="text-primary font-weight-bold text-uppercase">Plan de Actividades de las PPP</h4>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPlanActividadesPPP">
                                        Subir Documento
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

<!-- Carta de Aceptación -->
<div class="modal fade" id="modalCartaAceptacion" tabindex="-1" aria-labelledby="modalCartaAceptacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCartaAceptacionLabel">Subir Carta de Aceptación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.cartaaceptacion') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <input type="file" name="carta_aceptacion" accept="application/pdf" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Plan de Actividades de las PPP -->
<div class="modal fade" id="modalPlanActividadesPPP" tabindex="-1" aria-labelledby="modalPlanActividadesPPPLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalPlanActividadesPPPLabel">Subir Plan de Actividades de las PPP</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.planactividadesppp') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <input type="file" name="plan_actividades_ppp" accept="application/pdf" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>

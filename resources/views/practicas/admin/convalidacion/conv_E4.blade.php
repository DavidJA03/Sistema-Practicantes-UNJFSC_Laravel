<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase text-center">Cuarta Etapa - Presentación de Informes</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row w-100">
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="py-3 text-center">
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <i class="fas fa-scroll mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                @if($practicaData->ruta_constancia_cumplimiento != null)
                                    @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Constancia de Cumplimiento</h4>
                                        <a href="{{ asset($practicaData->ruta_constancia_cumplimiento) }}" target="_blank" class="btn btn-warning btn-sm">
                                            Ver PDF
                                        </a>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalConstanciaCumplimiento">
                                            Editar Documento
                                        </button>
                                    </div>
                                    @elseif ($practicaData->estado_proceso === 'completo')
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Constancia de Cumplimiento</h4>
                                            <a href="{{ asset($practicaData->ruta_constancia_cumplimiento) }}" target="_blank" class="btn btn-warning btn-sm">
                                                Ver PDF
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Constancia de Cumplimiento</h4>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalConstanciaCumplimiento">
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
                                <i class="fas fa-file-invoice mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                @if($practicaData->ruta_informe_final != null)
                                    @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Informe Final de PPP</h4>
                                        <a href="{{ asset($practicaData->ruta_informe_final) }}" target="_blank" class="btn btn-warning btn-sm">
                                            Ver PDF
                                        </a>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalInformeFinalPPP">
                                            Editar Documento
                                        </button>
                                    </div>
                                    @elseif ($practicaData->estado_proceso === 'completo')
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Informe Final de PPP</h4>
                                            <a href="{{ asset($practicaData->ruta_informe_final) }}" target="_blank" class="btn btn-warning btn-sm">
                                                Ver PDF
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Informe Final de PPP</h4>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalInformeFinalPPP">
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

@if ($practicaData->estado_proceso === 'rechazado')
    <div class="d-flex justify-content-center align-items-center my-5">
        <div class="alert alert-danger shadow-lg p-5 rounded-lg text-center" style="max-width: 400px; width: 100%;">
            <div class="mb-4">
                <i class="fas fa-exclamation-triangle fa-4x text-warning"></i>
            </div>
            <h2 class="font-weight-bold mb-3">¡Atención!</h2>
            <p class="mb-0" style="font-size: 20px;">
                Debes corregir los archivos ingresados en la sección de Constancia de Cumplimiento y/o Informe Final de PPP antes de continuar con el proceso.
            </p>
        </div>
    </div>
@endif

<!-- Constancia de Cumplimiento -->
<div class="modal fade" id="modalConstanciaCumplimiento" tabindex="-1" aria-labelledby="modalConstanciaCumplimientoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalConstanciaCumplimientoLabel">Subir Documento</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.constanciacumplimiento') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <input type="file" name="constancia_cumplimiento" accept="application/pdf" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Informe Final de PPP -->
<div class="modal fade" id="modalInformeFinalPPP" tabindex="-1" aria-labelledby="modalInformeFinalPPPLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalInformeFinalPPPLabel">Subir Documento</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.informefinalppp') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <input type="file" name="informe_final_ppp" accept="application/pdf" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>
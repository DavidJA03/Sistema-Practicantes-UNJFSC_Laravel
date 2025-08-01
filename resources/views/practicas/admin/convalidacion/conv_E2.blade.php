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
                                @if ($practicaData->ruta_fut != null)
                                    @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Formulario de Trámite (FUT)</h4>
                                            <a href="{{ asset($practicaData->ruta_fut) }}" target="_blank" class="btn btn-warning btn-sm">
                                                Ver PDF
                                            </a>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFUT">
                                                Editar Documento
                                            </button>
                                        </div>
                                    @elseif ($practicaData->estado_proceso === 'completo')
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Formulario de Trámite (FUT)</h4>
                                            <a href="{{ asset($practicaData->ruta_fut) }}" target="_blank" class="btn btn-warning btn-sm">
                                                Ver PDF
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Formulario de Trámite (FUT)</h4>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFUT">
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
                                <i class="fas fa-envelope mr-3" style="font-size: 50px; color: rgb(123, 145, 229);"></i>
                                @if ($practicaData->ruta_carta_aceptacion != null)
                                    @if ($practicaData->estado_proceso === 'en proceso' || $practicaData->estado_proceso === 'rechazado')
                                    <div class="flex-column">
                                        <h5 class="text-primary font-weight-bold text-uppercase">Carta de Aceptación</h4>
                                        <a href="{{ asset($practicaData->ruta_carta_aceptacion) }}" target="_blank" class="btn btn-warning btn-sm">
                                            Ver PDF
                                        </a>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCartaAceptacion">
                                            Editar Documento
                                        </button>
                                    </div>
                                    @elseif ($practicaData->estado_proceso === 'completo')
                                        <div class="flex-column">
                                            <h5 class="text-primary font-weight-bold text-uppercase">Carta de Aceptación</h4>
                                            <a href="{{ asset($practicaData->ruta_carta_aceptacion) }}" target="_blank" class="btn btn-warning btn-sm">
                                                Ver PDF
                                            </a>
                                        </div>
                                    @endif
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
                Debes corregir los archivos ingresados en la sección de Formulario de Trámite (FUT) y/o Carta de Aceptación antes de continuar con el proceso.
            </p>
        </div>
    </div>
@endif

<!-- Formulario de Trámite (FUT) -->
<div class="modal fade" id="modalFUT" tabindex="-1" aria-labelledby="modalFUTLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalFUTLabel">Subir Formulario de Trámite (FUT)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.fut') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $practicaData->id }}">
                <div class="modal-body">
                    <input type="file" name="fut" accept="application/pdf" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
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
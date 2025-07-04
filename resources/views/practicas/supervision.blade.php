@extends('template')
@section('title', 'Supervision')

@push('css')
<style>

</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Estudiantes</h6>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">N°</th>
                            <th class="align-middle text-center">Tipo de Práctica</th>
                            <th class="align-middle text-center">Apellidos y Nombres</th>
                            <th class="align-middle text-center">Area</th>
                            <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="align-middle text-center">N°</th>
                            <th class="align-middle text-center">Tipo de Práctica</th>
                            <th class="align-middle text-center">Apellidos y Nombres</th>
                            <th class="align-middle text-center">Area</th>
                            <th class="align-middle text-center">Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($personas as $index => $persona)
                        <tr data-docente-id="{{ $persona->id }}">
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center text-uppercase">{{ $persona->practica->tipo_practica ?? 'No registrado' }}</td>
                            <td class="align-middle">{{ strtoupper($persona->apellidos . ' ' . $persona->nombres) }}</td>
                            <td class="align-middle text-center text-uppercase">{{ $persona->practica->area ?? 'No registrado' }}</td>
                            <td class="align-middle text-center">
                                @if($persona->practica)
                                <button 
                                    class="btn btn-mostrar btn-info btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalProceso"
                                    data-id="{{ $persona->id }}"
                                    data-id_practica="{{ $persona->practica->id }}"
                                    data-tipo_practica="{{ $persona->practica->tipo_practica }}"
                                    data-estado="{{ $persona->practica->estado }}"
                                    data-nombre="{{ $persona->practica->empresa->nombre ?? 'No registrado' }}"
                                    data-ruc="{{ $persona->practica->empresa->ruc ?? 'No registrado' }}"
                                    data-razon_social="{{ $persona->practica->empresa->razon_social ?? 'No registrado' }}"
                                    data-direccion="{{ $persona->practica->empresa->direccion ?? 'No registrado' }}"
                                    data-telefono="{{ $persona->practica->empresa->telefono ?? 'No registrado' }}"
                                    data-email="{{ $persona->practica->empresa->correo ?? 'No registrado' }}"
                                    data-sitio_web="{{ $persona->practica->empresa->web ?? 'No registrado' }}"
                                    data-jefe_inmediato="{{ $persona->practica->jefeInmediato->nombres ?? 'No registrado' }}"
                                    data-area-jefe="{{ $persona->practica->jefeInmediato->area ?? 'No registrado' }}"
                                    data-cargo-jefe="{{ $persona->practica->jefeInmediato->cargo ?? 'No registrado' }}"
                                    data-dni-jefe="{{ $persona->practica->jefeInmediato->dni ?? 'No registrado' }}"
                                    data-web-jefe="{{ $persona->practica->jefeInmediato->web ?? 'No registrado' }}"
                                    data-telefono-jefe="{{ $persona->practica->jefeInmediato->telefono ?? 'No registrado' }}"
                                    data-email-jefe="{{ $persona->practica->jefeInmediato->correo ?? 'No registrado' }}"
                                    data-ruta_fut="{{ $persona->practica->ruta_fut ?? 'No registrado' }}"
                                    data-ruta_plan_actividades="{{ $persona->practica->ruta_plan_actividades ?? 'No registrado' }}"
                                    data-ruta_informe_final="{{ $persona->practica->ruta_informe_final ?? 'No registrado' }}"
                                    data-ruta_constancia_cumplimiento="{{ $persona->practica->ruta_constancia_cumplimiento ?? 'No registrado' }}"
                                    data-ruta_carta_aceptacion="{{ $persona->practica->ruta_carta_aceptacion ?? 'No registrado' }}"
                                    data-ruta_carta_presentacion="{{ $persona->practica->ruta_carta_presentacion ?? 'No registrado' }}"
                                    data-ruta_registro_actividades="{{ $persona->practica->ruta_registro_actividades ?? 'No registrado' }}"
                                    data-ruta_control_mensual_actividades="{{ $persona->practica->ruta_control_mensual_actividades ?? 'No registrado' }}"
                                >
                                    Proceso
                                </button>
                                @else
                                No registrado
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if($personas->isEmpty())
                        <tr>
                            <td colspan="5" class="align-middle text-center">No se encontraron registros.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Proceso -->
<div class="modal fade" id="modalProceso" tabindex="-1" role="dialog" aria-labelledby="modalProcesoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalProcesoLabel">Proceso</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <button class="btn btn-etapa btn-info btn-sm w-100" id="btn1" data-estado="1">Etapa 1</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <button class="btn btn-etapa btn-info btn-sm w-100" id="btn2" data-estado="2">Etapa 2</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <button class="btn btn-etapa btn-info btn-sm w-100" id="btn3" data-estado="3">Etapa 3</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <button class="btn btn-etapa btn-info btn-sm w-100" id="btn4" data-estado="4">Etapa 4</button>
                        </div>
                    </div>
                </div>
                <div id="primeraetapa">
                    <div id="etapa1">
                        @include('practicas.supe_E1', ['etapa' => 1])
                    </div>

                    <div id="etapa2" style="display: none;">
                        @include('practicas.supe_E1', ['etapa' => 2])
                    </div>

                    <div id="etapa3" style="display: none;">
                        @include('practicas.supe_E1', ['etapa' => 3])
                    </div>
                </div>
                <div id="segundaetapa">
                    @include('practicas.supe_E2')
                </div>
                <div id="terceraetapa">
                    @include('practicas.supe_E3')
                </div>
                <div id="cuartaetapa">
                    @include('practicas.supe_E4')
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/supervision_practica.js') }}"></script>
@endpush

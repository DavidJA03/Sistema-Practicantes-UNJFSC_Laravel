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
                                    data-id_practica="{{ $persona->practica->id }}"
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
                        @include('practicas.supervision.supe_E1', ['etapa' => 1])
                    </div>

                    <div id="etapa2" style="display: none;">
                        @include('practicas.supervision.supe_E1', ['etapa' => 2])
                    </div>

                    <div id="etapa3" style="display: none;">
                        @include('practicas.supervision.supe_E1', ['etapa' => 3])
                    </div>
                </div>
                <div id="segundaetapa">
                    @include('practicas.supervision.supe_E2')
                </div>
                <div id="terceraetapa">
                    @include('practicas.supervision.supe_E3')
                </div>
                <div id="cuartaetapa">
                    @include('practicas.supervision.supe_E4')
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

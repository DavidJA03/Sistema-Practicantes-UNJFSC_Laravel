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
                                    data-estado="{{ $persona->practica->id }}"
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
                            <div class="btn btn-mostrar btn-info btn-sm w-100" id="btn1">
                                Etapa 1
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="btn btn-mostrar btn-info btn-sm w-100" id="btn2">
                                Etapa 2
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="btn btn-mostrar btn-info btn-sm w-100" id="btn3">
                                Etapa 3
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="btn btn-mostrar btn-info btn-sm w-100" id="btn4">
                                Etapa 4
                            </div>
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
                <form id="formProceso" action="{{ route('proceso') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="" selected disabled>Seleccione un estado</option>
                                    <option value="rechazado">Rechazado</option>
                                    <option value="aprobado">Aprobado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 d-flex align-items-center h-100" style="height: 100%;">
                                <button type="submit" form="formProceso" class="btn btn-primary btn-sm">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const etapa1 = document.getElementById("etapa1");
        const etapa2 = document.getElementById("etapa2");
        const etapa3 = document.getElementById("etapa3");

        const btnEtapa2 = document.getElementById("btnEtapa2");
        const btnEtapa3 = document.getElementById("btnEtapa3");

        // Mostrar Etapa 2
        btnEtapa2?.addEventListener("click", function () {
            etapa1.style.display = "none";
            etapa2.style.display = "block";
            etapa3.style.display = "none";
        });

        // Mostrar Etapa 3
        btnEtapa3?.addEventListener("click", function () {
            etapa1.style.display = "none";
            etapa2.style.display = "none";
            etapa3.style.display = "block";
        });

        // Regresar a Etapa 1
        document.querySelectorAll(".btn-regresar-etapa1").forEach(btn => {
            btn.addEventListener("click", function () {
                etapa1.style.display = "block";
                etapa2.style.display = "none";
                etapa3.style.display = "none";
            });
        });

        // Regresar a Etapa 2
        document.querySelectorAll(".btn-regresar-etapa2").forEach(btn => {
            btn.addEventListener("click", function () {
                etapa1.style.display = "block";
                etapa2.style.display = "none";
                etapa3.style.display = "none";
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const modalProceso = document.getElementById('modalProceso');

        modalProceso.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const estado = button.getAttribute('data-estado');

            const nombre = button.getAttribute('data-nombre');
            const ruc = button.getAttribute('data-ruc');
            const razon_social = button.getAttribute('data-razon_social');
            const direccion = button.getAttribute('data-direccion');
            const telefono = button.getAttribute('data-telefono');
            const email = button.getAttribute('data-email');
            const sitio_web = button.getAttribute('data-sitio_web');

            const jefe_inmediato = button.getAttribute('data-jefe_inmediato');
            const area_jefe = button.getAttribute('data-area-jefe');
            const cargo_jefe = button.getAttribute('data-cargo-jefe');
            const dni_jefe = button.getAttribute('data-dni-jefe');
            const web_jefe = button.getAttribute('data-web-jefe');
            const telefono_jefe = button.getAttribute('data-telefono-jefe');
            const email_jefe = button.getAttribute('data-email-jefe');

            const ruta_fut = button.getAttribute('data-ruta_fut');
            const ruta_plan_actividades = button.getAttribute('data-ruta_plan_actividades');
            const ruta_informe_final = button.getAttribute('data-ruta_informe_final');
            const ruta_constancia_cumplimiento = button.getAttribute('data-ruta_constancia_cumplimiento');
            const ruta_carta_aceptacion = button.getAttribute('data-ruta_carta_aceptacion');
            const ruta_carta_presentacion = button.getAttribute('data-ruta_carta_presentacion');

            document.getElementById('id').value = estado;

            document.getElementById('modal-nombre-empresa').textContent = nombre;
            document.getElementById('modal-ruc-empresa').textContent = ruc;
            document.getElementById('modal-razon_social-empresa').textContent = razon_social;
            document.getElementById('modal-direccion-empresa').textContent = direccion;
            document.getElementById('modal-telefono-empresa').textContent = telefono;
            document.getElementById('modal-email-empresa').textContent = email;
            document.getElementById('modal-sitio_web-empresa').textContent = sitio_web;

            document.getElementById('modal-name-jefe').textContent = jefe_inmediato;
            document.getElementById('modal-area-jefe').textContent = area_jefe;
            document.getElementById('modal-cargo-jefe').textContent = cargo_jefe;
            document.getElementById('modal-dni-jefe').textContent = dni_jefe;
            document.getElementById('modal-sitio_web-jefe').textContent = web_jefe;
            document.getElementById('modal-telefono-jefe').textContent = telefono_jefe;
            document.getElementById('modal-email-jefe').textContent = email_jefe;

            document.getElementById('btn-ruta-fut').href = ruta_fut;
            document.getElementById('btn-ruta-plan-actividades').href = ruta_plan_actividades;
            document.getElementById('btn-ruta-informe-final').href = ruta_informe_final;
            document.getElementById('btn-ruta-constancia-cumplimiento').href = ruta_constancia_cumplimiento;
            document.getElementById('btn-ruta-carta-aceptacion').href = ruta_carta_aceptacion;
            document.getElementById('btn-ruta-carta-presentacion').href = ruta_carta_presentacion;
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const btn1 = document.getElementById("btn1");
        const btn2 = document.getElementById("btn2");
        const btn3 = document.getElementById("btn3");
        const btn4 = document.getElementById("btn4");

        const primeraEtapa = document.getElementById("primeraetapa");
        const segundaEtapa = document.getElementById("segundaetapa");
        const terceraEtapa = document.getElementById("terceraetapa");
        const cuartaEtapa = document.getElementById("cuartaetapa");

        function ocultarTodo() {
            primeraEtapa.style.display = "none";
            segundaEtapa.style.display = "none";
            terceraEtapa.style.display = "none";
            cuartaEtapa.style.display = "none";
        }

        function mostrarEtapa(etapa) {
            ocultarTodo();
            etapa.style.display = "block";
        }

        btn1.addEventListener("click", function () {
            mostrarEtapa(primeraEtapa);
        });

        btn2.addEventListener("click", function () {
            mostrarEtapa(segundaEtapa);
        });

        btn3.addEventListener("click", function () {
            mostrarEtapa(terceraEtapa);
        });

        btn4.addEventListener("click", function () {
            mostrarEtapa(cuartaEtapa);
        });

        // Al abrir el modal, mostrar la primera etapa por defecto
        const modalProceso = document.getElementById("modalProceso");
        modalProceso.addEventListener("show.bs.modal", function () {
            mostrarEtapa(primeraEtapa);
        });
    })
</script>
@endpush

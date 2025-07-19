@extends('template')

@section('title', 'Evaluación de Estudiantes')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});
</script>
@endif
@endpush

<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Evaluación de Estudiantes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaEvaluacion" class="table table-bordered table-hover align-middle" width="100%">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Estudiante</th>
                            <th width ="30%">Evaluación</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($alumnos as $alumno)
                        @php
                            $evaluacion = $alumno->evaluacione;
                            $anexosCompletos = $evaluacion && $evaluacion->anexo_6 && $evaluacion->anexo_7 && $evaluacion->anexo_8;
                            $entrevistaCompleta = $alumno->respuestas && $alumno->respuestas->count();
                        @endphp
                        <tr>
                            <td class="text-center">{{ $alumno->id }}</td>
                            <td>{{ $alumno->nombres }} {{ $alumno->apellidos }}</td>
                            <td class="text-center">
                                @if($evaluacion)
                                    @if($evaluacion->anexo_6)
                                        <a href="{{ Storage::url($evaluacion->anexo_6) }}" class="btn btn-success btn-sm" target="_blank">
                                            <i class="bi bi-file-pdf-fill"></i><i class="bi bi-6-square"></i></a>
                                    @endif
                                    @if($evaluacion->anexo_7)
                                        <a href="{{ Storage::url($evaluacion->anexo_7) }}" class="btn btn-success btn-sm" target="_blank">
                                            <i class="bi bi-file-pdf-fill"></i><i class="bi bi-7-square"></i>
                                        </a>
                                    @endif
                                    @if($evaluacion->anexo_8)
                                        <a href="{{ Storage::url($evaluacion->anexo_8) }}" class="btn btn-success btn-sm" target="_blank">
                                            <i class="bi bi-file-pdf-fill"></i><i class="bi bi-8-square"></i>
                                        </a>
                                    @endif
                                @endif

                                @if($entrevistaCompleta)
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#verEntrevistaModal-{{ $alumno->id }}">
                                        <i class="bi bi-chat-text"></i> 
                                    </button>
                                @endif

                                @if(!$anexosCompletos || !$entrevistaCompleta)
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#menuEvaluarModal-{{ $alumno->id }}">
                                        <i class="bi bi-check2-circle"></i> Evaluar
                                    </button>
                                @endif
                            </td>
                        </tr>

                        {{-- Modal Opciones --}}
                        <div class="modal fade" id="menuEvaluarModal-{{ $alumno->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Opciones de Evaluación - {{ $alumno->nombres }} {{ $alumno->apellidos }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center" >
                                        @if(!$anexosCompletos)
                                            <button class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#subirAnexosModal-{{ $alumno->id }}" data-bs-dismiss="modal">
                                                <i class="bi bi-upload"></i> Subir Anexos
                                            </button>
                                        @else
                                            <p class="text-muted mb-2">✔ Anexos completados</p>
                                        @endif
                                        <p></p>
                                        @if(!$entrevistaCompleta)
                                            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#realizarEntrevistaModal-{{ $alumno->id }}" data-bs-dismiss="modal">
                                                <i class="bi bi-check"></i> Realizar Entrevista
                                            </button>
                                        @else
                                            <p class="text-muted">✔ Entrevista completada</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Subir Anexos --}}
                        <div class="modal fade" id="subirAnexosModal-{{ $alumno->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('evaluacion.storeAnexos') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="alumno_id" value="{{ $alumno->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Subir Anexos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Anexo 6 (PDF)</label>
                                                <input type="file" name="anexo_6" class="form-control" accept="application/pdf" {{ empty($evaluacion->anexo_6) ? 'required' : '' }}>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Anexo 7 (PDF)</label>
                                                <input type="file" name="anexo_7" class="form-control" accept="application/pdf" {{ empty($evaluacion->anexo_7) ? 'required' : '' }}>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Anexo 8 (PDF)</label>
                                                <input type="file" name="anexo_8" class="form-control" accept="application/pdf" {{ empty($evaluacion->anexo_8) ? 'required' : '' }}>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Entrevista --}}
                        <div class="modal fade" id="realizarEntrevistaModal-{{ $alumno->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('respuestas.store') }}">
                                        @csrf
                                        <input type="hidden" name="alumno_id" value="{{ $alumno->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Entrevista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($preguntas as $pregunta)
                                            <div class="mb-3">
                                                <label class="form-label">{{ $pregunta->pregunta }}</label>
                                                <input type="text" name="respuestas[{{ $pregunta->id }}]" class="form-control" required>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Ver Entrevista --}}
                        @if($entrevistaCompleta)
                        <div class="modal fade" id="verEntrevistaModal-{{ $alumno->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Entrevista de {{ $alumno->nombres }} {{ $alumno->apellidos }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($alumno->respuestas as $respuesta)
                                        <div class="mb-3">
                                            <strong>{{ $respuesta->pregunta->pregunta }}</strong>
                                            <p>{{ $respuesta->respuesta }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#tablaEvaluacion').DataTable({
        language: {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
});
</script>
@endpush

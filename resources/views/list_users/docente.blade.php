@extends('template')
@section('title', 'Listado de Docentes')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Docentes</h6>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Código</th>
                            <th>Apellidos y Nombres</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $index => $persona)
                        <tr data-docente-id="{{ $persona->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $persona->codigo }}</td>
                            <td>{{ strtoupper($persona->apellidos . ' ' . $persona->nombres) }}</td>
                            <td>{{ $persona->dni }}</td>
                            <td>{{ $persona->correo_inst }}</td>
                            <td>{{ $persona->celular }}</td>
                            <td>
                                <button type="button" class="btn btn-mostrar btn-info btn-sm" 
                                data-toggle="modal" data-target="#modalEditar{{ $persona->id }}" 
                                data-d="{{ $persona->distrito }}" data-p="{{ $persona->provincia }}"
                                data-f="{{ $persona->escuela->facultad_id ?? '' }}" data-e="{{ $persona->id_escuela ?? '' }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">
                                    <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($personas->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">No se encontraron registros.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal-->
@foreach ($personas as $persona)
<div class="modal fade" id="modalEditar{{ $persona->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerLabel">Información de la Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditPersona{{ $persona->id }}" method="POST" action="{{ route('persona.editar') }}" enctype="multipart/form-data">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="persona_id" name="persona_id" value="{{ $persona->id }}">
                    <div class="row">
                        <!-- Columna izquierda: Formulario -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $persona->codigo }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dni">DNI</label>
                                        <input type="text" class="form-control" id="dni" name="dni" value="{{ $persona->dni }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular</label>
                                        <input type="tel" class="form-control" id="celular" name="celular" value="{{ $persona->celular }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $persona->nombres }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $persona->apellidos }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="correo_inst">Correo Institucional</label>
                                        <input type="email" class="form-control" id="correo_inst" name="correo_inst" value="{{ $persona->correo_inst }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departamento">Departamento</label>
                                        <input type="text" class="form-control" id="departamento" name="departamento" value="{{ $persona->departamento }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Género</label>
                                        <select class="form-control" id="sexo" name="sexo" value="{{ $persona->sexo }}" disabled>
                                            <option value="">Seleccione</option>
                                            <option value="M"{{ $persona->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                            <option value="F"{{ $persona->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="provincia">Provincia</label>
                                        <select class="form-control" id="provincia" name="provincia" disabled>
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="distrito">Distrito</label>
                                        <select class="form-control" id="distrito" name="distrito" value="{{ $persona->distrito }}"  disabled>
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facultad">Facultad</label>
                                        <select class="form-control" id="facultad" name="facultad" disabled>
                                            <option value="">Seleccione</option>
                                            @foreach($facultades as $facultad)
                                                <option value="{{ $facultad->id }}">{{ $facultad->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="escuela">Escuela</label>
                                        <select class="form-control" id="escuela" name="escuela" disabled>
                                            <option value="">Seleccione</option>
                                            @foreach($escuelas as $escuela)
                                                <option value="{{ $escuela->id }}" data-facultad="{{ $escuela->facultad_id }}" hidden>
                                                    {{ $escuela->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex flex-column align-items-center justify-content-center">
                            <div class="form-group text-center">
                                <!-- Ícono por defecto -->
                                <i id="iconoDefault" class="fas fa-user mb-3"
                                    style="font-size: 200px; color: rgb(123, 145, 229); {{ $persona->ruta_foto ? 'display: none;' : '' }}"></i>

                                <!-- Imagen si existe -->
                                <img id="previewFoto"
                                    src="{{ $persona->ruta_foto ? asset($persona->ruta_foto) : '' }}"
                                    alt="Foto"
                                    class="img-fluid mb-3"
                                    style="width: 200px; height: 200px; object-fit: cover; {{ $persona->ruta_foto ? '' : 'display: none;' }}">

                                <!-- Input file oculto -->
                                <input type="file" name="ruta_foto" id="ruta_foto" accept="image/*" onchange="previewImagen(event)" hidden>

                                <!-- Botón estilizado -->
                                <label for="ruta_foto" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-upload"></i> Actualizar Foto
                                </label>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" id="btnEditar">
                    <i class="fas fa-edit"></i> Editar 
                </button>
                <button type="submit" form="formEditPersona{{ $persona->id }}" class="btn btn-success btn-sm d-none ml-2" id="btnUpdate">
                    <i class="fas fa-save"></i>
                    Actualizar
                </button>
                <button type="button" class="btn btn-secondary btn-sm" id="btnCancelar" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('js')
<script src="{{ asset('js/persona_edit.js') }}"></script>
@endpush

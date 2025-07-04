@extends('template')
@section('title', 'Perfil')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
    <p></p>
    <div class="row">
        <!-- Datos Personales -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-primary">Datos Personales</h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-info btn-sm" id="perfEdit">
                                <i class="fas fa-edit"></i>    
                                Editar 
                            </button>
                            <button type="button" class="btn btn-success btn-sm d-none ml-2" id="perfUpdate">
                                <i class="fas fa-save"></i>
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formEditPerfil">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="persona_id" name="persona_id" value="{{ $persona->id }}">
                        <!-- Fila 1 -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $persona->codigo ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" value="{{ $persona->dni ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular" value="{{ $persona->celular ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>  
                        <!-- Fila 2 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $persona->nombres ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $persona->apellidos ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- Fila 3 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo_inst">Correo Institucional</label>
                                    <input type="email" class="form-control" id="correo_inst" name="correo_inst" value="{{ $persona->correo_inst ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input type="text" class="form-control" id="departamento" name="departamento" value="{{ $persona->departamento ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- Fila 4 -->
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <select class="form-control" id="provincia" name="provincia" readonly>
                                    <option value="">Seleccione una provincia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="distrito">Distrito</label>
                                <select class="form-control" id="distrito" name="distrito"  disabled readonly>
                                    <option value="">Seleccione un distrito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Fotografía -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Fotografía</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        @if ($persona->ruta_foto)
                            <img src="{{ asset($persona->ruta_foto) }}" alt="Foto" class="img-fluid rounded-circle" style="width: 255px; height: 255px; object-fit: cover;">
                        @else
                            <i class="fas fa-user" style="font-size: 255px; color: rgb(123, 145, 229);"></i>
                        @endif
                        <hr>
                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalFoto">Subir Foto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Subir Foto -->
<div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalFotoLabel">Subir Foto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.foto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="persona_id" value="{{ $persona->id }}">
                <div class="modal-body">
                    <input type="file" name="foto" accept="image/*" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/perfil_edit.js') }}"></script>
@endpush

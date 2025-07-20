@extends('template')
@section('title', 'Perfil')


@push('css')

@endpush

@section('content')
<style>
    .centrar-vertical {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 100px); /* Ajusta según el header/footer que tengas */
    }
</style>
<div class="container-fluid centrar-vertical">
<div class="row w-100">
        <div class="col-xl-6 col-lg-6">
            <button class="card card-registro shadow w-100 mb-4 d-flex flex-column justify-content-center align-items-center" style="height: 400px;" data-toggle="modal" data-target="#modalRegistro" >
                <div class="py-3 text-center mt-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-user" style="font-size: 200px; color: rgb(123, 145, 229);"></i>
                        <h3 class="mt-3 text-primary font-weight-bold"> Añadir un Usuario</h3>
                    </div>
                </div>
            </button>
        </div>

        <div class="col-xl-6 col-lg-6">
            <button class="card card-carga-masiva shadow w-100 mb-4 d-flex flex-column justify-content-center align-items-center" style="height: 400px;" data-toggle="modal" data-target="#modalCargaMasiva">
                <div class="py-3 text-center mt-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-users" style="font-size: 200px; color: rgb(123, 145, 229);"></i>
                        <h3 class="mt-3 text-primary font-weight-bold uppercase">Añadir Usuarios</h3>
                    </div>
                </div>
            </button>
        </div>
    </div>
</div>

<!--Carga_Masiva-->
<div class="modal fade" id="modalCargaMasiva" tabindex="-1" role="dialog" aria-labelledby="modalCargaMasivaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCargaMasivaLabel">Carga Masiva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="formUsuarioMasivo" enctype="multipart/form-data" action="{{ route('usuarios.masivos.store') }}" method="POST">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="rol">Tipo de Usuario</label>
                        <select class="form-control" id="rolMasivo" name="rol" required onchange="toggleFacultadEscuela('facultadEscuelaContainerMasivo')">
                            <option value="">Seleccione un tipo de usuario</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="facultadEscuelaContainerMasivo">
                        <div class="form-group">
                            <label for="facultadMasiva">Facultad</label>
                            <select class="form-control" id="facultadMasiva" name="facultad">
                                <option value="">Seleccione</option>
                                @foreach($facultades as $facultad)
                                    <option value="{{ $facultad->id }}">{{ $facultad->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="escuelaMasiva">Escuela</label>
                            <select class="form-control" id="escuelaMasiva" name="escuela" disabled>
                                <option value="">Seleccione</option>
                                @foreach($escuelas as $escuela)
                                    <option value="{{ $escuela->id }}" data-facultad="{{ $escuela->facultad_id }}" hidden>
                                        {{ $escuela->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="archivo" class="d-block mb-2">Archivo CSV</label>
                        <div class="align-items-center gap-2">
                            <label class="btn btn-success btn-icon-split" for="archivo">
                                <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-folder"></i>
                                </span>
                                <span class="text">Cargar Archivo</span>
                            </label>
                            <span class="file-name text-truncate"
                                    id="archivo-nombre" readonly>
                                    Seleccione un archivo Seleccionado
                            </span>
                            <input type="file" class="d-none" id="archivo" 
                                    name="archivo" accept=".csv" required 
                                    onchange="document.getElementById('archivo-nombre').textContent = this.files[0].name">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="formUsuarioMasivo" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--Fin Carga_Masiva-->

<!--Registro-->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="modalRegistroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistroLabel">Registro de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRegistro" action="{{ route('personas.store') }}" method="POST">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="tel" class="form-control" id="codigo" name="codigo" maxlength="10" required  oninput="completarCorreo()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="tel" class="form-control" id="dni" name="dni" required maxlength="8" pattern="\d{1,9}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="tel" class="form-control" id="celular" name="celular" required maxlength="9" pattern="\d{1,9}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required oninput="completarCorreo()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required oninput="completarCorreo()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="correo_inst">Correo Institucional</label>
                                <input type="email" class="form-control" id="correo_inst" name="correo_inst" placeholder="ejemplo@unjfsc.edu.pe" required disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rol">Tipo de Usuario</label>
                                <select class="form-control" id="rolRegistro" name="rol" required onchange="toggleFacultadEscuela('facultadEscuelaContainerRegistro'); completarCorreo();">
                                    <option value="">Seleccione un tipo de usuario</option>
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sexo">Género</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                    <option value="">Seleccione su género</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <input type="text" class="form-control" id="departamento" name="departamento" value="Lima Provincias" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <select class="form-control" id="provincia" name="provincia" required>
                                    <option value="">Seleccione una provincia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="distrito">Distrito</label>
                                <select class="form-control" id="distrito" name="distrito" required disabled>
                                    <option value="">Seleccione un distrito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="facultadEscuelaContainerRegistro">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facultadRegistro">Facultad</label>
                                    <select class="form-control" id="facultadRegistro" name="facultad" >
                                        <option value="">Seleccione una facultad</option>
                                        @foreach($facultades as $facultad)
                                            <option value="{{ $facultad->id }}">{{ $facultad->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="escuelaRegistro">Escuela</label>
                                    <select class="form-control" id="escuelaRegistro" name="escuela"  disabled>
                                        <option value="">Seleccione una escuela</option>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="formRegistro" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!--Fin Registro-->

@push('scripts')
<script>
    function toggleFacultadEscuela(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;
        
        // Find the closest form and then find the role select within that form
        const form = container.closest('form');
        let rolSelect;
        
        // Handle both modals
        if (form.id === 'formUsuarioMasivo') {
            rolSelect = document.getElementById('rolMasivo');
        } else if (form.id === 'formRegistro') {
            rolSelect = document.getElementById('rolRegistro');
        }
        
        if (!rolSelect) return;
        
        const selectedRole = parseInt(rolSelect.value);
        
        // Show/hide based on selected role (2 or 3)
        if (selectedRole === 2 || selectedRole === 3) {
            container.style.display = 'none';
        } else {
            container.style.display = 'block';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize both containers
        toggleFacultadEscuela('facultadEscuelaContainerMasivo');
        toggleFacultadEscuela('facultadEscuelaContainerRegistro');
        
        // Add event listeners for select changes
        document.getElementById('rolMasivo')?.addEventListener('change', function() {
            toggleFacultadEscuela('facultadEscuelaContainerMasivo');
        });
        
        document.getElementById('rolRegistro')?.addEventListener('change', function() {
            toggleFacultadEscuela('facultadEscuelaContainerRegistro');
        });
    });
</script>
@endpush

@endsection

@push('js')
<script src="{{ asset('js/cuadro_registro_user.js') }}"></script>
@endpush

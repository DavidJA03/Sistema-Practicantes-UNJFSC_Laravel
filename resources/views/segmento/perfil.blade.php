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
                    <div class="row">
                        <!-- Fila 1 -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" id="codigo" value="{{ $persona->codigo ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" class="form-control" id="dni" value="{{ $persona->dni ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="text" class="form-control" id="celular" value="{{ $persona->celular ?? '' }}" readonly>
                            </div>
                        </div>

                        <!-- Fila 2 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" value="{{ $persona->nombres ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" value="{{ $persona->apellidos ?? '' }}" readonly>
                            </div>
                        </div>

                        <!-- Fila 3 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo">Correo Institucional</label>
                                <input type="email" class="form-control" id="correo" value="{{ $persona->correo_inst ?? '' }}" readonly>
                            </div>
                        </div>

                        <!-- Fila 4 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <input type="text" class="form-control" id="departamento" value="{{ $persona->departamento ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" class="form-control" id="provincia" value="{{ $persona->provincia ?? '' }}" readonly>
                            </div>
                        </div>

                        <!-- Fila 5 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="distrito">Distrito</label>
                                <input type="text" class="form-control" id="distrito" value="{{ $persona->distrito ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
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
                        <i class="fas fa-user" style="font-size: 255px; color: rgb(123, 145, 229);"></i>
                        <hr>
                        <form action="#" method="POST" enctype="multipart/form-data" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">Subir Foto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('perfEdit');
        const updateBtn = document.getElementById('perfUpdate');
        const formInputs = document.querySelectorAll('#codigo, #dni, #celular, #nombres, #apellidos, #correo, #departamento, #provincia, #distrito');

        // Guarda los valores originales
        const originalValues = {};
        formInputs.forEach(input => {
            originalValues[input.id] = input.value;
        });

        let editing = false;

        editBtn.addEventListener('click', function () {
            editing = !editing; // alterna el estado

            if (editing) {
                // Activar campos
                formInputs.forEach(input => input.removeAttribute('readonly'));
                updateBtn.classList.remove('d-none');
                editBtn.innerHTML = '<i class="fas fa-times"></i> Cancelar';
                editBtn.classList.remove('btn-info');
                editBtn.classList.add('btn-warning');
            } else {
                // Restaurar campos
                formInputs.forEach(input => {
                    input.setAttribute('readonly', true);
                    input.value = originalValues[input.id];
                });
                updateBtn.classList.add('d-none');
                editBtn.innerHTML = '<i class="fas fa-edit"></i> Editar';
                editBtn.classList.remove('btn-warning');
                editBtn.classList.add('btn-info');
            }
        });
    });
</script>
@endpush

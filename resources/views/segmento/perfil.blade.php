@extends('template')
@section('title', 'Perfil')


@push('css')
@endpush



@section('content')
    <div class="container-fluid">
    <p></p>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Datos Personales</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" id="codigo" value="{{ $usuario->codigo ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="dni">Nombres y Apellidos</label>
                                    <input type="text" class="form-control" id="dni" value="{{ $usuario->dni ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" class="form-control" id="celular" value="{{ $usuario->celular ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="celular">Provincia</label>
                                    <input type="text" class="form-control" id="celular" value="{{ $usuario->celular ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular">DNI</label>
                                    <input type="text" class="form-control" id="celular" value="{{ $usuario->celular ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo Institucional</label>
                                    <input type="email" class="form-control" id="correo" value="{{ $usuario->correo ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="provincia">Departamento</label>
                                    <input type="text" class="form-control" id="provincia" value="{{ $usuario->provincia ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="distrito">Distrito</label>
                                    <input type="text" class="form-control" id="distrito" value="{{ $usuario->distrito ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Fotografia</h6>
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
@endpush

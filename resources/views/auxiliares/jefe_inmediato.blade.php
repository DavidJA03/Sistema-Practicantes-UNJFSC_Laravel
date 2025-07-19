@extends('template')
@section('title', 'Jefes Inmediatos')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Jefes</h6>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                            <tr>
                                <th>N°</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>Cargo</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jefes as $index => $jefe)
                            <tr data-docente-id="{{ $jefe->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jefe->dni }}</td>
                                <td>{{ strtoupper($jefe->apellidos . ' ' . $jefe->nombres) }}</td>
                                <td>{{ $jefe->cargo }}</td>
                                <td>{{ $jefe->telefono }}</td>
                                <td>
                                    <button type="button" class="btn btn-mostrar btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalJefeInmediato{{ $jefe->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @if($jefes->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron registros.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($jefes as $jefe)
<div class="modal fade" id="modalJefeInmediato{{ $jefe->id }}" tabindex="-1" role="dialog" aria-labelledby="modalJefeInmediatoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJefeInmediatoLabel">Información del Jefe Inmediato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>DNI:</strong> {{ $jefe->dni }}</p>
                <p><strong>Apellidos y Nombres:</strong> {{ $jefe->apellidos . ' ' . $jefe->nombres }}</p>
                <p><strong>Cargo:</strong> {{ $jefe->cargo }}</p>
                <p><strong>Telefono:</strong> {{ $jefe->telefono }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('js')
@endpush
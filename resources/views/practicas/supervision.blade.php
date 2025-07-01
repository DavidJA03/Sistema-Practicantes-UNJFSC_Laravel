@extends('template')
@section('title', 'Supervision')

@push('css')
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
                            <th>N°</th>
                            <th>Tipo de Práctica</th>
                            <th>Apellidos y Nombres</th>
                            <th>Area</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Tipo de Práctica</th>
                            <th>Apellidos y Nombres</th>
                            <th>Area</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($personas as $index => $persona)
                        <tr data-docente-id="{{ $persona->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $persona->practica->tipo_practica ?? 'No registrado' }}</td>
                            <td>{{ strtoupper($persona->apellidos . ' ' . $persona->nombres) }}</td>
                            <td>{{ $persona->practica->area ?? 'No registrado' }}</td>
                            <td>
                                @if($practica)
                                <button type="button" class="btn btn-mostrar btn-info btn-sm">
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
                            <td colspan="5" class="text-center">No se encontraron registros.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush

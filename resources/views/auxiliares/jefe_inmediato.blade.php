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
                        <tfoot>
                            <tr>
                                <th>N°</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>Cargo</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($jefes as $index => $jefe)
                            <tr data-docente-id="{{ $jefe->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jefe->dni }}</td>
                                <td>{{ strtoupper($jefe->apellidos . ' ' . $jefe->nombres) }}</td>
                                <td>{{ $jefe->cargo }}</td>
                                <td>{{ $jefe->telefono }}</td>
                                <td>
                                    <button type="button" class="btn btn-mostrar btn-info btn-sm">
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
@endsection

@push('js')
@endpush
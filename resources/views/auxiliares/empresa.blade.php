@extends('template')
@section('title', 'Empresas')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Empresas</h6>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                            <tr>
                                <th>N°</th>
                                <th>RUC</th>
                                <th>Nombre de la Empresa</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>N°</th>
                                <th>RUC</th>
                                <th>Nombre de la Empresa</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($empresas as $index => $empresa)
                            <tr data-docente-id="{{ $empresa->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $empresa->ruc }}</td>
                                <td>{{ strtoupper($empresa->nombre) }}</td>
                                <td>{{ $empresa->telefono }}</td>
                                <td>
                                    <button type="button" class="btn btn-mostrar btn-info btn-sm" data-toggle="modal" data-target="#modalVer{{ $empresa->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @if($empresas->isEmpty())
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
</div>

<!-- Modal Ver -->
@foreach ($empresas as $empresa)
<div class="modal fade" id="modalVer{{ $empresa->id }}" tabindex="-1" role="dialog" aria-labelledby="modalVerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerLabel">Información de la Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>RUC:</strong> {{ $empresa->ruc }}</p>
                <p><strong>Nombre:</strong> {{ $empresa->nombre }}</p>
                <p><strong>Telefono:</strong> {{ $empresa->telefono }}</p>
                <p><strong>Direccion:</strong> {{ $empresa->direccion }}</p>
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
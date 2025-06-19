@extends('template')
@section('title', 'Listado de Supervisores')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Supervisores</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                    <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Código</th>
                            <th>Apellidos y Nombres</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
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
                                <button type="button" class="btn btn-mostrar btn-info btn-sm">
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
@endsection

@push('js')
<script src="{{ asset('js/persona_edit.js') }}"></script>
@endpush

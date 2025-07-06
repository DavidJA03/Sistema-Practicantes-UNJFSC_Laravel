@extends('template')

@section('content')

{{-- Alertas con SweetAlert2 --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    });
</script>
@endif
@endpush

<div class="container">
    <h1 class="mb-4">Preguntas</h1>

    <div class="d-flex justify-content-between mb-3">
        <form class="form-inline">
            <input type="text" name="search" class="form-control mr-2" placeholder="Buscar pregunta..." value="{{ request('search') }}">
            <select name="per_page" class="form-control mr-2" onchange="this.form.submit()">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            </select>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <button class="btn btn-success" data-toggle="modal" data-target="#crearModal">
            Nueva Pregunta
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pregunta</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($preguntas as $pregunta)
                <tr>
                    <td>{{ $pregunta->id }}</td>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>
                        @if($pregunta->estado)
                            <span class="badge badge-success">Habilitado</span>
                        @else
                            <span class="badge badge-secondary">Deshabilitado</span>
                        @endif
                    </td>
                    <td>
                        {{-- Botón habilitar/deshabilitar --}}
                        <form action="{{ route('pregunta.update', $pregunta->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="toggle_estado" value="1">
                            <button type="submit" class="btn btn-sm btn-warning">
                                {{ $pregunta->estado ? 'Deshabilitar' : 'Habilitar' }}
                            </button>
                        </form>

                        {{-- Botón que abre el modal eliminar --}}
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminar-{{ $pregunta->id }}">
                            Eliminar
                        </button>

                        {{-- Modal eliminar (dentro del bucle) --}}
                        <div class="modal fade" id="modalEliminar-{{ $pregunta->id }}" tabindex="-1" role="dialog" aria-labelledby="eliminarLabel{{ $pregunta->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="POST" action="{{ route('pregunta.destroy', $pregunta->id) }}" class="modal-content">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Eliminar Pregunta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de eliminar esta pregunta?
                                        <br>
                                        <strong>{{ $pregunta->pregunta }}</strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay preguntas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

{{-- Modal Crear Pregunta --}}
<div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('pregunta.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="crearModalLabel">Nueva Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pregunta</label>
                    <input type="text" name="pregunta" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button ty@extends('template')

@section('title', 'Gestión de Preguntas')

{{-- CSS DataTables --}}
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')

{{-- Alertas con SweetAlert2 --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});
</script>
@endif
@endpush

<div class="container mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Gestión de Preguntas</h6>
        </div>
        <div class="card-body">
            {{-- Botón NUEVA PREGUNTA --}}
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalNuevaPregunta">
                <i class="bi bi-plus-circle"></i> Nueva Pregunta
            </button>

            <div class="table-responsive">
                <table id="tablaPreguntas" class="table table-bordered table-hover">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Pregunta</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($preguntas as $pregunta)
                        <tr>
                            <td>{{ $pregunta->id }}</td>
                            <td>{{ $pregunta->pregunta }}</td>
                            <td>
                                @if($pregunta->estado)
                                    <span class="badge bg-success">Habilitado</span>
                                @else
                                    <span class="badge bg-secondary">Deshabilitado</span>
                                @endif
                            </td>
                            <td>
                                {{-- Botón habilitar/deshabilitar --}}
                                <form action="{{ route('pregunta.update', $pregunta->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="toggle_estado" value="1">
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        {{ $pregunta->estado ? 'Deshabilitar' : 'Habilitar' }}
                                    </button>
                                </form>

                                {{-- Botón eliminar --}}
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar-{{ $pregunta->id }}">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No hay preguntas registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Nueva Pregunta --}}
<div class="modal fade" id="modalNuevaPregunta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('pregunta.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nueva Pregunta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pregunta</label>
                    <input type="text" name="pregunta" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Modales eliminar --}}
@foreach($preguntas as $pregunta)
<div class="modal fade" id="modalEliminar-{{ $pregunta->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('pregunta.destroy', $pregunta->id) }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Pregunta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de eliminar la pregunta?
                <br>
                <strong>{{ $pregunta->pregunta }}</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Confirmar</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection

{{-- JS DataTables --}}
@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#tablaPreguntas').DataTable({
        language: {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });
});
</script>
@endpush
pe="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection

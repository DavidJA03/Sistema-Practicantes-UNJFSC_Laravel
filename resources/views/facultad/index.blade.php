@extends('template')

@section('title', 'Gestión de Facultades')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')

{{-- SweetAlert --}}
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

<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Facultades</h6>
            <!-- Botón para abrir el modal de nueva facultad -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevaFacultadModal">
                <i class="bi bi-plus-circle"></i> Nueva Facultad
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaFacultades" class="table table-bordered table-hover">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Facultad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($facultades as $facultad)
                        <tr>
                            <td>{{ $facultad->id }}</td>
                            <td class = "text-left">{{ $facultad->name }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar-{{ $facultad->id }}">
                                    <i class="bi bi-pencil-square"></i> 
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar-{{ $facultad->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nueva Facultad -->
<div class="modal fade" id="nuevaFacultadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('facultad.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nueva Facultad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modales Editar y Eliminar -->
@foreach($facultades as $facultad)
<!-- Modal Editar -->
<div class="modal fade" id="modalEditar-{{ $facultad->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('facultad.update', $facultad->id) }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Editar Facultad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ $facultad->name }}" required>
                    @error('name')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar-{{ $facultad->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('facultad.destroy', $facultad->id) }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Facultad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de eliminar esta facultad?
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

@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#tablaFacultades').DataTable({
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

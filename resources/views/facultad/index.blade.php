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

<div class="container mt-4">
    <h1 class="text-center">LISTA DE FACULTADES</h1>

    <form method="GET" action="{{ route('facultad.index') }}" class="form-inline mb-3 d-flex justify-content-between">
    <input type="text" name="search" class="form-control w-25" placeholder="Buscar..." value="{{ request('search') }}">

    <select name="cantidad" class="form-control w-auto" onchange="this.form.submit()">
        <option value="5" {{ request('cantidad') == 5 ? 'selected' : '' }}>5 registros</option>
        <option value="10" {{ request('cantidad') == 10 ? 'selected' : '' }}>10 registros</option>
        <option value="25" {{ request('cantidad') == 25 ? 'selected' : '' }}>25 registros</option>
        <option value="50" {{ request('cantidad') == 50 ? 'selected' : '' }}>50 registros</option>
    </select>
</form>


    <!-- Botón para abrir el modal de nueva facultad -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#nuevaFacultadModal">
        <i class="bi bi-plus-circle"></i> Nueva Facultad
    </button>

    <!-- Tabla de facultades -->
    <table class="table table-bordered table-hover">
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
                <td>{{ $facultad->name }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditar-{{ $facultad->id }}">
                        <i class="bi bi-pencil-square"></i> Editar
                    </button>

                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminar-{{ $facultad->id }}">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $facultades->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal: Nueva Facultad -->
<div class="modal fade" id="nuevaFacultadModal" tabindex="-1" role="dialog" aria-labelledby="nuevaFacultadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('facultad.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nueva Facultad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modales: Editar y Eliminar (fuera del tbody) -->
@foreach($facultades as $facultad)
<!-- Modal Editar -->
<div class="modal fade" id="modalEditar-{{ $facultad->id }}" tabindex="-1" role="dialog" aria-labelledby="editarLabel{{ $facultad->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('facultad.update', $facultad->id) }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Editar Facultad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar-{{ $facultad->id }}" tabindex="-1" role="dialog" aria-labelledby="eliminarLabel{{ $facultad->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('facultad.destroy', $facultad->id) }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Facultad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de eliminar esta facultad?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Confirmar</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@endsection

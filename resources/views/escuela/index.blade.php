@extends('template')

@section('content')

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
    <h1 class="text-center">LISTA DE ESCUELAS</h1>

    <form method="GET" class="d-flex justify-content-between align-items-center mb-3">
        <select name="facultad_id" class="form-control w-25 mr-2" onchange="this.form.submit()">
            <option value="">-- Filtrar por Facultad --</option>
            @foreach ($facultades as $facultad)
                <option value="{{ $facultad->id }}" {{ request('facultad_id') == $facultad->id ? 'selected' : '' }}>
                    {{ $facultad->name }}
                </option>
            @endforeach
        </select>

        <select name="cantidad" class="form-control w-auto" onchange="this.form.submit()">
            <option value="5" {{ request('cantidad') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('cantidad') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('cantidad') == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ request('cantidad') == 50 ? 'selected' : '' }}>50</option>
        </select>
    </form>

    <!-- BOTÓN NUEVA ESCUELA -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#nuevaEscuelaModal">
        <i class="bi bi-plus-circle"></i> Nueva Escuela
    </button>

    <!-- Modal Nueva Escuela -->
    <div class="modal fade" id="nuevaEscuelaModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('escuela.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nueva Escuela</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="facultad_id">Facultad</label>
                        <select name="facultad_id" class="form-control" required>
                            <option value="">-- Selecciona una Facultad --</option>
                            @foreach($facultades as $facultad)
                                <option value="{{ $facultad->id }}">{{ $facultad->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre de la Escuela</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Facultad</th>
                    <th>Nombre de la Escuela</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($escuelas as $escuela)
                <tr>
                    <td>{{ $escuela->id }}</td>
                    <td>{{ $escuela->facultad->name ?? 'Sin Facultad' }}</td>
                    <td>{{ $escuela->name }}</td>
                    <td>
                        <!-- Botón Editar -->
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editarEscuelaModal-{{ $escuela->id }}">
                            <i class="bi bi-pencil-square"></i> Editar
                        </button>

                        <!-- Modal Editar Escuela -->
                        <div class="modal fade" id="editarEscuelaModal-{{ $escuela->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('escuela.update', $escuela->id) }}" method="POST" class="modal-content">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Escuela</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="facultad_id">Facultad</label>
                                            <select name="facultad_id" class="form-control" required>
                                                @foreach($facultades as $facultad)
                                                    <option value="{{ $facultad->id }}" {{ $facultad->id == $escuela->facultad_id ? 'selected' : '' }}>
                                                        {{ $facultad->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombre de la Escuela</label>
                                            <input type="text" name="name" class="form-control" value="{{ $escuela->name }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-warning">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Botón Eliminar -->
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmModal-{{ $escuela->id }}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>

                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="confirmModal-{{ $escuela->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('escuela.destroy', $escuela->id) }}" method="POST" class="modal-content">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de eliminar la escuela <strong>{{ $escuela->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $escuelas->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

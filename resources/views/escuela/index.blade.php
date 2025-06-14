@extends('template')

@section('content')

@if(session('success'))
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    @endpush
@endif

<div class="container mt-4" align="center">
    <h1>LISTA DE ESCUELAS</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('escuela.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Escuela
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Facultad</th>
                    <th>Nombre de la Escuela</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($escuelas as $escuela)
                <tr>
                    <td>{{ $escuela->id }}</td>
                    <td>{{ $escuela->facultad->name ?? 'Sin facultad' }}</td>
                    <td>{{ $escuela->name }}</td>
                    <td>
                        <form action="{{ route('escuela.edit', ['escuela' => $escuela->id]) }}" method="GET" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning me-2">
                                <i class="bi bi-pencil-square"></i> Editar
                            </button>
                        </form>

                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $escuela->id }}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>

                <!-- Modal de confirmación -->
                <div class="modal fade" id="confirmModal-{{ $escuela->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Mensaje de Confirmación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            ¿Seguro que quieres eliminar esta Escuela?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <form action="{{ route('escuela.destroy', ['escuela' => $escuela->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Confirmar</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

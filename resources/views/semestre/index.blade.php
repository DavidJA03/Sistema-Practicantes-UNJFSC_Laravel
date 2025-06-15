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
    <h1>LISTA DE SEMESTRES</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('semestre.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Semestre
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Código</th>
                    <th scope="col">Ciclo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($semestres as $semestre)
                <tr>
                    <td class="text-center align-middle" style="width: 80px;">
                        {{ $semestre->id }}
                    </td>
                    <td class="align-middle">
                        {{ $semestre->codigo }}
                    </td>
                    <td class="align-middle">
                        {{ $semestre->ciclo }}
                    </td>
                    <td class="text-center align-middle" style="width: 200px;">
                        <div class="d-flex justify-content-center gap-2">
                            {{-- Botón Editar --}}
                            <form action="{{ route('semestre.edit', ['semestre' => $semestre->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </button>
                            </form>

                            {{-- Botón Eliminar --}}
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $semestre->id }}">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Modales de confirmación para eliminar --}}
        @foreach($semestres as $semestre)
        <div class="modal fade" id="confirmModal-{{ $semestre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $semestre->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel-{{ $semestre->id }}">Mensaje de Confirmación</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quieres eliminar este semestre?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <form action="{{ route('semestre.destroy', ['semestre' => $semestre->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection

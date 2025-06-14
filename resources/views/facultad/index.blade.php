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



<div class="container mt-4" align = center>
    <h1>LISTA DE FACULTADES</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- BOTÓN NUEVA FACULTAD -->
        <a href="{{ route('facultad.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Facultad
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre de la Facultad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($facultades as $facultad)
                <tr>
                    <td class="text-center align-middle" style="width: 80px;">
                        {{ $facultad->id }}
                    </td>
                    <td class="align-middle">
                        {{ $facultad->name }}
                    </td>
                    <td class="text-center align-middle" style="width: 200px;">
                        <div class="d-flex justify-content-center gap-2">
                            {{-- Botón Editar --}}
                            <form action="{{ route('facultad.edit', ['facultad' => $facultad->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </button>
                            </form>

                            {{-- Botón Eliminar --}}
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $facultad->id }}">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </div>
                    </td>
                </tr>

                
                @endforeach
            </tbody>
        </table>
        @foreach($facultades as $facultad)
<!-- Modal fuera del <table> -->
<div class="modal fade" id="confirmModal-{{ $facultad->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $facultad->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel-{{ $facultad->id }}">Mensaje de Confirmación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Seguro que quieres eliminar esta Facultad?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <form action="{{ route('facultad.destroy', ['facultad' => $facultad->id]) }}" method="POST">
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
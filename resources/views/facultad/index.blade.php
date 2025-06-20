@extends('template')

@section('content')

{{-- Siempre cargar el JS --}}
@push('scripts')
    <script src="{{ asset('js/facultad.js') }}"></script>
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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" id="filtroFacultad" class="form-control w-25" placeholder="Buscar...">
        <select class="form-select w-auto" id="perPageSelect">
            <option value="5" selected>5 registros</option>
            <option value="10">10 registros</option>
            <option value="25">25 registros</option>
            <option value="50">50 registros</option>
        </select>
    </div>

    <!-- BOTÓN NUEVA FACULTAD -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevaFacultadModal">
        <i class="bi bi-plus-circle"></i> Nueva Facultad
    </button>

    <!-- MODAL NUEVA FACULTAD -->
    <div class="modal fade" id="nuevaFacultadModal" tabindex="-1" aria-labelledby="nuevaFacultadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formNuevaFacultad">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevaFacultadLabel">Registrar Nueva Facultad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de la Facultad</label>
                            <input type="text" name="name" class="form-control" id="name">
                            <div class="text-danger" id="nameError"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div id="tablaFacultades">
        @include('facultad.partials.table', ['facultades' => $facultades])
    </div>

    <!-- Modales de Confirmación -->
    @foreach($facultades as $facultad)
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
                        <form action="{{ route('facultad.destroy', ['facultad' => $facultad->id]) }}" method="POST" class="form-eliminar" data-id="{{ $facultad->id }}">
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
@endsection

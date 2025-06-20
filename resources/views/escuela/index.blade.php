@extends('template')

@section('content')

@push('scripts')
<script src="{{ asset('js/escuela.js') }}"></script>
@if(session('success'))
    
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
    
@endif
@endpush

<div class="container mt-4" align="center">
    <h1>LISTA DE ESCUELAS</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('escuela.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Escuela
        </a>
    </div>
    <div class="d-flex justify-content-start mb-3">
    <select id="filtroFacultad" class="form-select w-auto">
        <option value="">-- Filtrar por Facultad --</option>
        @foreach ($facultades as $facultad)
            <option value="{{ $facultad->id }}">{{ $facultad->name }}</option>
        @endforeach
    </select>
    <button id="btnLimpiarFiltro" class="btn btn-outline-secondary ms-2">
    Limpiar Filtro
</button>

</div>
<div id = "#tablaEscuelas">
<p id="contadorEscuelas" class="text-muted">
    Mostrando {{ $escuelas->count() }} de {{ $escuelas->total() }} escuelas
</p>
    </div>


    <div class="table-responsive">
        <div id="tablaEscuelas">
    @include('escuela.partials.table', ['escuelas' => $escuelas])
</div>

    </div>
</div>

@endsection

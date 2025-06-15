@extends('template')

@section('content')

<div class="container mt-4">
    <h2>Editar Escuela</h2>

    <form action="{{ route('escuela.update', ['escuela' => $escuela->id]) }}" method="POST">
        @method('PATCH')
        @csrf

        <!-- Campo nombre -->
        <div class="mb-3">
            <label for="name" class="form-label">Nuevo Nombre de la Escuela</label>
            <input type="text" class="form-control" id="name" name="name" 
                   placeholder="Ej: Escuela de Ingeniería de Sistemas"
                   value="{{ old('name', $escuela->name) }}">
            @error('name')
                <small class="text-danger">{{ '*' . $message }}</small>
            @enderror
        </div>

        <!-- Campo facultad -->
        <div class="mb-3">
            <label for="facultad_id" class="form-label">Facultad a la que pertenece</label>
            <select name="facultad_id" id="facultad_id" class="form-select">
                <option value="">Seleccione una facultad</option>
                @foreach($facultades as $facultad)
                    <option value="{{ $facultad->id }}" 
                        {{ old('facultad_id', $escuela->facultad_id) == $facultad->id ? 'selected' : '' }}>
                        {{ $facultad->name }}
                    </option>
                @endforeach
            </select>
            @error('facultad_id')
                <small class="text-danger">{{ '*' . $message }}</small>
            @enderror
        </div>

        <!-- Botones -->
        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Actualizar
            </button>

            <a href="{{ route('escuela.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </div>
    </form>
</div>

@endsection

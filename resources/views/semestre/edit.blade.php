@extends('template')

@section('content')

<div class="container mt-4">
    <h2>Editar Semestre</h2>

    <form action="{{ route('semestre.update', ['semestre' => $semestre->id]) }}" method="post">
        @method('PATCH')
        @csrf

        <div class="mb-3">
            <label for="codigo" class="form-label">Código del Semestre</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ej: 2025-I"
                value="{{ old('codigo', $semestre->codigo) }}">
            @error('codigo')
                <small class="text-danger">{{ '*'.$message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ciclo" class="form-label">Ciclo</label>
            <input type="text" class="form-control" id="ciclo" name="ciclo" placeholder="Ej: Primer Ciclo"
                value="{{ old('ciclo', $semestre->ciclo) }}">
            @error('ciclo')
                <small class="text-danger">{{ '*'.$message }}</small>
            @enderror
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Actualizar
            </button>

            <a href="{{ route('semestre.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </div>
    </form>
</div>

@endsection

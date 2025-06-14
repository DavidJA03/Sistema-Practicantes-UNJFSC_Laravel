@extends('template')

@section('content')

<div class="container mt-4">
    <h2>Editar Facultad</h2>

    <form action = "{{ route('facultad.update', ['facultad'=>$facultad->id])}}" method = "post">
        @method('PATCH')
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nuevo Nombre de la Facultad</label>
            <input type="text" class="form-control" id="name" name = "name" placeholder="Ej: Facultad de Ingeniería"
            value = "{{ old('name', $facultad->name) }}">
            @error('name')
            <small class = "text-danger">
                {{'*'.$message}}
            </small>
            @enderror
        </div>

        <div class = "col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Actualizar
            </button>
        
        

        <a href="{{ route('facultad.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
        </div>
    </form>
</div>
    

@endsection
@extends('template')

@section('content')

<div class="container mt-4">
    <h2>Registrar Nueva Facultad</h2>

    <form action = "{{ route('facultad.store')}}" method = "post">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Facultad</label>
            <input type="text" class="form-control" id="name" name = "name" placeholder="Ej: Facultad de Ingeniería">
            @error('name')
            <small class = text-danger>
                {{'*'.$message}}
            </small>
            @enderror
        </div>

        <div class = "col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Guardar
            </button>
        
        

        <a href="{{ route('facultad.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
        </div>
    </form>
</div>
    

@endsection
@extends('layouts.app') {{-- tu plantilla base si tienes una --}}

@section('title', 'Página no encontrada')

@section('content')
    <div class="text-center mt-5">
        <h1>404</h1>
        <p>La página que buscas no se encuentra disponible.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
@endsection

@extends('template')
@section('title', 'Panel')

@push('css')
{{-- Puedes agregar aquí estilos específicos --}}
@endpush

@section('content')

    @php
        $rol = auth()->user()->persona?->rol_id;
    @endphp

    @if($rol == 1)
        @includeIf('dashboard.admin')
    @elseif($rol == 2)
        @includeIf('dashboard.supervisor')
    @elseif($rol == 3)
        @includeIf('dashboard.docente')
    @else
    @elseif($rol == 3)
        @includeIf('dashboard.estudiante')
    @else
        <p>No tienes acceso a ningún panel.</p>
    @endif

@endsection

@push('js')
@endpush

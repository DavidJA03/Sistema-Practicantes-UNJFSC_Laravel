@extends('template')
@section('title', 'Desarrollo')

@push('css')
@endpush

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-uppercase">Detalles de la Práctica</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                        <label for="docente">Docente Titular: </label>
                        <label for="docente">Ing. Claros</label>
                </div>
                <div class="col-md-6">
                        <label for="docente">Supervisor Asignado: </label>
                        <label for="docente">Ing. Claros</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                        <label for="estado">Estado: </label>
                        <label for="estado">Activo</label>
                </div>
                <div class="col-md-6">
                        <label for="estado">Ultima Modificación: </label>
                        <label for="estado">21/06/2025</label>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $etapa = $practicaData->estado;
@endphp

@if ($etapa == 1)
    @include('practicas.desa_E1')
@elseif ($etapa == 2)
    @include('practicas.desa_E2')
@elseif ($etapa == 3)
    @include('practicas.desa_E3')
@elseif ($etapa == 4)
    @include('practicas.desa_E4')
@endif


@endsection

@push('js')
@endpush

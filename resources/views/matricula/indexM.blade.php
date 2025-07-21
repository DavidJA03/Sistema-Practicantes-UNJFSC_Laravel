@extends('template')
@section('title', 'Matriculación')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .check-icon {
            font-size: 24px;
            color: green;
            margin-left: 5px;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Ficha de Matrícula -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="py-3 text-center mt-3">
                    <h4 class="text-primary font-weight-bold">Ficha de Matrícula    </h4>

                    @if(isset($matricula) && $matricula->ruta_ficha)
                        <div class="mt-3 text-center">
                            <p><strong>Estado:</strong> 
                                <span class="badge bg-{{ $matricula->estado_ficha == 'completo' ? 'success' : 'info' }}">
                                    {{ ucfirst($matricula->estado_ficha) }}
                                </span>
                                @if($matricula->estado_ficha == 'Completo')
                                    <span class="check-icon">&#10004;</span>
                                @endif
                            </p>
                            <a href="{{ asset($matricula->ruta_ficha) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                Ver PDF
                            </a>
                            @if($matricula->estado_ficha != 'Completo')
                                <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalFicha">
                                    Editar
                                </button>
                            @endif
                        </div>
                    @else
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalFicha">
                            Cargar Ficha de Matrícula
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Récord Académico -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="py-3 text-center mt-3">
                    <h4 class="text-primary font-weight-bold">Récord Académico</h4>

                    @if(isset($matricula) && $matricula->ruta_record)
                        <div class="mt-3 text-center">
                            <p><strong>Estado:</strong>
                                <span class="badge bg-{{ $matricula->estado_record == 'completo' ? 'success' : 'info' }}">
                                    {{ ucfirst($matricula->estado_record) }}
                                </span>
                                @if($matricula->estado_record == 'Completo')
                                    <span class="check-icon">&#10004;</span>
                                @endif
                            </p>
                            <a href="{{ asset($matricula->ruta_record) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                Ver PDF
                            </a>
                            @if($matricula->estado_record != 'Completo')
                                <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalRecord">
                                    Editar
                                </button>
                            @endif
                        </div>
                    @else
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalRecord">
                            Cargar Récord Académico
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ficha de Matrícula -->
<div class="modal fade" id="modalFicha" tabindex="-1" aria-labelledby="modalFichaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('subir.ficha') }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        <input type="hidden" name="persona_id" value="{{ $persona->id }}">
        <div class="modal-header">
            <h5 class="modal-title" id="modalFichaLabel">Subir Ficha de Matrícula</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <input type="file" name="ficha" accept="application/pdf" required class="form-control">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Subir</button>
        </div>
    </form>
  </div>
</div>

<!-- Modal Récord Académico -->
<div class="modal fade" id="modalRecord" tabindex="-1" aria-labelledby="modalRecordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('subir.record') }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        <input type="hidden" name="persona_id" value="{{ $persona->id }}">
        <div class="modal-header">  
            <h5 class="modal-title" id="modalRecordLabel">Subir Récord Académico</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <input type="file" name="record" accept="application/pdf" required class="form-control">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Subir</button>
        </div>
    </form>
  </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush

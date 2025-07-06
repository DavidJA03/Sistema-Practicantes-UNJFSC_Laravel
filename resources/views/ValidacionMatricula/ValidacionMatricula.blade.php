@extends('template')
@section('title', 'Listado de Supervisores')

@push('css')
@endpush

@section('content')
<style>
  .tabla-wrapper {
    max-height: 260px;
    overflow: auto;
  }
  .tabla-wrapper table {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
  }
  .tabla-wrapper thead th {
    position: sticky;
    top: 0;
    background-color: #f8f9fa;
    z-index: 10;
  }
</style>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Supervisores</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Estudiante</th>
              <th>Semestre</th>
              <th>Escuela</th>
              <th>F Matricula</th>
              <th>R Academico</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($estudiantes as $index => $grupo)
<tr>
  <td>{{ $grupo->id }}</td>
  <td>{{ $grupo->estudiante->nombres ?? 'Sin estudiante' }}</td>
  <td>{{ $grupo->grupoPractica->semestre->codigo ?? 'Sin semestre' }}</td>
  <td>{{ $grupo->grupoPractica->escuela->name ?? 'Sin escuela' }}</td>

  <td>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalFicha{{ $grupo->id }}">
      F Matricula
    </button>
  </td>

  <td>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalRecord{{ $grupo->id }}">
      R Academico
    </button>
  </td>
</tr>

<!-- Modal Ficha de Matrícula -->
<div class="modal fade" id="modalFicha{{ $grupo->id }}" tabindex="-1" aria-labelledby="modalFichaLabel{{ $grupo->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg rounded">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalFichaLabel{{ $grupo->id }}">Ficha de Matrícula</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        @if(($grupo->estudiante->matricula->estado_ficha ?? '') == 'Completo')
            <div class="alert alert-success d-flex justify-content-between align-items-center">
            <strong>Estado:</strong> Completo
            @if(isset($grupo->estudiante->matricula->ruta_ficha))
                <a href="{{ asset($grupo->estudiante->matricula->ruta_ficha) }}" class="btn btn-outline-dark btn-sm" target="_blank">
                Ver PDF
                </a>
            @else
                <div class="alert alert-warning m-0 p-2 rounded-pill">Sin PDF disponible</div>
            @endif
            </div>
        @else
            @if(isset($grupo->estudiante->matricula->ruta_ficha))
            <form action="{{ route('actualizar.estado.ficha', $grupo->estudiante->matricula->id ?? 0) }}" method="POST">
                @csrf
                <div class="form-group">
                <label for="estadoFicha{{ $grupo->id }}" class="font-weight-bold">Estado</label>
                <select name="estado_ficha" id="estadoFicha{{ $grupo->id }}" class="form-control rounded-pill">
                    <option value="En proceso" {{ ($grupo->estudiante->matricula->estado_ficha ?? '') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                    <option value="Corregir" {{ ($grupo->estudiante->matricula->estado_ficha ?? '') == 'Corregir' ? 'selected' : '' }}>Corregir</option>
                    <option value="Completo" {{ ($grupo->estudiante->matricula->estado_ficha ?? '') == 'Completo' ? 'selected' : '' }}>Completo</option>
                </select>
                </div>

                <div class="d-flex justify-content-between mt-3">
                <a href="{{ asset( $grupo->estudiante->matricula->ruta_ficha) }}" class="btn btn-outline-success" target="_blank">
                    Ver PDF
                </a>
                <button type="submit" class="btn btn-success">Guardar cambios</button>
                </div>
            </form>
            @else
            <div class="alert alert-warning text-center rounded-pill py-2">
                <strong>Sin PDF disponible</strong>
            </div>
            @endif
        @endif
        </div>

    </div>
  </div>
</div>


<!-- Modal Récord Académico -->
<div class="modal fade" id="modalRecord{{ $grupo->id }}" tabindex="-1" aria-labelledby="modalRecordLabel{{ $grupo->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg rounded">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="modalRecordLabel{{ $grupo->id }}">Récord Académico</h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        @if(($grupo->estudiante->matricula->estado_record ?? '') == 'Completo')
            <div class="alert alert-warning d-flex justify-content-between align-items-center">
            <strong>Estado:</strong> Completo
            @if(isset($grupo->estudiante->matricula->ruta_record))
                <a href="{{ asset($grupo->estudiante->matricula->ruta_record) }}" class="btn btn-outline-dark btn-sm" target="_blank">
                Ver PDF
                </a>
            @else
                <div class="alert alert-danger m-0 p-2 rounded-pill">Sin PDF disponible</div>
            @endif
            </div>
        @else
            @if(isset($grupo->estudiante->matricula->ruta_record))
            <form action="{{ route('actualizar.estado.record', $grupo->estudiante->matricula->id ?? 0) }}" method="POST">
                @csrf
                <div class="form-group">
                <label for="estadoRecord{{ $grupo->id }}" class="font-weight-bold">Estado</label>
                <select name="estado_record" id="estadoRecord{{ $grupo->id }}" class="form-control rounded-pill">
                    <option value="En proceso" {{ ($grupo->estudiante->matricula->estado_record ?? '') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                    <option value="Observado" {{ ($grupo->estudiante->matricula->estado_record ?? '') == 'Observado' ? 'selected' : '' }}>Observado</option>
                    <option value="Completo" {{ ($grupo->estudiante->matricula->estado_record ?? '') == 'Completo' ? 'selected' : '' }}>Completo</option>
                </select>
                </div>

                <div class="d-flex justify-content-between mt-3">
                <a href="{{ asset($grupo->estudiante->matricula->ruta_record) }}" class="btn btn-outline-warning" target="_blank">
                    Ver PDF
                </a>
                <button type="submit" class="btn btn-warning">Guardar cambios</button>
                </div>
            </form>
            @else
            <div class="alert alert-danger text-center rounded-pill py-2">
                <strong>Sin PDF disponible</strong>
            </div>
            @endif
        @endif
        </div>

    </div>
  </div>
</div>
@endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
@endpush

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
              <th>Docente</th>
              <th>Semestre</th>
              <th>Escuela</th>
              <th>Nombre de grupo</th>
              <th>Agregar alumno</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($grupos_practica as $index => $grupo)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $grupo->docente->nombres }} {{ $grupo->docente->apellidos }}</td>
              <td>{{ $grupo->semestre->codigo }}</td>
              <td>{{ $grupo->escuela->name }}</td>
              <td>{{ $grupo->nombre_grupo }}</td>
              <td>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEditar{{ $grupo->id }}">
                  Asignar alumno
                </button>
              </td>
              <td class="text-center">
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalVer{{ $grupo->id }}">
                  <i class="fas fa-eye"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- MODALES POR CADA GRUPO -->
@foreach($grupos_practica as $grupo)
<!-- Modal Asignar alumnos -->
<div class="modal fade" id="modalEditar{{ $grupo->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content border-0 shadow-lg rounded-lg">
      <form method="POST" action="{{ route('grupos.asignarAlumnos') }}">
        @csrf
        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="fas fa-user-plus mr-2"></i> Asignar Alumnos al Grupo: <strong>{{ $grupo->nombre_grupo }}</strong></h5>
          <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body px-4">
          <div class="form-group">

            {{-- Lista de supervisores ya asignados a la escuela --}}
{{-- Lista de supervisores ya asignados a la escuela --}}
{{-- Supervisor Asignado --}}
<div id="supervisor-asignado-{{ $grupo->id }}" class="mb-3 border p-3 rounded shadow-sm bg-white">
  <label class="font-weight-bold mb-2">Supervisor Asignado</label>

  <select class="form-control custom-select mb-2" name="id_supervisor" id="select-supervisor-{{ $grupo->id }}">

    @php
      $docente3 = \App\Models\Persona::where('rol_id', 3)
          ->whereHas('grupo_estudiantes2.grupo', function ($query) use ($grupo) {
              $query->where('id_escuela', $grupo->id_escuela);
          })
          ->get();
    @endphp

    @foreach($docente3 as $docente)
      <option value="{{ $docente->id }}" {{ $docente->id == $grupo->id_docente ? 'selected' : '' }}>
        {{ $docente->nombres }} {{ $docente->apellidos }}
      </option>
    @endforeach 
  </select>

  <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick="mostrarNuevoSupervisor({{ $grupo->id }})">
    Asignar nuevo supervisor
  </button>
</div>

{{-- Nueva Asignación de Supervisor --}}
<div id="nuevo-supervisor-{{ $grupo->id }}" class="mb-3 border p-3 rounded shadow-sm bg-light" style="display: none;">
  <label class="font-weight-bold mb-2">Asignar Nuevo Supervisor</label>

  @if($docente2->isEmpty())
    <div class="alert alert-warning text-center mb-2">
      No hay supervisores disponibles
    </div>
  @else
    <select class="form-control custom-select mb-2" name="id_supervisor" id="select-nuevo-supervisor-{{ $grupo->id }}" disabled>

      @foreach($docente2 as $docente)
        <option value="{{ $docente->id }}" {{ $docente->id == $grupo->id_docente ? 'selected' : '' }}>
          {{ $docente->nombres }} {{ $docente->apellidos }}
        </option>
      @endforeach 
    </select>
  @endif

  <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="cancelarNuevoSupervisor({{ $grupo->id }})">
    Cancelar
  </button>
</div>



          </div>
          <div class="form-group">
            <div class="card-header my-1">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Alumnos</h6>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control buscar-estudiante" data-grupo="{{ $grupo->id }}" placeholder="🔍 Buscar...">
                </div>
              </div>
            </div>
            <div class="tabla-wrapper border rounded">
              <table class="table table-hover table-sm mb-0 tabla-estudiantes" id="dataTable" data-grupo="{{ $grupo->id }}">
                <thead class="thead-light">
                  <tr>
                    <th class="text-center"><input type="checkbox" class="check-all" data-grupo="{{ $grupo->id }}"></th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Escuela</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $estudiantesAsignados = \App\Models\grupo_estudiante::pluck('id_estudiante')->toArray();
                    $estudiantesGrupo = \App\Models\Persona::with('escuela')
                        ->where('rol_id', 4)
                        ->where('id_escuela', $grupo->id_escuela)
                        ->whereNotIn('id',  $estudiantesAsignados)
                        ->get();
                @endphp
                  @foreach($estudiantesGrupo as $estudiante)
                  <tr>
                    <td class="text-center"><input type="checkbox" name="estudiantes[]" value="{{ $estudiante->id }}" class="check-estudiante" data-grupo="{{ $grupo->id }}"></td>
                    <td>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</td>
                    <td>{{ $estudiante->codigo }}</td>
                    <td>{{ $estudiante->escuela->name ?? 'Sin escuela' }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer py-1">
          <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Asignar Alumnos</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Ver grupo -->
<div class="modal fade" id="modalVer{{ $grupo->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content border-0 shadow rounded">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Detalles del Grupo</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p><strong>Nombre del grupo:</strong> {{ $grupo->nombre_grupo }}</p>
        <p><strong>Docente:</strong> {{ $grupo->docente->nombres }} {{ $grupo->docente->apellidos }}</p>
        <p><strong>Semestre:</strong> {{ $grupo->semestre->codigo }}</p>
        <p><strong>Escuela:</strong> {{ $grupo->escuela->name }}</p>
        <div class="card-header my-1">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h6 class="m-0 font-weight-bold text-primary text-uppercase">Estudiantes asignados</h6>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control buscar-estudiante-asignado" data-grupo="{{ $grupo->id }}" placeholder="🔍 Buscar...">
            </div>
          </div>
        </div>
        @php
        $estudiantesAsignados = \App\Models\grupo_estudiante::with('estudiante')->where('id_grupo_practica', $grupo->id)->get();
        @endphp
        @if($estudiantesAsignados->isEmpty())
          <p class="text-muted">No hay estudiantes asignados a este grupo.</p>
        @else
          <div class="tabla-wrapper table-responsive">
            <table class="table table-bordered table-sm tabla-estudiantes-asignados" id="tablaAsignados{{ $grupo->id }}">
              <thead class="thead-light">
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Código</th>
                  <th>Escuela</th>
                  <th>Supervisor</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($estudiantesAsignados as $index => $registro)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $registro->estudiante->nombres }} {{ $registro->estudiante->apellidos }}</td>
                  <td>{{ $registro->estudiante->codigo }}</td>
                  <td>{{ $registro->estudiante->escuela->name ?? 'Sin escuela' }}</td>
                  <td>{{ $registro->supervisor?->nombres ?? 'Sin supervisor' }}</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-sm abrir-eliminar"
                        data-nombre="{{ $registro->estudiante->nombres }} {{ $registro->estudiante->apellidos }}"
                        data-grupo="{{ $grupo->nombre_grupo }}"
                        data-url="{{ route('grupos.eliminarAsignado', $registro->id) }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- MODAL ELIMINAR GLOBAL -->
<div class="modal fade" id="modalConfirmarEliminar" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 2000;">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 shadow rounded">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">
          <i class="fas fa-exclamation-triangle"></i> Confirmar eliminación
        </h5>
      </div>
      <div class="modal-body">
        <p id="textoModalEliminar"></p>
      </div>
      <div class="modal-footer">
        <form id="formEliminarAsignado" method="GET">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Eliminar
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modalConfirmarEliminar').modal('hide')">
            <i class="fas fa-times"></i> Cancelar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function mostrarNuevoSupervisor(grupoId) {
    document.getElementById(`supervisor-asignado-${grupoId}`).style.display = 'none';
    document.getElementById(`nuevo-supervisor-${grupoId}`).style.display = 'block';

    const nuevoSelect = document.getElementById(`select-nuevo-supervisor-${grupoId}`);
    if (nuevoSelect) {
        nuevoSelect.disabled = false;
    }
  }

  function cancelarNuevoSupervisor(grupoId) {
    document.getElementById(`nuevo-supervisor-${grupoId}`).style.display = 'none';
    document.getElementById(`supervisor-asignado-${grupoId}`).style.display = 'block';

    const nuevoSelect = document.getElementById(`select-nuevo-supervisor-${grupoId}`);
    if (nuevoSelect) {
        nuevoSelect.disabled = true;
    }
  }
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("JS cargado directamente sin stack");

    // FILTRO estudiantes NO asignados
    document.querySelectorAll('.buscar-estudiante').forEach(function(input){
        input.addEventListener('keyup', function(){
            let valor = this.value.toLowerCase();
            let grupoId = this.dataset.grupo;

            document.querySelectorAll(`.tabla-estudiantes[data-grupo="${grupoId}"] tbody tr`).forEach(function(tr){
                let textoFila = tr.textContent.toLowerCase();
                tr.style.display = textoFila.includes(valor) ? '' : 'none';
            });
        });
    });

    // FILTRO estudiantes YA asignados
    document.querySelectorAll('.buscar-estudiante-asignado').forEach(function(input){
        input.addEventListener('keyup', function(){
            let valor = this.value.toLowerCase();
            let grupoId = this.dataset.grupo;

            document.querySelectorAll(`#tablaAsignados${grupoId} tbody tr`).forEach(function(tr){
                let textoFila = tr.textContent.toLowerCase();
                tr.style.display = textoFila.includes(valor) ? '' : 'none';
            });
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("JS cargado sin duplicados");

    // FILTRO estudiantes NO asignados
    document.querySelectorAll('.buscar-estudiante').forEach(function(input){
        input.addEventListener('keyup', function(){
            let grupoId = this.dataset.grupo;
            let valor = this.value.toLowerCase();
            document.querySelectorAll(`.tabla-estudiantes[data-grupo="${grupoId}"] tbody tr`).forEach(function(tr){
                tr.style.display = tr.textContent.toLowerCase().includes(valor) ? '' : 'none';
            });
        });
    });

    // FILTRO estudiantes YA asignados
    document.querySelectorAll('.buscar-estudiante-asignado').forEach(function(input){
        input.addEventListener('keyup', function(){
            let grupoId = this.dataset.grupo;
            let valor = this.value.toLowerCase();
            let tabla = document.getElementById(`tablaAsignados${grupoId}`);
            if (tabla) {
                tabla.querySelectorAll('tbody tr').forEach(function(tr){
                    tr.style.display = tr.textContent.toLowerCase().includes(valor) ? '' : 'none';
                });
            }
        });
    });

    // CHECK ALL
    document.querySelectorAll('.check-all').forEach(function(checkbox){
        checkbox.addEventListener('change', function(){
            let grupoId = this.dataset.grupo;
            document.querySelectorAll(`.check-estudiante[data-grupo="${grupoId}"]`).forEach(function(cb){
                cb.checked = checkbox.checked;
            });
        });
    });

    // MODAL ELIMINAR
    document.querySelectorAll('.abrir-eliminar').forEach(function(btn){
        btn.addEventListener('click', function(){
            let nombre = this.dataset.nombre;
            let grupo = this.dataset.grupo;
            let url = this.dataset.url;
            abrirModalEliminar(nombre, grupo, url);
        });
    });
});

function abrirModalEliminar(nombre, grupo, url){
    $('.modal.show').modal('hide');
    document.getElementById('textoModalEliminar').innerText = `¿Estás seguro de eliminar a ${nombre} del grupo ${grupo}?`;
    document.getElementById('formEliminarAsignado').action = url;
    setTimeout(() => $('#modalConfirmarEliminar').modal('show'), 300);
}
$('#modalConfirmarEliminar').on('hidden.bs.modal', () => $('.modal-backdrop').remove());
</script>

@endsection

@push('js')
@endpush

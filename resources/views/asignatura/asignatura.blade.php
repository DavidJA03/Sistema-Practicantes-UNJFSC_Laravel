@extends('template')
@section('title', 'Listado de Supervisores')

@push('css')

@endpush

@section('content')
<div class="container-fluid"> 

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary text-uppercase">Lista de Supervisores</h6>
      <button class="btn btn-primary" data-toggle="modal" data-target="#crearGrupoModal">
          <i class="fas fa-plus-circle"></i> Registrar Grupo
      </button>
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
                            <th>Estado</th>
                            <th>Acciones</th>
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
                            <td>{{ $grupo->estado }}</td>
                            <td>
                                <!-- Editar -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar{{ $grupo->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Eliminar -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar{{ $grupo->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- MODAL EDITAR -->
                        <div class="modal fade" id="modalEditar{{ $grupo->id }}" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form method="POST" action="{{ route('grupos.update', $grupo->id) }}">
                                @csrf
                                <div class="modal-header">
                                  <h5 class="modal-title">Editar Grupo</h5>
                                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label>Docente</label>
                                    <select name="id_docente" class="form-control" required>
                                      @foreach($docentes as $docente)
                                        <option value="{{ $docente->id }}" {{ $docente->id == $grupo->id_docente ? 'selected' : '' }}>
                                          {{ $docente->nombres }} {{ $docente->apellidos }}
                                        </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Semestre</label>
                                    <select name="id_semestre" class="form-control" required>
                                      @foreach($semestres as $semestre)
                                        <option value="{{ $semestre->id }}" {{ $semestre->id == $grupo->id_semestre ? 'selected' : '' }}>
                                          {{ $semestre->codigo }}
                                        </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Escuela</label>
                                    <select name="id_escuela" class="form-control" required>
                                      @foreach($escuelas as $escuela)
                                        <option value="{{ $escuela->id }}" {{ $escuela->id == $grupo->id_escuela ? 'selected' : '' }}>
                                          {{ $escuela->name }}
                                        </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>Nombre del Grupo</label>
                                    <input type="text" name="nombre_grupo" value="{{ $grupo->nombre_grupo }}" class="form-control" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <!-- MODAL ELIMINAR -->
                        <div class="modal fade" id="modalEliminar{{ $grupo->id }}" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form  action="{{ route('grupos.destroy', $grupo->id) }}"  method="POST" >
                                @csrf
                                <div class="modal-header">
                                  <h5 class="modal-title">Eliminar Grupo</h5>
                                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  ¿Estás seguro de eliminar el grupo <strong>{{ $grupo->nombre_grupo }}</strong>?
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Eliminar</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                              </form>
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

<!-- MODAL CREAR GRUPO -->
<div class="modal fade" id="crearGrupoModal" tabindex="-1" aria-labelledby="crearGrupoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('grupos.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="crearGrupoLabel">Registrar Grupo de Práctica</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <!-- Docente -->
          <div class="form-group">
            <label for="id_docente">Docente</label>
            <select name="id_docente" class="form-control" required>
              <option value="">Seleccione un docente</option>
              @foreach($docentes as $docente)
                <option value="{{ $docente->id }}">{{ $docente->nombres }} {{ $docente->apellidos }}</option>
              @endforeach
            </select>
          </div>

          <!-- Semestre -->
          <div class="form-group">
            <label for="id_semestre">Semestre</label>
            <select name="id_semestre" class="form-control" required>
              <option value="">Seleccione un semestre</option>
              @foreach($semestres as $semestre)
                <option value="{{ $semestre->id }}">{{ $semestre->codigo }}</option>
              @endforeach
            </select>
          </div>

          <!-- Facultad -->
          <div class="form-group">
              <label for="facultad_id">Facultad</label>
              <select id="facultad_id" class="form-control" required>
                  <option value="">Seleccione una facultad</option>
                  @foreach($facultades as $facultad)
                      <option value="{{ $facultad->id }}">{{ $facultad->name }}</option>
                  @endforeach
              </select>
          </div>

          <!-- Escuela -->
          <div class="form-group">
              <label for="id_escuela">Escuela</label>
              <select name="id_escuela" id="id_escuela" class="form-control" required disabled>
                  <option value="">Seleccione una escuela</option>
                  @foreach($escuelas as $escuela)
                      <option value="{{ $escuela->id }}" data-facultad="{{ $escuela->facultad_id }}" hidden>
                          {{ $escuela->name }}
                      </option>
                  @endforeach
              </select>
          </div>

          <!-- Nombre del grupo -->
          <div class="form-group">
            <label for="nombre_grupo">Nombre del Grupo</label>
            <input type="text" name="nombre_grupo" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const facultadSelect = document.getElementById('facultad_id');
        const escuelaSelect = document.getElementById('id_escuela');

        facultadSelect.addEventListener('change', function () {
            const selectedFacultad = this.value;

            if (!selectedFacultad) {
                escuelaSelect.disabled = true;
                escuelaSelect.value = "";
                Array.from(escuelaSelect.options).forEach(option => option.hidden = true);
                return;
            }

            escuelaSelect.disabled = false;

            Array.from(escuelaSelect.options).forEach(option => {
                if (option.value === "") {
                    option.hidden = false; 
                    return;
                }

                const facultadId = option.getAttribute('data-facultad');
                option.hidden = facultadId !== selectedFacultad;
            });

            escuelaSelect.value = "";
        });
    });
</script>

@endpush

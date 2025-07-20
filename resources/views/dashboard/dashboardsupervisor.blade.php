@extends('template')
@section('title', 'Listado de Supervisores')

@push('css')
@endpush

@section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">🧑‍🏫 Dashboard del Supervisor</h5>
    </div>

    <div class="card-body">

        {{-- Filtros --}}
        <div class="p-3 mb-4 rounded-3 border bg-light">
            <h6 class="mb-3 text-dark fw-bold">🎯 Filtros de búsqueda</h6>
            <form method="GET" class="row g-3">
    {{-- FACULTAD --}}
        @if($facultadId)
            <input type="hidden" name="facultad_id" value="{{ $facultadId }}">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Facultad:</label>
                <input type="text" class="form-control" value="{{ $facultades->firstWhere('id', $facultadId)->name ?? 'No definida' }}" readonly>
            </div>
        @else
            <div class="col-md-4">
                <label class="form-label fw-semibold">Facultad:</label>
                <select name="facultad_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Seleccione --</option>
                    @foreach($facultades as $facultad)
                        <option value="{{ $facultad->id }}" {{ $facultadId == $facultad->id ? 'selected' : '' }}>
                            {{ $facultad->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

    {{-- ESCUELA --}}
    @if($escuelaId)
        <input type="hidden" name="escuela_id" value="{{ $escuelaId }}">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Escuela:</label>
            <input type="text" class="form-control" value="{{ $escuelas->firstWhere('id', $escuelaId)->name ?? 'No definida' }}" readonly>
        </div>
    @else
        <div class="col-md-4">
            <label class="form-label fw-semibold">Escuela:</label>
            <select name="escuela_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Seleccione --</option>
                @foreach($escuelas as $escuela)
                    <option value="{{ $escuela->id }}" {{ $escuelaId == $escuela->id ? 'selected' : '' }}>
                        {{ $escuela->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    {{-- SEMESTRE --}}
    @if($semestreCodigo)
        <input type="hidden" name="semestre_codigo" value="{{ $semestreCodigo }}">
    @else
        <div class="col-md-4">
            <label class="form-label fw-semibold">Semestre:</label>
            <select name="semestre_codigo" class="form-select" onchange="this.form.submit()">
                <option value="">-- Seleccione --</option>
                @foreach($semestres as $semestre)
                    <option value="{{ $semestre->codigo }}" {{ $semestreCodigo == $semestre->codigo ? 'selected' : '' }}>
                        {{ $semestre->codigo }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif
</form>

        </div>
        <div class="p-3 mb-4 bg-white border rounded-3">
            <h6 class="mb-3 text-dark fw-bold">📊 Indicadores generales</h6>
            <div class="row text-center">
                <div class="col">
                    <div class="card bg-primary text-white shadow-sm rounded-3">
                        <div class="card-body">
                            <i class="bi bi-people-fill fs-4"></i><br>
                            Estudiantes<br><strong>{{ $totalFiltrados }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-info text-white shadow-sm rounded-3">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-check-fill fs-4"></i><br>
                            Anexos Completos<br><strong>{{ $totalCompletos }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lista de alumnos supervisados --}}
        <div class="p-3 border rounded-3 bg-white mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="text-dark fw-bold mb-0">📌 Alumnos Supervisados con Anexos</h6>
                <input type="text" id="buscarAlumnos" class="form-control" placeholder="🔍 Buscar Estudiantes..." style="max-width: 400px;">
            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-hover table-striped align-middle" id="tablaAlumnos">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Escuela</th>
                            <th>Anexo 7</th>
                            <th>Anexo 8</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->nombres }}</td>
                                <td>{{ $alumno->apellidos }}</td>
                                <td>{{ $alumno->escuela }}</td>
                                <td>
                                    @if($alumno->anexo_7)
                                        <a href="{{ asset('storage/' . $alumno->anexo_7) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                            Ver PDF
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">No subido</span>
                                    @endif
                                </td>
                                <td>
                                    @if($alumno->anexo_8)
                                        <a href="{{ asset('storage/' . $alumno->anexo_8) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                            Ver PDF
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">No subido</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay resultados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.getElementById('filtroTabla').addEventListener('keyup', function () {
        const valor = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tablaEstudiantes tbody tr');

        filas.forEach(fila => {
            const texto = fila.textContent.toLowerCase();
            fila.style.display = texto.includes(valor) ? '' : 'none';
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const facultadSelect = document.getElementById('facultad');
    const escuelaSelect = document.getElementById('escuela');
    const docenteSelect = document.getElementById('docente');

    facultadSelect.addEventListener('change', function () {
        const facultadId = this.value;
        escuelaSelect.innerHTML = '<option value="">Cargando...</option>';
        docenteSelect.innerHTML = '<option value="">-- Todos --</option>';

        if (!facultadId) {
            escuelaSelect.innerHTML = '<option value="">-- Todas --</option>';
            return;
        }

        fetch(`/api/escuelas/${facultadId}`)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">-- Todas --</option>';
                data.forEach(e => {
                    options += `<option value="${e.id}">${e.name}</option>`; // Asegúrate que sea "nombre"
                });
                escuelaSelect.innerHTML = options;
            })
            .catch(() => {
                escuelaSelect.innerHTML = '<option value="">Error al cargar</option>';
            });
    });

    escuelaSelect.addEventListener('change', function () {
        const escuelaId = this.value;
        docenteSelect.innerHTML = '<option value="">Cargando...</option>';

        if (!escuelaId) {
            docenteSelect.innerHTML = '<option value="">-- Todos --</option>';
            return;
        }

        fetch(`/api/docentes/${escuelaId}`)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">-- Todos --</option>';
                data.forEach(d => {
                    options += `<option value="${d.id}">${d.name}</option>`;
                });
                docenteSelect.innerHTML = options;
            })
            .catch(() => {
                docenteSelect.innerHTML = '<option value="">Error al cargar</option>';
            });
    });

    const semestreSelect = document.getElementById('semestre');

    docenteSelect.addEventListener('change', function () {
        const docenteId = this.value;
        semestreSelect.innerHTML = '<option value="">Cargando...</option>';

        if (!docenteId) {
            semestreSelect.innerHTML = '<option value="">-- Todos --</option>';
            return;
        }

        fetch(`/api/semestres/${docenteId}`)
            .then(res => res.json())
            .then(data => {
                let options = '<option value="">-- Todos --</option>';
                data.forEach(s => {
                    options += `<option value="${s.id}">${s.codigo}</option>`;
                });

                semestreSelect.innerHTML = options;
            })
            .catch(() => {
                semestreSelect.innerHTML = '<option value="">Error al cargar</option>';
            });
    });


    });
</script>




@endsection

@push('js')
@endpush

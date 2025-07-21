
@extends('template')
@section('title', 'Perfil')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">📋 Filtros, Métricas y Lista de Estudiantes</h5>
    </div>

    <div class="card-body">

        {{-- Filtros --}}
        <div class="p-3 mb-4 rounded-3 border bg-light">
            <h6 class="mb-3 text-dark fw-bold">🎯 Filtros de búsqueda</h6>
            <form id="filtrosDocente" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Facultad</label>
                        <select id="facultad" name="facultad" class="form-select">
                            <option value="">-- Todas --</option>
                            @foreach ($facultades as $facultad)
                                <option value="{{ $facultad->id }}" {{ request('facultad') == $facultad->id ? 'selected' : '' }}>
                                    {{ $facultad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Semestre</label>
                        <select id="semestre" name="semestre" class="form-select">
                            <option value="">-- Todos --</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Supervisor</label>
                        <select id="supervisor" name="supervisor" class="form-select">
                            <option value="">-- Todos --</option>
                        </select>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-filter me-1"></i> Filtrar
                        </button> 
                    </div>
                </div>
            </form>
        </div>

        {{-- Métricas --}}
        <div class="p-3 mb-4 bg-white border rounded-3">
            <h6 class="mb-3 text-dark fw-bold">📊 Indicadores generales</h6>
            <div class="row text-center">
                <div class="col">
                    <div class="card bg-primary text-white shadow-sm rounded-3">
                        <div class="card-body">
                            <i class="bi bi-people-fill fs-4"></i><br>
                            Estudiantes<br><strong>{{ $totalEstudiantes }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-info text-white shadow-sm rounded-3">
                        <div class="card-body">
                            <i class="bi bi-file-earmark-check-fill fs-4"></i><br>
                            Fichas Validadas<br><strong>{{ $totalFichasValidadas }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-warning text-dark shadow-sm rounded-3">
                        <div class="card-body"> 
                            <i class="bi bi-person-badge-fill fs-4"></i><br>
                            Supervisores<br><strong>{{ $totalSupervisores }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gráficos --}}
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">📌 Estudiantes por Escuela</div>
                    <div class="card-body" style="height:300px;">
                        <canvas id="barChart" class="w-100 h-100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">📈 Estado de Matriculas</div>
                    <div class="card-body" style="height:300px;">
                        <canvas id="pieChart" class="w-100 h-100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">🏆 Cantidad de estudiantes por Supervisor</div>
            <div class="card-body">
                <canvas id="horizontalBarChart"></canvas>
            </div>
        </div>


        {{-- Grupos asignados --}}
        <div class="card mb-4">
            <div class="card-header">🧾 Grupos Asignados</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre del Grupo</th>
                            <th>Escuela</th>
                            <th>Semestre</th>
                            <th>Estudiantes</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupsData as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->school }}</td>
                                <td>{{ $group->semester }}</td>
                                <td>{{ $group->students }}</td>
                                <td>
                                    <span class="badge {{ $group->status === 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $group->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="p-3 border rounded-3 bg-white mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="text-dark fw-bold mb-0">📌 Lista de Estudiantes Matriculados</h6>
                <input type="text" id="filtroTabla" class="form-control" style="max-width: 400px;" placeholder="🔍 Buscar Estudiantes ...">
            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-hover table-striped align-middle" id="tablaEstudiantes">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Supervisor</th>
                            <th>Escuela</th>
                            <th>Semestre</th>
                            <th>Ficha</th>
                            <th>Record</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listaEstudiantes as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $item->nombres }}</td>
                                <td>{{ $item->apellidos }}</td>
                                <td>{{ $item->facultad }}</td>
                                <td>{{ $item->escuela }}</td>
                                <td>{{ $item->semestre }}</td>
                                <td>
                                    @php $estadoFicha = $item->estado_ficha ?? 'Sin registrar'; @endphp
                                    @if($estadoFicha === 'Completo')
                                        <span class="badge bg-success">Completo</span>
                                    @elseif($estadoFicha === 'En proceso')
                                        <span class="badge bg-warning text-dark">En proceso</span>
                                    @else
                                        <span class="badge bg-danger">Pendiente</span>
                                    @endif
                                </td>
                                <td>
                                    @php $estadoRecord = $item->estado_record ?? 'Sin registrar'; @endphp
                                    @if($estadoRecord === 'Completo')
                                        <span class="badge bg-success">Completo</span>
                                    @elseif($estadoRecord === 'En proceso')
                                        <span class="badge bg-warning text-dark">En proceso</span>
                                    @else
                                        <span class="badge bg-danger">Pendiente</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @if($listaEstudiantes->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">No se encontraron registros.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>







<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



@endsection
@push('js')

<script>
    document.getElementById('filtroTabla').addEventListener('input', function () {
        const valor = this.value.toLowerCase();
        const filas = document.querySelectorAll('#tablaEstudiantes tbody tr');

        filas.forEach(fila => {
            const texto = fila.innerText.toLowerCase();
            fila.style.display = texto.includes(valor) ? '' : 'none';
        });
    });
</script>

<script>
document.getElementById('escuela').addEventListener('change', function () {
    let escuelaId = this.value;

    // Obtener semestres
    fetch(`/docente/semestres/${escuelaId}`)
        .then(res => res.json())
        .then(data => {
            const semestreSelect = document.getElementById('semestre');
            semestreSelect.innerHTML = '<option value="">-- Todos --</option>';
            data.forEach(item => {
                semestreSelect.innerHTML += `<option value="${item.codigo}">${item.codigo}</option>`;
            });
        });

    // Obtener supervisores
    fetch(`/docente/supervisores/${escuelaId}`)
        .then(res => res.json())
        .then(data => {
            const supervisorSelect = document.getElementById('supervisor');
            supervisorSelect.innerHTML = '<option value="">-- Todos --</option>';
            data.forEach(item => {
                supervisorSelect.innerHTML += `<option value="${item.id}">${item.nombres}</option>`;
            });
        });
});
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function createChart(elId, type, data, options) {
        var el = document.getElementById(elId);
        if (el) {
            var ctx = el.getContext('2d');
            new Chart(ctx, { type, data, options });
        }
    }

    // Bar chart - Estudiantes por Escuela
    createChart('barChart', 'bar', {
        labels: {!! json_encode($estudiantesPorEscuela->pluck('escuela')) !!},
        datasets: [{
            label: 'Total Estudiantes',
            data: {!! json_encode($estudiantesPorEscuela->pluck('total')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    }, {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
    });

    // Pie chart - Estado de Fichas
    createChart('pieChart', 'pie', {
        labels: {!! json_encode($estadoFichas->pluck('estado_ficha')) !!},
        datasets: [{
            data: {!! json_encode($estadoFichas->pluck('total')) !!},
            backgroundColor: [
                'rgba(75, 192, 192, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ],
            borderColor: '#fff',
            borderWidth: 1
        }]
    }, {
        responsive: true,
        maintainAspectRatio: false
    });
</script>




<script>
    var ctxHB = document.getElementById('horizontalBarChart');
    if (ctxHB) {
        ctxHB.height = 200; // altura más baja
        new Chart(ctxHB.getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($supervisoresRanking->pluck('nombres')->toArray()) !!},
                datasets: [{
                    label: 'Estudiantes asignados',
                    data: {!! json_encode($supervisoresRanking->pluck('total')->toArray()) !!},
                    backgroundColor: [
                        'rgba(0, 153, 255, 0.7)',
                        'rgba(61, 0, 13, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 6
                }]
            },
            options: {
                indexAxis: 'y', // barra horizontal
                responsive: true,
                maintainAspectRatio: false, // permite controlar el alto
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#333',
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#000',
                        titleColor: '#fff',
                        bodyColor: '#eee'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: '#555',
                            font: { size: 11 }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#555',
                            font: { size: 11 }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    }
                }
            }
        });
    }
</script>



@endpush
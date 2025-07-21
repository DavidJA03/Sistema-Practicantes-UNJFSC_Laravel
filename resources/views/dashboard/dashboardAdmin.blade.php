@extends('template')
@section('title', 'Listado de Supervisores')

@push('css')
@endpush

@section('content')

<div class="card ">
    <div class="card-header bg-dark text-white ">
        <h5 class="mb-0">📋 Filtros, Métricas y Lista de Estudiantes</h5>
    </div>

    <div class="card-body">

        {{-- Filtros --}}
        <div class="p-3 mb-4 rounded-3 border bg-light">
            <h6 class="mb-3 text-dark fw-bold">🎯 Filtros de búsqueda</h6>
            <form method="GET" action="{{ route('admin.Dashboard') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="facultad" class="form-label fw-semibold">Facultad:</label>
                        <select id="facultad" name="facultad" class="form-select">
                            <option value="">-- Todas --</option>
                            @foreach($facultades as $fac)
                                <option value="{{ $fac->id }}">{{ $fac->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="escuela" class="form-label fw-semibold">Escuela:</label>
                        <select id="escuela" name="escuela" class="form-select">
                            <option value="">-- Todas --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="docente" class="form-label fw-semibold">Docente:</label>
                        <select id="docente" name="docente" class="form-select">
                            <option value="">-- Todos --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="semestre" class="form-label fw-semibold">Semestre:</label>
                        <select id="semestre" name="semestre" class="form-select">
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

        <div class="p-3 mb-4 bg-white border rounded-3">
            <h6 class="mb-3 text-dark fw-bold">📊 Indicadores generales</h6>
            <div class="row text-center">
                <div class="col">
        <div class="card bg-primary text-white shadow-sm rounded-3">
            <div class="card-body">
                <i class="bi bi-people-fill fs-4"></i><br>
                Alumnos<br><strong>{{ $totalPorEscuelaEnSemestre }}</strong>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-info text-white shadow-sm rounded-3">
            <div class="card-body">
                <i class="bi bi-person-check-fill fs-4"></i><br>
                Matriculados<br><strong>{{ $totalMatriculados }}</strong>
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
    <div class="col">
        <div class="card bg-success text-white shadow-sm rounded-3">
            <div class="card-body">
                <i class="bi bi-file-earmark-check-fill fs-4"></i><br>
                Fichas Completas<br><strong>{{ $completos }}</strong>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-danger text-white shadow-sm rounded-3">
            <div class="card-body">
                <i class="bi bi-exclamation-circle-fill fs-4"></i><br>
                Pendientes<br><strong>{{ $pendientes }}</strong>
            </div>
        </div>
    </div>
            </div>
        </div>

        <div class="p-3 border rounded-3 bg-white mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="text-dark fw-bold mb-0">📌 Lista de Estudiantes Matriculados</h6>
                <input type="text" id="filtroTabla" class="form-control " style="max-width: 400px;" placeholder="🔍 Buscar Estudiantes ...">
            </div>


            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-hover table-striped align-middle" id="tablaEstudiantes">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Facultad</th>
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

        <div class="p-3 mb-4 bg-white border rounded-3">
            <h6 class="mb-3 text-dark fw-bold">📈 Estado de Fichas por Escuela</h6>
            <canvas id="stackedBarChart" height="100"></canvas>
        </div>

        <div class="card shadow-sm rounded-3 mb-4">
            <div class="card-header bg-gradient text-dark fw-bold">
                📅 Fichas validadas por mes ({{ date('Y') }})
            </div>
            <div class="card-body p-4">
                <div style="height: 360px;">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    

</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctxLineEl = document.getElementById('lineChart');
        if (ctxLineEl) {
            const ctxLine = ctxLineEl.getContext('2d');

            const lineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: {!! json_encode($fichasPorMes->pluck('mes')) !!},
                    datasets: [{
                        label: 'Fichas validadas',
                        data: {!! json_encode($fichasPorMes->pluck('total')) !!},
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.1)',
                        pointBackgroundColor: '#4e73df',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#4e73df',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#343a40',
                                font: {
                                    size: 13,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#f8f9fc',
                            titleColor: '#4e73df',
                            bodyColor: '#5a5c69',
                            borderColor: '#e3e6f0',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#5a5c69'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#5a5c69',
                                stepSize: 1
                            },
                            grid: {
                                color: '#e3e6f0'
                            }
                        }
                    }
                }
            });
        }
    });
</script>

 
<script>
let chart; // Mantén una referencia global al gráfico

function renderChart(data) {
    const labels = data.map(item => item.escuela);
    const completos = data.map(item => item.completos);
    const enProceso = data.map(item => item.en_proceso);
    const pendientes = data.map(item => item.pendientes);

    const ctx = document.getElementById('stackedBarChart').getContext('2d');

    if (chart) chart.destroy(); // Borra el gráfico anterior si ya existe

    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                { label: 'Completo', data: completos, backgroundColor: '#198754' },
                { label: 'En proceso', data: enProceso, backgroundColor: '#ffc107' },
                { label: 'Pendiente', data: pendientes, backgroundColor: '#dc3545' }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Estado de fichas por escuela' },
                legend: { position: 'top' }
            },
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
        }
    });
}

// Cargar inicial (si no quieres esperar a un filtro)
renderChart(@json($fichasPorEscuela));

// Manejar cambios de filtros
const form = document.querySelector('form');
form.addEventListener('submit', function(e) {
    e.preventDefault(); // evita recargar la página

    const params = new URLSearchParams(new FormData(this)).toString();

    
});
</script>

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
                    options += `<option value="${d.id}">${d.nombre}</option>`;
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

@extends('estudiante')

@push('css')
    <style>
        .clickable-card {
            transition: all 0.3s ease;
        }

        .clickable-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            background: linear-gradient(145deg, #e2e8f0, #f1f5f9) !important;
        }

        .document-card {
            transition: all 0.2s ease;
            border: 1px solid var(--border-gray) !important;
        }

        .document-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .upload-area-modal {
            background-color: #fafbfc;
            transition: all 0.2s ease;
        }

        .upload-area-modal:hover {
            border-color: var(--primary-blue) !important;
            background-color: var(--light-blue);
        }

        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .modal-header {
            border-radius: 16px 16px 0 0;
            border-bottom: none;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-out {
            animation: slideOut 0.3s ease-out forwards;
        }

        @keyframes slideOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(-100%); }
        }

        .practice-stage-card {
            background: linear-gradient(145deg, #f8fafc, #f1f5f9);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--border-gray);
            transition: all 0.3s ease;
        }

        .practice-stage-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .stage-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }

        .stage-icon.company {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .stage-icon.supervisor {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem 0;
            }
            
            .welcome-header {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .section-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $user = auth()->user();
        $persona = $user->persona;
        $nombreCompleto = $persona->nombres . ' ' . $persona->apellidos;
        $escuelaNombre = $escuela ? $escuela->name : 'Desconocida';
        $practicas = auth()->user()->persona->practica;
    @endphp
    <!-- Main Content -->
    <div class="container-fluid main-content" id="mainContentView">
        <div class="container">
            <!-- Welcome Header -->
            <div class="welcome-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="h3 mb-2">Bienvenido(a), {{ $nombreCompleto }}</h1>
                        <p class="mb-0 opacity-90">Aquí encontrarás toda la información y herramientas para gestionar tus prácticas pre-profesionales</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <i class="bi bi-calendar-check" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Perfil del Estudiante -->
                <div class="col-lg-4 mb-4">
                    <div class="section-card h-auto clickable-card" data-bs-toggle="modal" data-bs-target="#modalPerfil" style="cursor: pointer;">
                        <h2 class="section-title">
                            <i class="bi bi-person-circle"></i>
                            Perfil
                        </h2>
                        
                        <div class="text-center mb-3">
                            @if(auth()->user()->persona->ruta_foto)
                                <img class="img-profile rounded-circle" width="80" height="80" src="{{ asset(auth()->user()->persona->ruta_foto) }}">
                            @else
                                <i class="bi bi-person-fill" style="font-size: 55px;"></i>
                            @endif
                            <h6 class="mb-1 mt-4">{{ $nombreCompleto }}</h6>
                            <p class="text-muted small">Estudiante de {{ $escuelaNombre }}</p>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Correo Institucional</div>
                            <div class="info-value">{{ $persona->correo_inst }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Semestre</div>
                            <div class="info-value">{{ $semestre->codigo }} - {{$semestre->ciclo}}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Codigo Institucional</div>
                            <div class="info-value">{{ $persona->codigo }}</div>
                        </div>
                    </div>
                </div>

                <!-- Matrícula -->
                <div class="col-lg-4 mb-4">
                    <div class="section-card h-auto clickable-card" data-bs-toggle="modal" data-bs-target="#modalMatricula" style="cursor: pointer;">
                        <h2 class="section-title">
                            <i class="bi bi-journal-bookmark"></i>
                            Matrícula - Académica
                        </h2>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Estado de Inscripción</span>
                                @if(isset($persona?->matricula) && ($persona->matricula->ruta_ficha || $persona->matricula->ruta_record))
                                    @if ($persona?->matricula->estado_ficha == 'Completo' && $persona?->matricula->estado_record == 'Completo')
                                        <span class="status-badge status-completed">Completo</span>
                                        <span class="text-success">✓</span>
                                    @elseif ($persona?->matricula->estado_ficha == 'en proceso' || $persona?->matricula->estado_record == 'en proceso')
                                        <span class="status-badge status-active">En Proceso</span>
                                    @endif
                                @else
                                    <span class="status-badge status-pending">Pendiente</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Período Académico</div>
                            <div class="info-value">{{ $semestre->codigo }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Docente Titular</div>
                            <div class="info-value">{{ $docente->apellidos }}  {{ $docente->nombres }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Escuela Porfesional</div>
                            <div class="info-value">{{ $escuelaNombre }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Requisitos</div>
                            <div class="info-value">F. Matricula - R. Academico</div>
                        </div>

                    </div>
                </div>

                <!-- Prácticas -->
                <div class="col-lg-4 mb-4">
                    <div class="section-card h-auto clickable-card" data-bs-toggle="modal" data-bs-target="#modalPracticas" style="cursor: pointer;">
                        <h2 class="section-title">
                            <i class="bi bi-briefcase"></i>
                            Prácticas Pre-profesionales
                        </h2>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Estado Actual</span>
                                @if(isset($persona?->practica) && ($persona->practica->estado_proceso = 'completo'))
                                    @if ($persona?->practica->estado_proceso == 'completo')
                                        <span class="status-badge status-completed">Completo</span>
                                        <span class="text-success">✓</span>
                                    @elseif ($persona?->practica->estado_proceso == 'en proceso' || $persona?->practica->estado_proceso == 'rechazado')
                                        <span class="status-badge status-active">En Proceso</span>
                                    @endif
                                @else
                                    <span class="status-badge status-pending">Pendiente</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Empresa</div>
                            <div class="info-value">{{ $persona->practica->empresa->nombre ?? 'No Asignada' }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Jefe Inmediato</div>
                            <div class="info-value">{{ $persona->practica->jefeInmediato->nombres ?? 'No Asignado' }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Período</div>
                            <div class="info-value">{{ $semestre->codigo }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Supervisor</div>
                            <div class="info-value">{{ $persona->gruposEstudiante->supervisor->nombres ?? 'No Asignado' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('segmento.view_estu')
    <!-- Modal Matricula -->
    @include('matricula.view_estu_mat')
    <!-- Modal Prácticas -->
    @include('practicas.estudiante.practica')
    
    <!-- Vista de Práctica (se mostrará dinámicamente) -->
    <div id="practiceViewContainer" style="display: none;">
        @if($practicas && $practicas->tipo_practica)
            @if($practicas->tipo_practica === 'desarrollo')
                @include('practicas.estudiante.desarrollo.est_des')
            @elseif($practicas->tipo_practica === 'convalidacion')
                @include('practicas.estudiante.convalidacion.est_con')
            @endif
        @endif
    </div>
@endsection

@push('js')
    <script>
        // Función para mostrar alertas
        function showAlert(title, message, type = 'info') {
            const alertClass = type === 'error' ? 'alert-danger' : type === 'success' ? 'alert-success' : 'alert-info';
            const icon = type === 'error' ? 'bi-exclamation-triangle' : type === 'success' ? 'bi-check-circle' : 'bi-info-circle';
            
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="bi ${icon} me-2"></i>
                    <strong>${title}:</strong> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            // Crear contenedor si no existe
            let alertContainer = document.getElementById('alertContainer');
            if (!alertContainer) {
                alertContainer = document.createElement('div');
                alertContainer.id = 'alertContainer';
                alertContainer.style.position = 'fixed';
                alertContainer.style.top = '100px';
                alertContainer.style.right = '20px';
                alertContainer.style.zIndex = '9999';
                alertContainer.style.maxWidth = '400px';
                document.body.appendChild(alertContainer);
            }
            
            alertContainer.innerHTML = alertHtml;
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    alert.remove();
                }
            }, 5000);
        }

        // Efectos de hover para las tarjetas
        document.querySelectorAll('.section-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                if (!this.classList.contains('clickable-card')) {
                    this.style.transform = 'translateY(-2px)';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                if (!this.classList.contains('clickable-card')) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });

        // Funcionalidad para subir foto
        document.getElementById('fotoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            checkPracticeView();
            // Verificar si ya tiene práctica seleccionada
            const hasPractice = @json($practicas && $practicas->tipo_practica !== null);
            const practiceType = @json($practicas->tipo_practica ?? null);
            
            // Mostrar modal solo si no tiene práctica seleccionada
            document.querySelector('[data-bs-target="#modalPracticas"]').addEventListener('click', function(e) {
                if (@json($practicas && $practicas->tipo_practica !== null)) {
                    e.preventDefault();
                    showPracticeView(@json($practicas->tipo_practica));
                }
            });
            
            // Configurar botones de selección
            document.querySelectorAll('.practice-option button').forEach(btn => {
                btn.addEventListener('click', function() {
                    const type = this.closest('.practice-option').dataset.practiceType;
                    selectPracticeType(type);
                });
            });
        });

        function selectPracticeType(type) {
            Swal.fire({
                title: '¿Confirmar selección?',
                text: `¿Deseas seleccionar la práctica de ${type === 'desarrollo' ? 'Desarrollo' : 'Convalidación'}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, seleccionar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const route = type === 'desarrollo' 
                        ? '{{ route("desarrollo.store", ["ed" => 1]) }}' 
                        : '{{ route("desarrollo.store", ["ed" => 2]) }}';
                    
                    axios.post(route)
                        .then(response => {
                            if (response.data.success) {
                                // Ocultar modal y mostrar vista de práctica
                                const modal = bootstrap.Modal.getInstance(document.getElementById('modalPracticas'));
                                if (modal) modal.hide();
                                
                                showPracticeView(type);
                                showAlert('success', 'Tipo de práctica seleccionado correctamente');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showAlert('danger', 'Error al guardar la selección');
                        });
                }
            });
        }

        function showPracticeView(type) {
            // Ocultar contenido principal
            document.getElementById('mainContentView').style.display = 'none';
            
            // Mostrar vista de práctica correspondiente
            document.getElementById('practiceViewContainer').style.display = 'block';
            
            // Actualizar URL para mantener estado
            history.pushState({ practiceView: true }, '', '?view=practice');
        }
        function checkPracticeView() {
            const hasPractice = @json($practicas && $practicas->tipo_practica !== null);
            const urlParams = new URLSearchParams(window.location.search);
            
            if (hasPractice) {
                if (urlParams.get('view') === 'practice') {
                    showPracticeView(@json($practicas->tipo_practica));
                } else {
                    // Ocultar vista de práctica si no está en la URL
                    document.getElementById('practiceViewContainer').style.display = 'none';
                    document.getElementById('mainContentView').style.display = 'block';
                }
            } else {
                // Mostrar modal si no tiene práctica seleccionada
                const modalPracticas = new bootstrap.Modal(document.getElementById('modalPracticas'));
                modalPracticas.show();
            }
        }

        function goHome() {
        // Ocultar vista de práctica y mostrar contenido principal
            document.getElementById('practiceViewContainer').style.display = 'none';
            document.getElementById('mainContentView').style.display = 'block';
            
            // Actualizar URL
            history.pushState({}, '', window.location.pathname);
        }

        window.addEventListener('popstate', function(event) {
            checkPracticeView();
        });

        // Agregar SweetAlert2 CDN si no está incluido
        if (typeof Swal === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            document.head.appendChild(script);
        }
    </script>
    <script src="{{ asset('js/perfil_edit.js') }}"></script>
    
    <script>
        function showAlert(type, message) {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            let alertContainer = document.getElementById('alertContainer');
            if (!alertContainer) {
                alertContainer = document.createElement('div');
                alertContainer.id = 'alertContainer';
                alertContainer.style.position = 'fixed';
                alertContainer.style.top = '20px';
                alertContainer.style.right = '20px';
                alertContainer.style.zIndex = '9999';
                alertContainer.style.maxWidth = '400px';
                document.body.appendChild(alertContainer);
            }
            
            alertContainer.innerHTML = alertHtml;
            
            // Desaparecer después de 5 segundos
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.addEventListener('transitionend', () => alert.remove());
                }
            }, 5000);
        }
    </script>
@endpush
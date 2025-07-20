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
    @endphp
    <!-- Main Content -->
    <div class="container-fluid main-content">
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

            // Verificar estado de matrícula al abrir el modal
            const modalPracticas = document.getElementById('modalPracticas');
            const modalInstance = bootstrap.Modal.getInstance(modalPracticas) || new bootstrap.Modal(modalPracticas);
            
            modalPracticas.addEventListener('show.bs.modal', function(event) {
                @if(!($persona->matriculas->contains('estado_ficha', 'Completo') && $persona->matriculas->contains('estado_record', 'Completo')))
                    event.preventDefault(); // Evita que el modal se muestre
                    modalInstance.hide(); // Asegura que el modal permanezca oculto
                    Swal.fire({
                        icon: 'warning',
                        title: 'Acceso denegado',
                        text: "Primero debes completar tu matrícula para acceder a estas opciones.",
                        confirmButtonText: 'Entendido'
                    });
                @endif
            });
            // Event listeners para las opciones de práctica
            document.querySelectorAll('.practice-option').forEach(option => {
                option.addEventListener('click', function() {
                    const practiceType = this.getAttribute('data-practice-type');
                    selectPracticeType(practiceType);
                });

                // Efectos hover
                option.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
                });

                option.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Función para seleccionar el tipo de prácticas
            function selectPracticeType(type) {
                const typeText = type === 'desarrollo' ? 'Desarrollo' : 'Convalidación';
                const routeParam = type === 'desarrollo' ? 1 : 2;
                const redirectUrl = type === 'desarrollo' ? '/practicas/desarrollo' : '/practicas/convalidacion';

                Swal.fire({
                    title: '¿Estás seguro?',
                    html: `¿Deseas continuar con el módulo de <strong>${typeText}</strong>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--primary-blue)',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, continuar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'rounded-3',
                        confirmButton: 'btn-primary-custom',
                        cancelButton: 'btn-outline-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Procesando...',
                            html: 'Configurando tu práctica, por favor espera...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        axios.post(`{{ route('desarrollo.store', ['ed' => '__ed__']) }}`.replace('__ed__', routeParam))
                            .then(response => {
                                window.location.href = redirectUrl;
                            })
                            .catch(error => {
                                console.error('Error storing development type:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No se pudo guardar el tipo de práctica. Por favor, inténtalo nuevamente.'
                                });
                            });
                    }
                });
            }

        });

        // Agregar SweetAlert2 CDN si no está incluido
        if (typeof Swal === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            document.head.appendChild(script);
        }
    </script>
    <script src="{{ asset('js/perfil_edit.js') }}"></script>
@endpush
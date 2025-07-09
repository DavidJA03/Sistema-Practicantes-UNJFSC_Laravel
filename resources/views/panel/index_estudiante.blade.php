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
                        <h1 class="h3 mb-2">Bienvenida, {{ $nombreCompleto }}</h1>
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
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face" 
                                    alt="Foto de perfil" class="profile-avatar mb-3">
                            @endif
                            <h6 class="mb-1 mt-4">{{ $nombreCompleto }}</h6>
                            <p class="text-muted small mt-1">Estudiante de {{ $escuelaNombre }}</p>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Correo Institucional</div>
                            <div class="info-value">{{ $persona->correo_inst }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Semestre</div>
                            <div class="info-value">8vo Semestre</div>
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
                                <span class="status-badge status-active">Activa</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Período Académico</div>
                            <div class="info-value">2024-1</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Materias Inscritas</div>
                            <div class="info-value">6 materias</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Créditos Totales</div>
                            <div class="info-value">18 créditos</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Fecha Límite Retiro</div>
                            <div class="info-value">15 de Marzo, 2024</div>
                        </div>

                    </div>
                </div>

                <!-- Prácticas -->
                <div class="col-lg-4 mb-4">
                    <div class="section-card h-auto">
                        <h2 class="section-title">
                            <i class="bi bi-briefcase"></i>
                            Prácticas Pre-profesionales
                        </h2>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">Estado Actual</span>
                                <span class="status-badge status-active">En Progreso</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Empresa</div>
                            <div class="info-value">TechSolutions S.A.</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Tutor Asignado</div>
                            <div class="info-value">Ing. Carlos Mendoza</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Período</div>
                            <div class="info-value">Enero - Abril 2024</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Horas Completadas</div>
                            <div class="info-value">120 / 240 horas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('segmento.view_estu')
    <!-- Modal Matricula -->
    @include('matricula.view_estu')
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
    </script>
    <script src="{{ asset('js/perfil_edit.js') }}"></script>
@endpush
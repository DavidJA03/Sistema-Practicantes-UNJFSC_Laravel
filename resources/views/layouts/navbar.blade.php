    <div id="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('img/ins-UNJFSC.png') }}" alt="Logo" style="max-width: 50px;">
                <a href="{{ route('panel') }}" class="sidebar-logo">
                    UNJFSC
                </a>
                <div class="sidebar-subtitle">Sistema de Prácticas</div>
            </div>

            <div class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Principal</div>
                    @if (Auth::user()->persona->rol_id == 1 || Auth::user()->persona->rol_id == 2 || Auth::user()->persona->rol_id == 3)
                        <a href="{{ route('panel') }}" class="nav-link {{ request()->routeIs('panel') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i>
                            <span>Dashboard</span>
                        </a>
                        
                    @endif
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Gestión de Usuarios</div>
                    @if (Auth::user()->persona->rol_id == 1 || Auth::user()->persona->rol_id == 2)
                        <!-- Menú desplegable de Usuarios -->
                        <div class="nav-dropdown">
                            <a href="#" class="nav-link nav-dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseUsuarios" aria-expanded="false">
                                <i class="bi bi-people"></i>
                                <span>Usuarios</span>
                                <i class="bi bi-chevron-down nav-arrow"></i>
                            </a>
                            <div class="collapse nav-submenu" id="collapseUsuarios">
                                @if (Auth::user()->persona->rol_id == 1)
                                    <a href="{{ route('registrar') }}" class="nav-sublink">
                                        <i class="bi bi-person-plus"></i>
                                        <span>Añadir Usuario</span>
                                    </a>
                                    <div class="nav-subheader">Tipos de Usuarios</div>
                                    <a href="{{ route('docente') }}" class="nav-sublink {{ request()->routeIs('docente.*') ? 'active' : '' }}">
                                        <i class="bi bi-mortarboard"></i>
                                        <span>Docentes</span>
                                    </a>
                                @endif
                                <a href="{{ route('supervisor') }}" class="nav-sublink {{ request()->routeIs('supervisor.*') ? 'active' : '' }}">
                                    <i class="bi bi-person-badge"></i>
                                    <span>Supervisores</span>
                                </a>
                                <a href="{{ route('estudiante') }}" class="nav-sublink {{ request()->routeIs('estudiante.*') ? 'active' : '' }}">
                                    <i class="bi bi-person-workspace"></i>
                                    <span>Estudiantes</span>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->persona->rol_id == 3)
                        <a href="{{ route('estudiante') }}" class="nav-link {{ request()->routeIs('estudiante.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Lista de Estudiantes</span>
                        </a>
                    @endif
                </div>
                @if (Auth::user()->persona->rol_id == 1)
                    <div class="nav-section">
                        <div class="nav-section-title">Bloque Académico</div>
                        <div class="nav-dropdown">
                            <a href="#" class="nav-link nav-dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseBloqueAcademico" aria-expanded="false">
                                <i class="bi bi-mortarboard"></i>
                                <span>Bloque Académico</span>
                                <i class="bi bi-chevron-down nav-arrow"></i>
                            </a>
                            <div class="collapse nav-submenu" id="collapseBloqueAcademico">
                                <a href="{{ route('semestre.index') }}" class="nav-link {{ request()->routeIs('semestre.*') ? 'active' : '' }}">
                                    <i class="bi bi-calendar-range"></i>
                                    <span>Semestres</span>
                                </a>
                                <a href="{{ route('facultad.index') }}" class="nav-link {{ request()->routeIs('facultad.*') ? 'active' : '' }}">
                                    <i class="bi bi-building-check"></i>
                                    <span>Facultades</span>
                                </a>
                                <a href="{{ route('escuela.index') }}" class="nav-link {{ request()->routeIs('escuela.*') ? 'active' : '' }}">
                                    <i class="bi bi-diagram-3"></i>
                                    <span>Escuelas</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->persona->rol_id == 1 || Auth::user()->persona->rol_id == 2)
                    <div class="nav-section">
                        <div class="nav-section-title">Asignación</div>
                        <!-- Menú desplegable de Asignaturas -->
                        @if (Auth::user()->persona->rol_id == 1)
                            <div class="nav-dropdown">
                                <a href="#" class="nav-link nav-dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseAsignaturas" aria-expanded="false">
                                    <i class="bi bi-journal-code"></i>
                                    <span>Asignación</span>
                                    <i class="bi bi-chevron-down nav-arrow"></i>
                                </a>
                                <div class="collapse nav-submenu" id="collapseAsignaturas">
                                    <a href="{{ route('asignacion_index') }}" class="nav-sublink {{ request()->routeIs('asignacion_index') ? 'active' : '' }}">
                                        <i class="bi bi-diagram-2"></i>
                                        <span>Grupo - Práctica</span>
                                    </a>
                                    <a href="{{ route('estudiante_index') }}" class="nav-sublink {{ request()->routeIs('estudiante_index') ? 'active' : '' }}">
                                        <i class="bi bi-people-fill"></i>
                                        <span>Grupo - Estudiante</span>
                                    </a>
                                </div>
                            </div>
                        @elseif (Auth::user()->persona->rol_id == 2)
                            <a href="{{ route('estudiante_index') }}" class="nav-link {{ request()->routeIs('estudiante_index') ? 'active' : '' }}">
                                    <i class="bi bi-people-fill"></i>
                                    <span>Grupo - Estudiante</span>
                            </a>
                        @endif
                    </div>
                @endif

                @if (Auth::user()->persona->rol_id == 1 || Auth::user()->persona->rol_id == 2)
                    <div class="nav-section">
                        <div class="nav-section-title">Supervisión</div>
                        <div class="nav-dropdown">
                            <a href="#" class="nav-link nav-dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#collapseSupervision" aria-expanded="false">
                                <i class="bi bi-clipboard-data"></i>
                                <span>Supervisiones</span>
                                <i class="bi bi-chevron-down nav-arrow"></i>
                            </a>
                            <div class="collapse nav-submenu" id="collapseSupervision">
                                <a href="{{ route('supervision') }}" class="nav-link {{ request()->routeIs('supervision.*') ? 'active' : '' }}">
                                    <i class="bi bi-eye"></i>
                                    <span>Supervisión - Prácticas</span>
                                </a>
                                <a href="{{ route('Validacion.Matricula') }}" class="nav-link {{ request()->routeIs('Validacion.Matricula.*') ? 'active' : '' }}">
                                    <i class="bi bi-file-earmark-check"></i>
                                    <span>Supervisión - Matrícula</span>
                                </a>
                                <a href="{{ route('evaluacion.index') }}" class="nav-link {{ request()->routeIs('evaluacion.index.*') ? 'active' : '' }}">
                                    <i class="bi bi-bar-chart"></i>
                                    <span>Supervisión - Evaluación</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if (Auth::user()->persona->rol_id == 1 || Auth::user()->persona->rol_id == 3)
                    <div class="nav-section">
                        <div class="nav-section-title">Evaluación</div>
                        <a href="{{ route('pregunta.index') }}" class="nav-link {{ request()->routeIs('pregunta.*') ? 'active' : '' }}">
                            <i class="bi bi-question-circle"></i>
                            <span>Preguntas</span>
                        </a>
                        <a href="{{ route('evaluacion.index') }}" class="nav-link {{ request()->routeIs('evaluacion.index.*') ? 'active' : '' }}">
                            <i class="bi bi-bar-chart-line"></i>
                            <span>Evaluación</span>
                        </a>
                    </div>
                @endif
                <div class="nav-section">
                    <div class="nav-section-title">Otros</div>
                    @if (Auth::user()->persona->rol_id == 1 || Auth::user()->persona->rol_id == 2 || Auth::user()->persona->rol_id == 3)
                        <a href="{{ route('empresa') }}" class="nav-link {{ request()->routeIs('empresa.*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i>
                            <span>Empresas</span>
                        </a>
                        <a href="{{ route('jefes') }}" class="nav-link {{ request()->routeIs('jefes.*') ? 'active' : '' }}">
                            <i class="bi bi-person-badge"></i>
                            <span>Jefes Inmediato</span>
                        </a>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div id="content-wrapper">
            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <button class="btn d-md-none" id="sidebarToggle" type="button">
                        <i class="bi bi-list"></i>
                    </button>
                    <h1>@yield('title', 'Dashboard')</h1>
                    <div class="topbar-subtitle">@yield('subtitle', 'Sistema de Gestión de Prácticas Preprofesionales')</div>
                </div>

                <div class="topbar-right">
                    <!-- Notifications -->
                    <div class="dropdown">
                        <button class="btn btn-link position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell" style="font-size: 1.25rem; color: var(--text-secondary);"></i>
                            <!--<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                3
                            </span>-->
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Notificaciones</h6></li>
                            <li><a class="dropdown-item" href="#">Nueva práctica registrada</a></li>
                            <li><a class="dropdown-item" href="#">Evaluación pendiente</a></li>
                            <li><a class="dropdown-item" href="#">Supervisión programada</a></li>
                        </ul>
                    </div>

                    <!-- User Info -->
                    <div class="user-dropdown">
                        <div class="user-info" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                {{ substr(Auth::user()->persona->nombres ?? 'U', 0, 1) }}
                            </div>
                            <div class="user-details">
                                <div class="user-name">{{ Auth::user()->persona->nombres ?? 'Usuario' }}</div>
                                <div class="user-role">{{ Auth::user()->persona->rol_id->name ?? 'Administrador' }}</div>
                            </div>
                            <i class="bi bi-chevron-down" style="color: var(--text-secondary);"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('perfil') }}"><i class="bi bi-person"></i> Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="{{ route('cerrarSecion') }}">
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
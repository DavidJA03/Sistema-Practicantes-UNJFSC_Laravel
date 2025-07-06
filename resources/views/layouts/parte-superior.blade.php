<!-- CSS -->
<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
<link href="{{ asset('css/template.css') }}" rel="stylesheet">
<link href="{{ asset('css/tables.css') }}" rel="stylesheet">

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

<!-- CONTENEDOR PRINCIPAL -->
<div id="wrapper">

    <!-- SIDEBAR -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('panel') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-university"></i>
            </div>
            <div class="sidebar-brand-text">UNJFSC</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('panel') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('perfil') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Perfil</span>
            </a>
        </li>

        @if(auth()->user()->persona?->rol_id == 1)
            <!-- USUARIOS -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsuarios" aria-expanded="false">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUsuarios" class="collapse" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('registrar') }}">Añadir Usuario</a>
                        <h6 class="collapse-header">Tipos de Usuarios</h6>
                        <a class="collapse-item" href="{{ route('docente') }}">Docentes</a>
                        <a class="collapse-item" href="{{ route('supervisor') }}">Supervisores</a>
                        <a class="collapse-item" href="{{ route('estudiante') }}">Estudiantes</a>
                    </div>
                </div>
            </li>

            <!-- ASIGNATURA -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAsignatura" aria-expanded="false">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Asignatura</span>
                </a>
                <div id="collapseAsignatura" class="collapse" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('asignacion_index') }}">Grupo Práctica</a>
                        <a class="collapse-item" href="{{ route('estudiante_index') }}">Grupo Estudiante</a>
                    </div>
                </div>
            </li>

            <!-- BLOQUE ACADÉMICO -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#bloqueacademico" aria-expanded="false">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Bloque Académico</span>
                </a>
                <div id="bloqueacademico" class="collapse" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bloque Académico:</h6>
                        <a class="collapse-item" href="{{ route('facultad.index') }}">Facultad</a>
                        <a class="collapse-item" href="{{ route('escuela.index') }}">Escuela</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('semestre.index') }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Semestre</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->persona?->rol_id == 3)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Validacion.Matricula') }}">
                    <i class="fas fa-check-circle"></i>
                    <span>Validación de Matrícula</span>
                </a>
            </li>
        @endif

        @if(auth()->user()->persona?->rol_id == 4)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('matricula_index') }}">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Matrícula</span>
                </a>
            </li>
        @endif

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Prácticas</div>

        @if ($practica == 'desarrollo')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('desarrollo') }}">
                    <i class="fas fa-code"></i>
                    <span>Desarrollo</span>
                </a>
            </li>
        @elseif ($practica == 'convalidacion')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('convalidacion') }}">
                    <i class="fas fa-file-signature"></i>
                    <span>Convalidación</span>
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('practica') }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Prácticas</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="{{ route('supervision') }}">
                <i class="fas fa-user-check"></i>
                <span>Supervisión</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Empresas</div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('empresa') }}">
                <i class="fas fa-building"></i>
                <span>Empresa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('jefes') }}">
                <i class="fas fa-user-tie"></i>
                <span>Jefes</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <!-- CONTENEDOR DE CONTENIDO -->
    <div id="content-wrapper" class="d-flex flex-column">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Buscar">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <div class="text-left mr-2">
                            <div class="small font-weight-bold text-gray-600">{{ $nombre }} {{ $apellido }}</div>
                            <div class="small text-gray-600">{{ $codigo }}</div>
                        </div>
                        @if(auth()->user()->persona->ruta_foto)
                            <img class="img-profile rounded-circle" src="{{ asset(auth()->user()->persona->ruta_foto) }}">
                        @else
                            <i class="fas fa-user fa-lg text-gray-600"></i>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('cerrarSecion') }}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <!-- Aquí va tu contenido principal -->

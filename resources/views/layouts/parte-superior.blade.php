<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <link href="{{ asset('css/template.css') }}" rel="stylesheet">
        <link href="{{ asset('css/tables.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap/scss/bootstrap.scss') }}" rel="stylesheet">

        
    
        <div id="wrapper">

        @php
            $rol = auth()->user()->persona?->rol_id;
        @endphp

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">UNJFSC</div>
            </a>

            <hr class="sidebar-divider my-0">
            @if($rol ==1 || $rol ==2    )
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('panel') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('perfil') }}">
                    <i class="fas fa-fw fa-user"></i><span>Perfil</span>
                </a>
            </li>

            @if ($rol == 1 || $rol == 2)
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo">
                        <i class="fas fa-fw fa-users"></i><span>Usuarios</span>
                    </a>
                    <div id="collapseTwo" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @if ($rol == 1)
                            <a class="collapse-item" href="{{ route('registrar') }}">Añadir Usuario</a>
                            <h6 class="collapse-header">Tipos de Usuarios</h6>
                            <a class="collapse-item" href="{{ route('docente') }}">Docentes</a>
                            @endif
                            <a class="collapse-item" href="{{ route('supervisor') }}">Supervisores</a>
                            <a class="collapse-item" href="{{ route('estudiante') }}">Estudiantes</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    @if($rol == 1)
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3">
                        <i class="fas fa-fw fa-users"></i><span>Asignatura</span>
                    </a>
                    <div id="collapse3" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('asignacion_index') }}">Grupo - Práctica</a>
                            <a class="collapse-item" href="{{ route('estudiante_index') }}">Grupo - Estudiante</a>
                        </div>
                    </div>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('estudiante_index') }}">
                            <i class="fas fa-fw fa-user"></i><span>Grupo - Estudiante</span>
                        </a>
                    </li>
                    @endif

                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bloqueacademico">
                        <i class="bi bi-book-fill"></i><span>Bloque Académico</span>
                    </a>
                    <div id="bloqueacademico" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Bloque Académico:</h6>
                            <a class="collapse-item" href="{{ route('facultad.index') }}">Facultad</a>
                            <a class="collapse-item" href="{{ route('escuela.index') }}">Escuela</a>
                            <a class="collapse-item" href="{{ route('semestre.index') }}">Semestre</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('supervision') }}"><i class="fas fa-fw fa-folder"></i><span>Supervisión - Prácticas</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('Validacion.Matricula') }}"><i class="fas fa-fw fa-user"></i><span>Supervisión - Matrícula</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('empresa') }}"><i class="fas fa-fw fa-chart-area"></i><span>Empresa</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('jefes') }}"><i class="fas fa-fw fa-table"></i><span>Jefes</span></a></li>
            @endif

            @if ($rol == 1 || $rol == 3)
                <li class="nav-item"><a class="nav-link" href="{{ route('estudiante') }}"><i class="fas fa-fw fa-users"></i><span>Lista de Estudiantes</span></a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-pencil-square"></i><span>Evaluación</span></a></li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Datos extra</div>
                <li class="nav-item"><a class="nav-link" href="{{ route('empresa') }}"><i class="fas fa-fw fa-chart-area"></i><span>Empresa</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('jefes') }}"><i class="fas fa-fw fa-table"></i><span>Jefes</span></a></li>
            @endif

            @if ($rol == 1 || $rol == 4)
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Validación de datos</div>
                <li class="nav-item"><a class="nav-link" href="{{ route('matricula_index') }}"><i class="fas fa-address-card"></i><span>Matrícula</span></a></li>
                @if ($practica == 'desarrollo')
                    <li class="nav-item"><a class="nav-link" href="{{ route('desarrollo') }}"><i class="fas fa-fw fa-folder"></i><span>Desarrollo</span></a></li>
                @elseif ($practica == 'convalidacion')
                    <li class="nav-item"><a class="nav-link" href="{{ route('convalidacion') }}"><i class="fas fa-fw fa-folder"></i><span>Convalidación</span></a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('practica') }}"><i class="fas fa-fw fa-folder"></i><span>Prácticas</span></a></li>
                @endif
            @endif

            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
  




        <div id="content-wrapper" class="d-flex flex-column">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
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
                        <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                         
                            <div class="text-left">
                                <div class="text-gray-600 small font-weight-bold">{{ $nombre }} {{ $apellido }}</div>
                                <div class="text-gray-600 small">{{ $codigo }}</div>
                            </div>
                            <i class="fas fa-user fa-lg text-gray-600 ml-3"></i> 
                        </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('cerrarSecion') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                </div>
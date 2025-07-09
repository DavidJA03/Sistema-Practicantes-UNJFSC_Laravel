<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Prácticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2563eb;
            --light-blue: #dbeafe;
            --soft-gray: #f8fafc;
            --border-gray: #e2e8f0;
            --text-gray: #64748b;
            --dark-gray: #334155;
        }

        body {
            background-color: var(--soft-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark-gray);
        }

        .navbar-custom {
            background-color: #f1f5f9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            border-bottom: 1px solid var(--border-gray);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-blue) !important;
            font-size: 1.25rem;
        }

        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
        }

        .welcome-header {
            background: linear-gradient(135deg, var(--primary-blue), #1d4ed8);
            color: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .section-card {
            background: linear-gradient(145deg, #f8fafc, #f1f5f9);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--border-gray);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .section-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            background: linear-gradient(145deg, #f1f5f9, #e2e8f0);
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-custom {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
        }

        .btn-outline-custom {
            color: var(--primary-blue);
            border-color: var(--primary-blue);
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            transform: translateY(-1px);
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--light-blue);
        }

        .info-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-gray);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--text-gray);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: var(--dark-gray);
            font-weight: 500;
            margin-top: 0.25rem;
        }

        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-completed {
            background-color: var(--light-blue);
            color: var(--primary-blue);
        }

        .document-item {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: between;
        }

        .upload-area {
            border: 2px dashed var(--border-gray);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: var(--primary-blue);
            background-color: var(--light-blue);
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>
    @stack('css')
</head>
<body>
    @php
        $user = auth()->user();
        $persona = $user->persona;
        $nombreCompleto = $persona->nombres . ' ' . $persona->apellidos;
    @endphp
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-mortarboard-fill me-2"></i>
                Sistema de Prácticas
            </a>
            
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    @if(auth()->user()->persona->ruta_foto)
                        <img class="img-profile rounded-circle me-2" width="32" height="32" src="{{ asset(auth()->user()->persona->ruta_foto) }}">
                    @else
                        <i class="bi bi-person-circle me-2" alt="Perfil" class="rounded-circle me-2" style="font-size: 32px"></i>
                    @endif
                    <span class="d-none d-md-inline text-muted-semibold">{{ $nombreCompleto }}</span>
                    <i class="bi bi-chevron-down ms-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('cerrarSecion') }}"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>
</html>
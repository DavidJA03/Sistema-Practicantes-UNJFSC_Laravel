<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Prácticas Pre-profesionales</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --light-gray: #f8fafc;
            --border-color: #e2e8f0;
            --text-muted: #64748b;
        }
        
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            position: relative;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #334155;
        }

        /* Contenedor para el fondo */
        .bg-slideshow::before, .bg-slideshow::after {
        content: "";
        position: fixed;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -1;
        animation: fadeSlideshow 10s infinite ease-in-out;
        opacity: 0;
        }

        /* Imagen 1 */
        .bg-slideshow::before {
            background-image: url('{{ asset('img/login-background.jpg') }}');
            animation-delay: 0s;
        }

        /* Imagen 2 */
        .bg-slideshow::after {
            background-image: url('{{ asset('img/bg-UNJFSC-2.jpg') }}');
            animation-delay: 5s;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--border-color);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }
        
        .login-header {
            text-align: center;
            padding: 3rem 2rem 1rem;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        }
        
        .system-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }
        
        .system-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 400;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }
        
        .welcome-message {
            font-size: 0.9rem;
            color: var(--secondary-color);
            line-height: 1.6;
            margin-bottom: 0;
        }
        
        .login-form {
            padding: 1rem 2rem 3rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background-color: #ffffff;
        }
        
        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            letter-spacing: 0.025em;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        
        .btn-primary:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }
        
        .form-links {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .form-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .form-links a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .divider {
            margin: 0.75rem 0;
            color: var(--text-muted);
            font-size: 0.875rem;
        }
        
        @media (max-width: 576px) {
            .login-header {
                padding: 2rem 1.5rem 1rem;
            }
            
            .login-form {
                padding: 1rem 1.5rem 2rem;
            }
            
            .system-title {
                font-size: 1.25rem;
            }
        }

        @keyframes fadeSlideshow {
            0% { opacity: 0; }
            10% { opacity: 1; }
            45% { opacity: 1; }
            55% { opacity: 0; }
            100% { opacity: 0; }
        }
    </style>
</head>

<body class="bg-slideshow">

    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <h1 class="system-title">
                    <i class="bi bi-mortarboard-fill me-2"></i>
                    Sistema de Prácticas
                </h1>
                <img src="{{ asset('img/ins-UNJFSC.png') }}" alt="Logo" class="img-fluid" style="max-width: 120px;">
            </div>

            <!-- Login Form -->
            <div class="login-form">
                @if ($errors->any())
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $item }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope me-1"></i>
                            Correo Institucional / Usuario
                        </label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" required autocomplete="username" autofocus>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock me-1"></i>
                            Contraseña
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                required autocomplete="current-password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        });
    </script>
</body>

</html>

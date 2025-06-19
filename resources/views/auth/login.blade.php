<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión - Sistema</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,900" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }

        .card {
            border-radius: 1rem;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .btn-primary {
            border-radius: 0.5rem;
            font-weight: 600;
        }

        .input-group-text {
            background-color: #f8f9fc;
            border: none;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group .input-group-text i {
            color: #4e73df;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-lg border-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900">Bienvenido</h1>
                                    <p class="text-muted">Ingrese sus credenciales para acceder</p>
                                </div>

                                @if ($errors->any())
                                    @foreach ($errors->all() as $item)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $item }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif

                                <form action="/login" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <input type="email" name="email" class="form-control" placeholder="Correo o Usuario" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.html">¿No tienes cuenta? Crear una</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>

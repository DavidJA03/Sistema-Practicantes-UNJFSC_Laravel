@extends('template')
@section('title', 'Perfil')


@push('css')

@endpush

@section('content')
<style>
    .centrar-vertical {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 100px); /* Ajusta según el header/footer que tengas */
    }
    a.card:hover,
    a.card:focus {
        background-color: transparent !important;
        text-decoration: none;
    }
</style>
<div class="container-fluid centrar-vertical">
<div class="row w-100">
        <div class="col-xl-6 col-lg-6">
            <a class="card card-registro shadow mb-4 d-flex flex-column justify-content-center align-items-center" style="height: 400px;">
                <div class="py-3 text-center mt-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-user" style="font-size: 200px; color: rgb(123, 145, 229);"></i>
                        <h3 class="mt-3 text-primary font-weight-bold"> Añadir un Usuario</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-6 col-lg-6">
            <a class="card card-carga-masiva shadow mb-4 d-flex flex-column justify-content-center align-items-center" style="height: 400px;">
                <div class="py-3 text-center mt-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-users" style="font-size: 200px; color: rgb(123, 145, 229);"></i>
                        <h3 class="mt-3 text-primary font-weight-bold uppercase">Añadir Usuarios</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('js/cuadro_registro_user.js') }}"></script>
    <script src="{{ asset('js/masa_registro_user.js') }}"></script>
    <script>
        function completarCorreo() {
            const codigo = document.getElementById('codigo').value.trim();
            const correoInst = document.getElementById('correo_inst');
            
            if (codigo) {
                correoInst.value = codigo + '@unjfsc.edu.pe';
            } else {
                correoInst.value = '';
            }
        }
    </script>
@endpush

@extends('template')
@section('title', 'Perfil')


@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <p></p>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <a href="{{ route('registrar') }}" class="card card-registro shadow mb-4">
                    <div class="py-3 text-center mt-3">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-user" style="font-size: 300px; color: rgb(123, 145, 229);"></i>
                            <h3 class="mt-3 text-primary font-weight-bold"> Añadir un Usuario</h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-6 col-lg-6">
                <a href="{{ route('registrar') }}" class="card card-carga-masiva shadow mb-4">
                    <div class="py-3 text-center mt-3">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-users" style="font-size: 300px; color: rgb(123, 145, 229);"></i>
                            <h3 class="mt-3 text-primary font-weight-bold uppercase">Añadir Usuarios</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
</div>

<style>
    a.card:hover,
    a.card:focus {
        background-color: transparent !important;
        text-decoration: none;
    }
</style>
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

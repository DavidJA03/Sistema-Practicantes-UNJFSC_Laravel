@extends('template')
@section('title', 'Practicas')


@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf
    @method('POST')
    <div class="row w-100">
        <div class="col-xl-6 col-lg-6">
            <div class="card card-desarrollo shadow mb-4 d-flex flex-column justify-content-center align-items-center"
                 style="height: 400px; cursor: pointer;">
                <div class="py-3 text-center mt-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-laptop-code" style="font-size: 200px; color: rgb(123, 145, 229);"></i>
                        <h3 class="mt-3 text-primary font-weight-bold"> Desarrollo</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <a href="{{ route('convalidacion') }}" class="card card-convalidacion shadow mb-4 d-flex flex-column justify-content-center align-items-center" style="height: 400px;">
                <div class="py-3 text-center mt-3">
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-file-alt" style="font-size: 200px; color: rgb(123, 145, 229);"></i>
                        <h3 class="mt-3 text-primary font-weight-bold uppercase">Convalidacion</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Evento para el card de desarrollo
            document.querySelector('.card-desarrollo').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas continuar con el módulo de Desarrollo?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, continuar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Cargando',
                            html: 'Por favor espera...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        axios.post("{{ route('desarrollo', ['ed' => 1]) }}")
                            .then(response => {
                                // Redirigir solo si se guardó correctamente
                                window.location.href = '/practicas/desarrollo';
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
            });

            // Evento para el card de convalidación
            document.querySelector('.card-convalidacion').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas continuar con el módulo de Convalidación?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, continuar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Cargando',
                            html: 'Por favor espera...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        axios.post("{{ route('desarrollo', ['ed' => 2]) }}")
                            .then(response => {
                                // Redirigir solo si se guardó correctamente
                                window.location.href = '/practicas/convalidacion';
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
            });
        });
    </script>
@endpush

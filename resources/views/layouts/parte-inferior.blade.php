   </div>
    </div>


@stack('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

    <script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>

    <script src="{{ asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>

    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!--
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    paginate: {
                        previous: "Anterior",
                        next: "Siguiente"
                    }
                },
                pageLength: 10,
                dom:
                    "<'row mb-2'<'col-sm-6'l><'col-sm-6'f>>" + // l = length (dropdown), f = filter (search)
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row mt-2'<'col-sm-5'i><'col-sm-7'p>>"     // i = info, p = pagination
            });
        });
    </script>
    -->
 
document.addEventListener('DOMContentLoaded', function () {
    const filtroFacultad = document.getElementById('filtroFacultad');
    const tabla = document.getElementById('tablaEscuelas');
    const btnLimpiarFiltro = document.getElementById('btnLimpiarFiltro');

    function cargarEscuelas(facultadId = '') {
        fetch(`?facultad_id=${facultadId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tabla.innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    }

    filtroFacultad.addEventListener('change', function () {
        cargarEscuelas(this.value);
    });

    btnLimpiarFiltro.addEventListener('click', function () {
        filtroFacultad.value = '';
        cargarEscuelas();
    });

    // Paginación
    document.addEventListener('click', function (e) {
        const target = e.target.closest('.pagination a');
        if (target) {
            e.preventDefault();
            fetch(target.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                tabla.innerHTML = html;
            });
        }
    });
});

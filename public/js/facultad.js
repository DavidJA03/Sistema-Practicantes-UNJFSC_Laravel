document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formNuevaFacultad");
    const tabla = document.getElementById("tablaFacultades");
    const filtro = document.getElementById("filtroFacultad");
    const perPageSelect = document.getElementById("perPageSelect");
    let registroExitoso = false;

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const nameError = document.getElementById("nameError");
            nameError.textContent = '';

            fetch("/facultad", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    if (data.errors?.name) {
                        nameError.textContent = data.errors.name[0];
                    }
                    throw new Error("Validación fallida");
                }

                // Cerrar el modal y reiniciar el formulario
                const modal = bootstrap.Modal.getInstance(document.getElementById("nuevaFacultadModal"));
                modal.hide();
                form.reset();

                registroExitoso = true; // Marcar como exitoso

                // Notificación
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: data.message || 'Facultad registrada correctamente.',
                    showConfirmButton: false,
                    timer: 2000
                });

            })
            .catch(error => console.error("Error:", error));
        });
    }

    document.addEventListener("click", function (e) {
        if (e.target.closest(".btn-editar")) {
            const button = e.target.closest(".btn-editar");
            const id = button.dataset.id;
            const name = button.dataset.name;

            document.getElementById("editFacultadId").value = id;
            document.getElementById("editFacultadNombre").value = name;
        }
    });

    document.getElementById("formEditarFacultad").addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("editFacultadId").value;
        const name = document.getElementById("editFacultadNombre").value;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/facultad/${id}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                "Accept": "application/json"
            },
            body: JSON.stringify({ name })
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) throw new Error("Error al actualizar");

            const modal = bootstrap.Modal.getInstance(document.getElementById("editarFacultadModal"));
            modal.hide();
            document.getElementById(`nombre-${id}`).textContent = name;

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Facultad actualizada correctamente.',
                showConfirmButton: false,
                timer: 2000
            });
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire('Error', 'No se pudo actualizar', 'error');
        });
    });

    const cargarFacultades = (query = '', cantidad = 10) => {
        fetch(`?search=${encodeURIComponent(query)}&cantidad=${cantidad}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            tabla.innerHTML = html;
            reinicializarModales();
        });
    };

    if (filtro) {
        filtro.addEventListener("input", function () {
            cargarFacultades(this.value, perPageSelect.value);
        });
    }

    if (perPageSelect) {
        perPageSelect.addEventListener("change", function () {
            cargarFacultades(filtro.value, this.value);
        });
    }

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
                reinicializarModales();
            });
        }
    });

    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (form.matches('.form-eliminar')) {
            e.preventDefault();
            const facultadId = form.dataset.id;
            const fila = document.getElementById(`fila-${facultadId}`);
            const modalElement = document.getElementById(`confirmModal-${facultadId}`);
            const modal = bootstrap.Modal.getInstance(modalElement);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ '_method': 'DELETE' })
            })
            .then(response => {
                if (!response.ok) throw new Error('Error al eliminar');
                if (modal) modal.hide();
                if (fila) fila.remove();

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Facultad eliminada correctamente.',
                    showConfirmButton: false,
                    timer: 2000
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'No se pudo eliminar la facultad', 'error');
            });
        }
    });

    function reinicializarModales() {
        document.querySelectorAll('.modal').forEach(modal => new bootstrap.Modal(modal));
    }

    // Cuando se cierre el modal de nueva facultad, actualizar si se registró algo
    const nuevaFacultadModal = document.getElementById("nuevaFacultadModal");
    nuevaFacultadModal.addEventListener('hidden.bs.modal', function () {
        if (registroExitoso) {
            cargarFacultades(filtro.value, perPageSelect.value);
            registroExitoso = false;
        }
    });
});

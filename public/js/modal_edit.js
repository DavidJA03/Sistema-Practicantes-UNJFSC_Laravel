// Función para inicializar los event listeners del modal
function inicializarEventListeners() {
    // Evento para el botón editar
    const editarBtn = document.getElementById('btnEditar');
    if (editarBtn) {
        editarBtn.addEventListener('click', function() {
            const formInputs = document.querySelectorAll('#formEditPersona input, #formEditPersona select');
            
            // Guarda los valores originales
            const originalValues = {};
            formInputs.forEach(input => {
                originalValues[input.id] = input.value;
            });
            
            // Cambia el estado
            const editing = !editarBtn.classList.contains('btn-warning');
            
            if (editing) {
                // Activar campos
                formInputs.forEach(input => input.disabled = false);
                document.getElementById('btnActualizar').classList.remove('d-none');
                editarBtn.innerHTML = '<i class="fas fa-times"></i> Cancelar';
                editarBtn.classList.remove('btn-info');
                editarBtn.classList.add('btn-warning');
            } else {
                // Restaurar campos
                formInputs.forEach(input => {
                    input.disabled = true;
                    input.value = originalValues[input.id];
                });
                document.getElementById('btnActualizar').classList.add('d-none');
                editarBtn.innerHTML = '<i class="fas fa-edit"></i> Editar';
                editarBtn.classList.remove('btn-warning');
                editarBtn.classList.add('btn-info');
            }
        });
    }

    // Evento para el botón actualizar
    const actualizarBtn = document.getElementById('btnActualizar');
    if (actualizarBtn) {
        actualizarBtn.addEventListener('click', function() {
            // Aquí iría la lógica de actualización
        });
    }

    // Evento para el botón cancelar
    const cancelarBtn = document.getElementById('btnCancelar');
    if (cancelarBtn) {
        cancelarBtn.addEventListener('click', function() {
            // Aquí iría la lógica de cancelar
        });
    }
}

// Función para resetear el estado del modal
function resetearEstadoModal() {
    // Restaurar todos los campos a readonly
    const formInputs = document.querySelectorAll('#formEditPersona input[type="text"], #formEditPersona input[type="email"], #formEditPersona input[type="tel"], #formEditPersona select');
    formInputs.forEach(input => {
        input.setAttribute('readonly', true);
    });
    
    // Mostrar botón editar y ocultar actualizar
    document.getElementById('btnEditar').classList.remove('btn-warning');
    document.getElementById('btnEditar').classList.add('btn-info');
    document.getElementById('btnEditar').innerHTML = '<i class="fas fa-edit"></i> Editar';
    document.getElementById('btnActualizar').classList.add('d-none');
}

// Inicializar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    inicializarEventListeners();
    
    // Manejar todos los eventos de cierre del modal
    $(document).on('hidden.bs.modal', '#modalEditar', resetearEstadoModal);
    $(document).on('hide.bs.modal', '#modalEditar', resetearEstadoModal);
});

// También inicializar cuando se muestre el modal
$(document).on('shown.bs.modal', '#modalEditar', inicializarEventListeners);
async function cargarDatosPersona(personaId) {
    try {
        const response = await fetch(`/personas/${personaId}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error al cargar datos del docente:', error);
        return null;
    }
}

async function cargarProvincias() {
    try {
        const response = await fetch('/data/provincias.json');
        const data = await response.json();
        const provinciaSelect = document.getElementById('provincia');
    
        // Limpiar el select
        provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';
    
        // Agregar las provincias
        data.provincias.forEach(provincia => {
            const option = document.createElement('option');
            option.value = provincia.id;
            option.textContent = provincia.nombre;
            provinciaSelect.appendChild(option);
        });
    
        // Habilitar el select de provincia
        provinciaSelect.disabled = false;
    } catch (error) {
        console.error('Error al cargar provincias:', error);
    }
}

// Función para cargar distritos según la provincia seleccionada
async function cargarDistritos(provinciaId) {
    try {
        const response = await fetch('/data/distritos.json');
        const data = await response.json();
        const distritoSelect = document.getElementById('distrito');
        
        // Limpiar el select
        distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';
        
        // Agregar los distritos de la provincia seleccionada
        if (data.distritos[provinciaId]) {
            data.distritos[provinciaId].forEach(distrito => {
                const option = document.createElement('option');
                option.value = distrito.id;
                option.textContent = distrito.nombre;
                distritoSelect.appendChild(option);
            });
            
            // Habilitar el select de distrito
            distritoSelect.disabled = false;
        }
    } catch (error) {
        console.error('Error al cargar distritos:', error);
    }
}

document.addEventListener('DOMContentLoaded', async function () {
    // Cargar datos iniciales
    const personaId = document.getElementById('persona_id').value;
    const persona = await cargarDatosPersona(personaId);
    if (persona) {
        // Cargar provincias
        await cargarProvincias();
        const provinciaSelect = document.getElementById('provincia');
        provinciaSelect.value = persona.provincia;

        // Cargar distritos
        await cargarDistritos(persona.provincia);
        const distritoSelect = document.getElementById('distrito');
        distritoSelect.value = persona.distrito;
    }

    // Inicializar botones y form
    const editBtn = document.getElementById('perfEdit');
    const updateBtn = document.getElementById('perfUpdate');
    const formInputs = document.querySelectorAll('#codigo, #dni, #celular, #nombres, #apellidos, #correo_inst, #departamento, #provincia, #distrito');

    // Guarda los valores originales
    const originalValues = {};
    formInputs.forEach(input => {
        originalValues[input.id] = input.value;
    });

    let editing = false;

    editBtn.addEventListener('click', function () {
        editing = !editing; // alterna el estado

        if (editing) {
            // Activar campos
            formInputs.forEach(input => input.removeAttribute('readonly'));
            updateBtn.classList.remove('d-none');
            editBtn.innerHTML = '<i class="fas fa-times"></i> Cancelar';
            editBtn.classList.remove('btn-info');
            editBtn.classList.add('btn-warning');
        } else {
            // Restaurar campos
            formInputs.forEach(input => {
                input.setAttribute('readonly', true);
                input.value = originalValues[input.id];
            });
            updateBtn.classList.add('d-none');
            editBtn.innerHTML = '<i class="fas fa-edit"></i> Editar';
            editBtn.classList.remove('btn-warning');
            editBtn.classList.add('btn-info');
        }
    });

    document.getElementById('provincia').addEventListener('change', function() {
        const provinciaId = this.value;
        cargarDistritos(provinciaId);
    });

    updateBtn.addEventListener('click', async function() {
        const formData = new FormData(document.getElementById('formEditPerfil'));
        
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            
            const personaId = document.getElementById('persona_id').value;
            const response = await fetch(`/segmento/actualizar_perfil/${personaId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            
            const data = await response.json();

            if (data.success) {
                alert('Persona editada exitosamente');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        } catch (error) {
            console.error('Error en la petición:', error);
            alert('Error al registrar la persona. Por favor, inténtelo de nuevo.');
        }
    });
});
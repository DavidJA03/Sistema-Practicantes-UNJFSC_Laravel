// Función para cargar el modal usando AJAX
async function cargarModal() {
    try {
        const response = await fetch('/segmento/modal-registro');
        const modalHtml = await response.text();
        return modalHtml;
    } catch (error) {
        console.error('Error al cargar el modal:', error);
        return '';
    }
}

// Función para cargar provincias
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

// Inicializar el modal
async function inicializarModal() {
    const modalHtml = await cargarModal();
    if (modalHtml) {
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        // Evento para mostrar el modal al hacer clic en los cards
        const cardRegistro = document.querySelector('.card-registro');
        if (cardRegistro) {
            cardRegistro.addEventListener('click', function (e) {
                e.preventDefault();
                $('#modalRegistro').modal('show');
                cargarProvincias();
            });
        }

        // Evento para cargar distritos cuando se selecciona una provincia
        document.getElementById('provincia').addEventListener('change', function() {
            const provinciaId = this.value;
            cargarDistritos(provinciaId);
        });

        // Evento para registrar el usuario
        document.getElementById('btnRegistrar').addEventListener('click', async function() {
            const formData = new FormData(document.getElementById('formRegistro'));
            
            try {
                // Obtener el token CSRF
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                
                const response = await fetch('/personas', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('Persona registrada exitosamente');
                    $('#modalRegistro').modal('hide');
                    // Limpiar el formulario
                    document.getElementById('formRegistro').reset();
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
                alert('Error al registrar la persona. Por favor, inténtelo de nuevo.');
            }
        });
    }
}

// Iniciar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', inicializarModal);;
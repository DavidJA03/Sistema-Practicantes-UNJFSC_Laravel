async function cargarModal() {
    try {
        const response = await fetch('/list_users/editar');
        const modalHtml = await response.text();
        return modalHtml;
    } catch (error) {
        console.error('Error al cargar el modal:', error);
        return '';
    }
}

async function inicializarModal() {
    const modalHtml = await cargarModal();

    if (modalHtml && !document.getElementById('modalEditar')) {
        document.body.insertAdjacentHTML('beforeend', modalHtml);
    }

    // Inicializar DataTable solo una vez
    const table = $('#dataTable').DataTable();

    // Función que actualiza los event listeners de los botones de editar
    function inicializarEventListeners() {
        document.querySelectorAll('.icon-mostrar').forEach(btn => {
            btn.removeEventListener('click', mostrarModal); // Limpia duplicados
            btn.addEventListener('click', mostrarModal);
        });
    }

    // Inicializar los listeners inicialmente
    inicializarEventListeners();

    // Volver a inicializarlos en cada cambio de página de DataTables
    table.on('draw', function () {
        inicializarEventListeners();
    });
}


async function mostrarModal(e) {
    e.preventDefault();
    const personaId = this.dataset.personaId;
    
    try {
        // Primero cargar los datos
        const response = await fetch(`/personas/${personaId}`);
        if (!response.ok) {
            throw new Error('Error al cargar los datos');
        }
        
        const persona = await response.json();
        
        // Llenar el formulario con los datos existentes
        document.getElementById('persona_id').value = persona.id;
        document.getElementById('codigo').value = persona.codigo;
        document.getElementById('nombres').value = persona.nombres;
        document.getElementById('apellidos').value = persona.apellidos;
        document.getElementById('dni').value = persona.dni;
        document.getElementById('correo_inst').value = persona.correo_inst;
        document.getElementById('celular').value = persona.celular;
        document.getElementById('sexo').value = persona.sexo;
        document.getElementById('departamento').value = persona.departamento;
        document.getElementById('provincia').value = persona.provincia;
        document.getElementById('distrito').value = persona.distrito;
        

        // Inicializar los event listeners del modal
        inicializarEventListeners();
        // Mostrar el modal después de cargar los datos
        $('#modalEditar').modal('show');
    } catch (error) {
        console.error('Error al cargar los datos:', error);
        alert('Error al cargar los datos del usuario');
    }
}

// Iniciar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', inicializarModal);

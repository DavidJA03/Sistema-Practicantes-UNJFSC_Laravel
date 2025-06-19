async function cargarModal() {
    try {
        const response = await fetch('/list_users/modal-editar');
        const modalHtml = await response.text();
        return modalHtml;
    } catch (error) {
        console.error('Error al cargar el modal:', error);
        return '';
    }
}

async function cargarDatosDocente(id) {
    try {
        const response = await fetch(`/personas/${id}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error al cargar datos del docente:', error);
        return null;
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

async function inicializarModal() {
    const modalHtml = await cargarModal();
    if (modalHtml) {
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().destroy();
        }
        // Inicializar DataTables
        const table = $('#dataTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100]
        });

        // Evento para mostrar el modal al hacer clic en los botones mostrar
        $('#dataTable').on('click', '.btn-mostrar', async function(e) {
            e.preventDefault();
            const docenteId = $(this).closest('tr').data('docente-id');
            if (docenteId) {
                const docente = await cargarDatosDocente(docenteId);
                if (docente) {
                    const originalValues = {};
                    formInputs.forEach(input => {
                        originalValues[input.id] = input.value;
                    });
                    // Llenar los campos del modal con los datos del docente
                    document.getElementById('codigo').value = docente.codigo;
                    document.getElementById('nombres').value = docente.nombres;
                    document.getElementById('apellidos').value = docente.apellidos;
                    document.getElementById('dni').value = docente.dni;
                    document.getElementById('correo_inst').value = docente.correo_inst;
                    document.getElementById('celular').value = docente.celular;
                    document.getElementById('sexo').value = docente.sexo;
                    document.getElementById('persona_id').value = docente.id;
                    
                    // Cargar provincias y distritos
                    await cargarProvincias();
                    
                    // Establecer la provincia
                    const provinciaSelect = document.getElementById('provincia');
                    provinciaSelect.value = docente.provincia;
                    
                    // Cargar distritos correspondientes
                    await cargarDistritos(docente.provincia);
                    
                    // Establecer el distrito
                    const distritoSelect = document.getElementById('distrito');
                    distritoSelect.value = docente.distrito;
                    
                    $('#modalEditar').modal('show');
                }
            }
        });

        // Evento para cargar distritos cuando se selecciona una provincia
        document.getElementById('provincia').addEventListener('change', function() {
            const provinciaId = this.value;
            cargarDistritos(provinciaId);
        });
        const editBtn = document.getElementById('btnEditar');
        const updateBtn = document.getElementById('btnUpdate');
        const formInputs = document.querySelectorAll('#codigo, #dni, #celular, #nombres, #apellidos, #correo_inst, #departamento, #provincia, #distrito, #sexo');

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
                });
                updateBtn.classList.add('d-none');
                editBtn.innerHTML = '<i class="fas fa-edit"></i> Editar';
                editBtn.classList.remove('btn-warning');
                editBtn.classList.add('btn-info');
            }
        });

        // Evento para editar el usuario
        updateBtn.addEventListener('click', async function() {
            const formData = new FormData(document.getElementById('formEditPersona'));
            
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                
                const response = await fetch(`/list_users/modal-editar/${formData.get('persona_id')}`, {
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
                    $('#modalEditar').modal('hide');

                // Espera a que se cierre completamente el modal antes de recargar
                $('#modalEditar').on('hidden.bs.modal', function () {
                    location.reload();
                });
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
document.addEventListener('DOMContentLoaded', inicializarModal);
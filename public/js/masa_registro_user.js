// Función para cargar el modal usando AJAX
async function cargarModalMasivo() {
    try {
        const response = await fetch('/segmento/modal-carga-masiva');
        const modalHtml = await response.text();
        return modalHtml;
    } catch (error) {
        console.error('Error al cargar el modal:', error);
        return '';
    }
}

// Inicializar el modal
async function inicializarModalMasivo() {
    const modalHtml = await cargarModalMasivo();
    if (modalHtml) {
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        // Evento para mostrar el modal al hacer clic en los cards
        const cardCargaMasiva = document.querySelector('.card-carga-masiva');
        if (cardCargaMasiva) {
            cardCargaMasiva.addEventListener('click', function (e) {
                e.preventDefault();
                //console.log("Click en carga masiva"); // Para depurar
                $('#modalCargaMasiva').modal('show');
            });
        }

        // Obtener los roles del servidor
        fetch('/roles')
            .then(response => response.json())
            .then(roles => {
                const select = document.getElementById('rol');
                select.innerHTML = '<option value="">Seleccione un tipo de usuario</option>';
                
                roles.forEach(rol => {
                    const option = document.createElement('option');
                    option.value = rol.id;
                    option.textContent = rol.name;
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar los roles:', error);
                alert('Error al cargar los tipos de usuario. Por favor, inténtelo de nuevo.');
            });

        document.getElementById('btnCargar').addEventListener('click', async function() {
            const formData = new FormData(document.getElementById('formUsuarioMasivo'));
            
            try {
                // Obtener el token CSRF
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                
                const response = await fetch('/usuarios-masivos', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('Usuarios cargados exitosamente\n\n' + 
                        'Total usuarios creados: ' + data.usuariosCreados + 
                        (data.errores.length > 0 ? '\n\nErrores encontrados:\n' + data.errores.join('\n') : ''));
                    $('#modalCargaMasiva').modal('hide');
                    document.getElementById('formUsuarioMasivo').reset();
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error en la petición:', error);
                alert('Error al cargar los usuarios. Por favor, inténtelo de nuevo.');
            }
        });

        //document.getElementById('archivo').addEventListener('change', function(e) {
            //const archivo = e.target.files[0];
            //if (archivo) {
                //const extension = archivo.name.split('.').pop().toLowerCase();
                //if (extension !== 'csv') {
                    //alert('Solo se permiten archivos CSV');
                    //e.target.value = '';
                    //return;
                //}
                
                // Verificar el tamaño del archivo (2MB máximo)
                //if (archivo.size > 2 * 1024 * 1024) {
                    //alert('El archivo es demasiado grande (máximo 2MB)');
                    //e.target.value = '';
                    //return;
                //}
            //}
        //});
    }
}

// Iniciar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', inicializarModalMasivo);
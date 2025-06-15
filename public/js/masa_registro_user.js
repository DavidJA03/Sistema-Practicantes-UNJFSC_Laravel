// Función para cargar el modal usando AJAX
async function cargarModalMasivo() {
    try {
        console.log('Intentando cargar el modal...');
        const response = await fetch('/segmento/modal-carga-masiva');
        if (!response.ok) {
            console.error('Error en la respuesta del servidor:', response.status, response.statusText);
            throw new Error('Error al cargar el modal');
        }
        const modalHtml = await response.text();
        console.log('Modal cargado exitosamente');
        return modalHtml;
    } catch (error) {
        console.error('Error al cargar el modal:', error);
        throw error;
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
                console.log("Click en carga masiva"); // Para depurar
                $('#modalCargaMasiva').modal('show');
            });
        }

        document.getElementById('btnCargar').addEventListener('click', async function() {
            const formData = new FormData(document.getElementById('formUsuarioMasivo'));
            
            try {
                // Obtener el token CSRF
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                
                const response = await fetch('/usuarios-masivos', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();

                if (data.success) {
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
    }
}

// Iniciar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', inicializarModalMasivo);
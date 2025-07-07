function completarCorreo() {
    const codigo = document.getElementById('codigo').value.trim();
    const correoInst = document.getElementById('correo_inst');
    
    if (codigo) {
        correoInst.value = codigo + '@unjfsc.edu.pe';
    } else {
        correoInst.value = '';
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

// Iniciar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    cargarProvincias();
    document.getElementById('provincia').addEventListener('change', function() {
        cargarDistritos(this.value);
    });

    function aplicarLogicaFacultadEscuela(facultadID, escuelaID) {
        const facultadSelect = document.getElementById(facultadID);
        const escuelaSelect = document.getElementById(escuelaID);

        facultadSelect.addEventListener('change', function () {
            const facultadIdSeleccionada = this.value;

            if (!facultadIdSeleccionada) {
                escuelaSelect.disabled = true;
                escuelaSelect.value = "";
                Array.from(escuelaSelect.options).forEach(option => option.hidden = true);
                return;
            }

            escuelaSelect.disabled = false;

            Array.from(escuelaSelect.options).forEach(option => {
                const facultadDeEscuela = option.getAttribute('data-facultad');

                if (option.value === "") {
                    option.hidden = false;
                } else {
                    option.hidden = facultadDeEscuela !== facultadIdSeleccionada;
                }
            });

            escuelaSelect.value = "";
        });
    }

    // Aplicar lógica a ambos combos
    aplicarLogicaFacultadEscuela('facultadRegistro', 'escuelaRegistro');
    aplicarLogicaFacultadEscuela('facultadMasiva', 'escuelaMasiva');

});
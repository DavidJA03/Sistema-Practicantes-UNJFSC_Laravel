async function cargarProvincias(selected = null) {
    try {
        const response = await fetch('/data/provincias.json');
        const data = await response.json();
        const provinciaSelect = document.getElementById('provincia');

        provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';

        data.provincias.forEach(provincia => {
            const option = document.createElement('option');
            option.value = provincia.id;
            option.textContent = provincia.nombre;
            if (selected && provincia.id == selected) {
                option.selected = true;
            }
            provinciaSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error al cargar provincias:', error);
    }
}

async function cargarDistritos(provinciaId, selected = null) {
    try {
        const response = await fetch('/data/distritos.json');
        const data = await response.json();
        const distritoSelect = document.getElementById('distrito');

        distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';

        if (data.distritos[provinciaId]) {
            data.distritos[provinciaId].forEach(distrito => {
                const option = document.createElement('option');
                option.value = distrito.id;
                option.textContent = distrito.nombre;
                if (selected && distrito.id == selected) {
                    option.selected = true;
                }
                distritoSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error al cargar distritos:', error);
    }
}

document.addEventListener('DOMContentLoaded', async function () {
    // Obtener los valores preestablecidos desde los atributos data-valor
    const provinciaValue = document.getElementById('provincia').dataset.valor;
    const distritoValue = document.getElementById('distrito').dataset.valor;

    // Cargar provincias y distritos con selección inicial
    await cargarProvincias(provinciaValue);
    await cargarDistritos(provinciaValue, distritoValue);

    // Botones y campos
    const editBtn = document.getElementById('perfEdit');
    const updateBtn = document.getElementById('perfUpdate');

    const formInputs = document.querySelectorAll(
        '#codigo, #dni, #celular, #nombres, #apellidos, #correo_inst'
    );

    const provinciaSelect = document.getElementById('provincia');
    const distritoSelect = document.getElementById('distrito');

    const originalValues = {};
    formInputs.forEach(input => originalValues[input.id] = input.value);
    originalValues['provincia'] = provinciaSelect.value;
    originalValues['distrito'] = distritoSelect.value;

    let editing = false;

    editBtn.addEventListener('click', function () {
        editing = !editing;

        if (editing) {
            formInputs.forEach(input => input.removeAttribute('disabled'));
            provinciaSelect.disabled = false;
            distritoSelect.disabled = false;

            updateBtn.classList.remove('d-none');
            editBtn.innerHTML = '<i class="fas fa-times"></i> Cancelar';
            editBtn.classList.remove('btn-info');
            editBtn.classList.add('btn-warning');
        } else {
            formInputs.forEach(input => {
                input.setAttribute('disabled', true);
                input.value = originalValues[input.id];
            });

            provinciaSelect.value = originalValues['provincia'];
            cargarDistritos(originalValues['provincia'], originalValues['distrito']);

            provinciaSelect.disabled = true;
            distritoSelect.disabled = true;

            updateBtn.classList.add('d-none');
            editBtn.innerHTML = '<i class="fas fa-edit"></i> Editar';
            editBtn.classList.remove('btn-warning');
            editBtn.classList.add('btn-info');
        }
    });

    provinciaSelect.addEventListener('change', function () {
        const newProvinciaId = this.value;
        cargarDistritos(newProvinciaId);
    });
});

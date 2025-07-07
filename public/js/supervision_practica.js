
document.addEventListener("DOMContentLoaded", function () {
    const etapa1 = document.getElementById("etapa1");
    const etapa2 = document.getElementById("etapa2");
    const etapa3 = document.getElementById("etapa3");

    const btnEtapa2 = document.getElementById("btnEtapa2");
    const btnEtapa3 = document.getElementById("btnEtapa3");

    btnEtapa2?.addEventListener("click", () => {
        etapa1.style.display = "none";
        etapa2.style.display = "block";
        etapa3.style.display = "none";
    });

    btnEtapa3?.addEventListener("click", () => {
        etapa1.style.display = "none";
        etapa2.style.display = "none";
        etapa3.style.display = "block";
    });

    document.querySelectorAll(".btn-regresar-etapa1").forEach(btn => {
        btn.addEventListener("click", () => {
            etapa1.style.display = "block";
            etapa2.style.display = "none";
            etapa3.style.display = "none";
        });
    });

    document.querySelectorAll(".btn-regresar-etapa2").forEach(btn => {
        btn.addEventListener("click", () => {
            etapa1.style.display = "block";
            etapa2.style.display = "none";
            etapa3.style.display = "none";
        });
    });

    const modalProceso = document.getElementById('modalProceso');

    modalProceso.addEventListener('show.bs.modal', async function (event) {
        const button = event.relatedTarget;
        const idPractica = button.getAttribute('data-id_practica');

        try {
            const response = await fetch(`/practica/${idPractica}`);
            const data = await response.json();

            // Mostrar estado
            const estado = parseInt(data.estado) || 1;
            actualizarBotones(estado);
            actualizarFormularios(estado);

            // Mostrar sección según tipo práctica
            const esDesarrollo = data.tipo_practica === 'desarrollo';
            document.getElementById('seccion-desarrollo-E2').style.display = esDesarrollo ? 'block' : 'none';
            document.getElementById('seccion-convalidacion-E2').style.display = esDesarrollo ? 'none' : 'block';
            document.getElementById('seccion-desarrollo-E3').style.display = esDesarrollo ? 'block' : 'none';
            document.getElementById('seccion-convalidacion-E3').style.display = esDesarrollo ? 'none' : 'block';

            // IDs para formularios
            ['idE1', 'idE2', 'idE3', 'idE4'].forEach(id => {
                document.getElementById(id).value = data.id;
            });

            // Empresa
            document.getElementById('modal-nombre-empresa').textContent = data.empresa?.nombre || '';
            document.getElementById('modal-ruc-empresa').textContent = data.empresa?.ruc || '';
            document.getElementById('modal-razon_social-empresa').textContent = data.empresa?.razon_social || '';
            document.getElementById('modal-direccion-empresa').textContent = data.empresa?.direccion || '';
            document.getElementById('modal-telefono-empresa').textContent = data.empresa?.telefono || '';
            document.getElementById('modal-email-empresa').textContent = data.empresa?.correo || '';
            document.getElementById('modal-sitio_web-empresa').textContent = data.empresa?.web || '';

            // Jefe inmediato
            document.getElementById('modal-name-jefe').textContent = data.jefe_inmediato?.nombres || '';
            document.getElementById('modal-area-jefe').textContent = data.jefe_inmediato?.area || '';
            document.getElementById('modal-cargo-jefe').textContent = data.jefe_inmediato?.cargo || '';
            document.getElementById('modal-dni-jefe').textContent = data.jefe_inmediato?.dni || '';
            document.getElementById('modal-sitio_web-jefe').textContent = data.jefe_inmediato?.web || '';
            document.getElementById('modal-telefono-jefe').textContent = data.jefe_inmediato?.telefono || '';
            document.getElementById('modal-email-jefe').textContent = data.jefe_inmediato?.correo || '';

            // Rutas de archivos
            document.getElementById('btn-ruta-fut').href = data.ruta_fut || '';
            document.getElementById('btn-ruta-plan-actividades').href = data.ruta_plan_actividades || '';
            document.getElementById('btn-ruta-informe-final').href = data.ruta_informe_final || '';
            document.getElementById('btn-ruta-constancia-cumplimiento').href = data.ruta_constancia_cumplimiento || '';
            document.getElementById('btn-ruta-carta-aceptacion-C2').href = data.ruta_carta_aceptacion || '';
            document.getElementById('btn-ruta-carta-aceptacion-E3').href = data.ruta_carta_aceptacion || '';
            document.getElementById('btn-ruta-carta-presentacion').href = data.ruta_carta_presentacion || '';
            document.getElementById('btn-ruta-registro-actividades').href = data.ruta_registro_actividades || '';
            document.getElementById('btn-ruta-control-mensual-actividades').href = data.ruta_control_actividades || '';

        } catch (error) {
            console.error('Error al obtener datos:', error);
        }
    });

    // Mostrar primera etapa por defecto
    modalProceso.addEventListener("show.bs.modal", () => {
        document.querySelectorAll('.form-etapa').forEach(form => {
            form.querySelectorAll('select, button, input').forEach(el => {
                el.removeAttribute('disabled');
                el.classList.remove('disabled');
                el.style.opacity = '1';
            });
            form.style.opacity = '1';
        });

        document.getElementById("primeraetapa").style.display = "block";
        document.getElementById("segundaetapa").style.display = "none";
        document.getElementById("terceraetapa").style.display = "none";
        document.getElementById("cuartaetapa").style.display = "none";
    });
});

// Control de botones por etapa
document.addEventListener("DOMContentLoaded", function () {
    const botones = {
        1: document.getElementById("btn1"),
        2: document.getElementById("btn2"),
        3: document.getElementById("btn3"),
        4: document.getElementById("btn4")
    };

    const etapas = {
        1: document.getElementById("primeraetapa"),
        2: document.getElementById("segundaetapa"),
        3: document.getElementById("terceraetapa"),
        4: document.getElementById("cuartaetapa")
    };

    function ocultarTodo() {
        Object.values(etapas).forEach(etapa => etapa.style.display = "none");
    }

    function mostrarEtapa(n) {
        ocultarTodo();
        etapas[n].style.display = "block";
    }

    Object.entries(botones).forEach(([num, btn]) => {
        btn.addEventListener("click", () => mostrarEtapa(Number(num)));
    });
});

function actualizarBotones(estadoActual) {
    document.querySelectorAll('.btn-etapa').forEach(boton => {
        const estadoBoton = parseInt(boton.getAttribute('data-estado')) || 1;

        if (estadoBoton <= estadoActual) {
            boton.classList.remove('btn-secondary', 'btn-disabled');
            boton.classList.add('btn-info');
            boton.removeAttribute('disabled');
            boton.style.opacity = '1';
            boton.style.cursor = 'pointer';
        } else {
            boton.classList.remove('btn-info');
            boton.classList.add('btn-secondary', 'btn-disabled');
            boton.setAttribute('disabled', 'disabled');
            boton.style.opacity = '0.6';
            boton.style.cursor = 'not-allowed';
        }
    });
}

function actualizarFormularios(estadoActual) {
    document.querySelectorAll('.form-etapa').forEach(formulario => {
        const estadoFormulario = parseInt(formulario.getAttribute('data-estado')) || 1;
        const elementos = formulario.querySelectorAll('select, button');

        if (estadoFormulario === estadoActual) {
            formulario.classList.remove('disabled');
            formulario.style.opacity = '1';
            elementos.forEach(el => {
                el.removeAttribute('disabled');
                el.classList.remove('disabled');
            });
        } else {
            formulario.classList.add('disabled');
            formulario.style.opacity = '0.6';
            elementos.forEach(el => {
                el.setAttribute('disabled', 'disabled');
                el.classList.add('disabled');
            });
        }
    });
}

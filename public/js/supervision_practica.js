document.addEventListener("DOMContentLoaded", function () {
    const etapa1 = document.getElementById("etapa1");
    const etapa2 = document.getElementById("etapa2");
    const etapa3 = document.getElementById("etapa3");

    const btnEtapa2 = document.getElementById("btnEtapa2");
    const btnEtapa3 = document.getElementById("btnEtapa3");

    // Mostrar Etapa 2
    btnEtapa2?.addEventListener("click", function () {
        etapa1.style.display = "none";
        etapa2.style.display = "block";
        etapa3.style.display = "none";
    });

    // Mostrar Etapa 3
    btnEtapa3?.addEventListener("click", function () {
        etapa1.style.display = "none";
        etapa2.style.display = "none";
        etapa3.style.display = "block";
    });

    // Regresar a Etapa 1
    document.querySelectorAll(".btn-regresar-etapa1").forEach(btn => {
        btn.addEventListener("click", function () {
            etapa1.style.display = "block";
            etapa2.style.display = "none";
            etapa3.style.display = "none";
        });
    });

    // Regresar a Etapa 2
    document.querySelectorAll(".btn-regresar-etapa2").forEach(btn => {
        btn.addEventListener("click", function () {
            etapa1.style.display = "block";
            etapa2.style.display = "none";
            etapa3.style.display = "none";
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const modalProceso = document.getElementById('modalProceso');

    modalProceso.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id_practica = button.getAttribute('data-id_practica');
        const estado = button.getAttribute('data-estado');

        if (estado == '1') {
            actualizarBotones(1);
            actualizarFormularios(1);
        } else if (estado == '2') {
            actualizarBotones(2);
            actualizarFormularios(2);
        } else if (estado == '3') {
            actualizarBotones(3);
            actualizarFormularios(3);
        } else if (estado == '4') {
            actualizarBotones(4);
            actualizarFormularios(4);
        } else {
            actualizarBotones(4);
        }

        const tipo_practica = button.getAttribute('data-tipo_practica');
        if (tipo_practica == 'desarrollo') {
            document.getElementById('seccion-desarrollo-E2').style.display = "block";
            document.getElementById('seccion-convalidacion-E2').style.display = "none";
            document.getElementById('seccion-desarrollo-E3').style.display = "block";
            document.getElementById('seccion-convalidacion-E3').style.display = "none";
        } else {
            document.getElementById('seccion-desarrollo-E2').style.display = "none";
            document.getElementById('seccion-convalidacion-E2').style.display = "block";
            document.getElementById('seccion-desarrollo-E3').style.display = "none";
            document.getElementById('seccion-convalidacion-E3').style.display = "block";
        }

        const nombre = button.getAttribute('data-nombre');
        const ruc = button.getAttribute('data-ruc');
        const razon_social = button.getAttribute('data-razon_social');
        const direccion = button.getAttribute('data-direccion');
        const telefono = button.getAttribute('data-telefono');
        const email = button.getAttribute('data-email');
        const sitio_web = button.getAttribute('data-sitio_web');

        const jefe_inmediato = button.getAttribute('data-jefe_inmediato');
        const area_jefe = button.getAttribute('data-area-jefe');
        const cargo_jefe = button.getAttribute('data-cargo-jefe');
        const dni_jefe = button.getAttribute('data-dni-jefe');
        const web_jefe = button.getAttribute('data-web-jefe');
        const telefono_jefe = button.getAttribute('data-telefono-jefe');
        const email_jefe = button.getAttribute('data-email-jefe');

        const ruta_fut = button.getAttribute('data-ruta_fut');
        const ruta_plan_actividades = button.getAttribute('data-ruta_plan_actividades');
        const ruta_informe_final = button.getAttribute('data-ruta_informe_final');
        const ruta_constancia_cumplimiento = button.getAttribute('data-ruta_constancia_cumplimiento');
        const ruta_carta_aceptacion = button.getAttribute('data-ruta_carta_aceptacion');
        const ruta_carta_presentacion = button.getAttribute('data-ruta_carta_presentacion');
        const ruta_registro_actividades = button.getAttribute('data-ruta_registro_actividades');
        const ruta_control_mensual_actividades = button.getAttribute('data-ruta_control_mensual_actividades');

        document.getElementById('idE1').value = id_practica;
        document.getElementById('idE2').value = id_practica;
        document.getElementById('idE3').value = id_practica;
        document.getElementById('idE4').value = id_practica;

        document.getElementById('modal-nombre-empresa').textContent = nombre;
        document.getElementById('modal-ruc-empresa').textContent = ruc;
        document.getElementById('modal-razon_social-empresa').textContent = razon_social;
        document.getElementById('modal-direccion-empresa').textContent = direccion;
        document.getElementById('modal-telefono-empresa').textContent = telefono;
        document.getElementById('modal-email-empresa').textContent = email;
        document.getElementById('modal-sitio_web-empresa').textContent = sitio_web;

        document.getElementById('modal-name-jefe').textContent = jefe_inmediato;
        document.getElementById('modal-area-jefe').textContent = area_jefe;
        document.getElementById('modal-cargo-jefe').textContent = cargo_jefe;
        document.getElementById('modal-dni-jefe').textContent = dni_jefe;
        document.getElementById('modal-sitio_web-jefe').textContent = web_jefe;
        document.getElementById('modal-telefono-jefe').textContent = telefono_jefe;
        document.getElementById('modal-email-jefe').textContent = email_jefe;

        document.getElementById('btn-ruta-fut').href = ruta_fut;
        document.getElementById('btn-ruta-plan-actividades').href = ruta_plan_actividades;
        document.getElementById('btn-ruta-informe-final').href = ruta_informe_final;
        document.getElementById('btn-ruta-constancia-cumplimiento').href = ruta_constancia_cumplimiento;
        document.getElementById('btn-ruta-carta-aceptacion-C2').href = ruta_carta_aceptacion;
        document.getElementById('btn-ruta-carta-aceptacion-E3').href = ruta_carta_aceptacion;
        document.getElementById('btn-ruta-carta-presentacion').href = ruta_carta_presentacion;
        document.getElementById('btn-ruta-registro-actividades').href = ruta_registro_actividades;
        document.getElementById('btn-ruta-control-mensual-actividades').href = ruta_control_mensual_actividades;
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const btn1 = document.getElementById("btn1");
    const btn2 = document.getElementById("btn2");
    const btn3 = document.getElementById("btn3");
    const btn4 = document.getElementById("btn4");

    const primeraEtapa = document.getElementById("primeraetapa");
    const segundaEtapa = document.getElementById("segundaetapa");
    const terceraEtapa = document.getElementById("terceraetapa");
    const cuartaEtapa = document.getElementById("cuartaetapa");

    function ocultarTodo() {
        primeraEtapa.style.display = "none";
        segundaEtapa.style.display = "none";
        terceraEtapa.style.display = "none";
        cuartaEtapa.style.display = "none";
    }

    function mostrarEtapa(etapa) {
        ocultarTodo();
        etapa.style.display = "block";
    }

    btn1.addEventListener("click", () => mostrarEtapa(primeraEtapa));
    btn2.addEventListener("click", () => mostrarEtapa(segundaEtapa));
    btn3.addEventListener("click", () => mostrarEtapa(terceraEtapa));
    btn4.addEventListener("click", () => mostrarEtapa(cuartaEtapa));

    // Al abrir el modal, mostrar la primera etapa por defecto
    const modalProceso = document.getElementById("modalProceso");
    modalProceso.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;

        // Reiniciar formularios y botones
        document.querySelectorAll('.form-etapa').forEach(form => {
            form.querySelectorAll('select, button, input').forEach(el => {
                el.removeAttribute('disabled');
                el.classList.remove('disabled');
                el.style.opacity = '1';
            });
            form.style.opacity = '1';
        });

        mostrarEtapa(primeraEtapa);

        // Estado de la práctica
        const estado = parseInt(button.getAttribute('data-estado')) || 1;
        actualizarBotones(estado);
        actualizarFormularios(estado);

        // Mostrar secciones según tipo_practica
        const tipo_practica = button.getAttribute('data-tipo_practica');
        const esDesarrollo = tipo_practica === 'desarrollo';

        document.getElementById('seccion-desarrollo-E2').style.display = esDesarrollo ? 'block' : 'none';
        document.getElementById('seccion-convalidacion-E2').style.display = esDesarrollo ? 'none' : 'block';
        document.getElementById('seccion-desarrollo-E3').style.display = esDesarrollo ? 'block' : 'none';
        document.getElementById('seccion-convalidacion-E3').style.display = esDesarrollo ? 'none' : 'block';

        // Asignar valores al modal (solo ejemplo de algunos)
        document.getElementById('idE1').value = button.getAttribute('data-id_practica');
        document.getElementById('idE2').value = button.getAttribute('data-id_practica');
        document.getElementById('idE3').value = button.getAttribute('data-id_practica');
        document.getElementById('idE4').value = button.getAttribute('data-id_practica');

        document.getElementById('modal-nombre-empresa').textContent = button.getAttribute('data-nombre') || '';
        document.getElementById('modal-ruc-empresa').textContent = button.getAttribute('data-ruc') || '';
        document.getElementById('modal-razon_social-empresa').textContent = button.getAttribute('data-razon_social') || '';
        document.getElementById('modal-direccion-empresa').textContent = button.getAttribute('data-direccion') || '';
        document.getElementById('modal-telefono-empresa').textContent = button.getAttribute('data-telefono') || '';
        document.getElementById('modal-email-empresa').textContent = button.getAttribute('data-email') || '';
        document.getElementById('modal-sitio_web-empresa').textContent = button.getAttribute('data-sitio_web') || '';

        document.getElementById('modal-name-jefe').textContent = button.getAttribute('data-jefe_inmediato') || '';
        document.getElementById('modal-area-jefe').textContent = button.getAttribute('data-area-jefe') || '';
        document.getElementById('modal-cargo-jefe').textContent = button.getAttribute('data-cargo-jefe') || '';
        document.getElementById('modal-dni-jefe').textContent = button.getAttribute('data-dni-jefe') || '';
        document.getElementById('modal-sitio_web-jefe').textContent = button.getAttribute('data-web-jefe') || '';
        document.getElementById('modal-telefono-jefe').textContent = button.getAttribute('data-telefono-jefe') || '';
        document.getElementById('modal-email-jefe').textContent = button.getAttribute('data-email-jefe') || '';

        document.getElementById('btn-ruta-fut').href = button.getAttribute('data-ruta_fut') || '';
        document.getElementById('btn-ruta-plan-actividades').href = button.getAttribute('data-ruta_plan_actividades') || '';
        document.getElementById('btn-ruta-informe-final').href = button.getAttribute('data-ruta_informe_final') || '';
        document.getElementById('btn-ruta-constancia-cumplimiento').href = button.getAttribute('data-ruta_constancia_cumplimiento') || '';
        document.getElementById('btn-ruta-carta-aceptacion-C2').href = button.getAttribute('data-ruta_carta_aceptacion') || '';
        document.getElementById('btn-ruta-carta-aceptacion-E3').href = button.getAttribute('data-ruta_carta_aceptacion') || '';
        document.getElementById('btn-ruta-carta-presentacion').href = button.getAttribute('data-ruta_carta_presentacion') || '';
        document.getElementById('btn-ruta-registro-actividades').href = button.getAttribute('data-ruta_registro_actividades') || '';
        document.getElementById('btn-ruta-control-mensual-actividades').href = button.getAttribute('data-ruta_control_mensual_actividades') || '';
    });
});

function actualizarBotones(estadoActual) {
    // Seleccionar todos los botones
    const botones = document.querySelectorAll('.btn-etapa');
    
    // Recorrer todos los botones
    botones.forEach(boton => {
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
    const formularios = document.querySelectorAll('.form-etapa');

    formularios.forEach(formulario => {
        const estadoFormulario = parseInt(formulario.getAttribute('data-estado')) || 1;
        const elementos = formulario.querySelectorAll('select, button');

        if (estadoFormulario === estadoActual) {
            // Activar solo el formulario correspondiente al estado actual
            formulario.classList.remove('disabled');
            formulario.style.opacity = '1';
            elementos.forEach(element => {
                element.removeAttribute('disabled');
                element.classList.remove('disabled');
            });
        } else {
            // Desactivar los demás formularios
            formulario.classList.add('disabled');
            formulario.style.opacity = '0.6';
            elementos.forEach(element => {
                element.setAttribute('disabled', 'disabled');
                element.classList.add('disabled');
            });
        }
    });
}
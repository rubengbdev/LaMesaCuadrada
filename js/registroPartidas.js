let partidas = [];
let partidasPorPagina = 10;
let numeroPaginas;
let primeraVez;
let paginaActual;
let pagina = -1;


// Función para obtener el valor de una cookie por su nombre
function obtenerValorCookie(nombre) {
    var nombreCookie = nombre + "=";
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(nombreCookie) === 0) {
            return cookie.substring(nombreCookie.length, cookie.length);
        }
    }
    return "";
}

function generarPartidasYBotones(primeraVez) {
    if (primeraVez == undefined) {

        var emailUsuario = obtenerValorCookie('correo'); // Suponiendo que la cookie se llama 'correo'

        $.ajax({
            url: 'http://localhost:8001/partidas',
            method: 'GET',
            data: {
                emailUsuario: emailUsuario
            },
            dataType: 'json',
            success: function (response) {

                console.log(response);
                partidas = response;
                numeroPaginas = Math.ceil(response.length / partidasPorPagina);
                pagina = 1;

                let inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
                let fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
                let partidasPagina = partidas.slice(inicio, fin);
                console.log(partidasPagina);

                muestraPartidas(partidasPagina);
                eventoBotonesPaginacion();
            },
            error: function (xhr, status, error) {

                console.log(error);
            }
        });

        primeraVez = false;
    }
}

function muestraPartidas(partidas) {

    $("#partidas-contenido").empty();
    var tbody = $('tbody');
    tbody.empty();

    $.each(partidas, function (index, obj) {

        var tbody = $('tbody');
        var row = $('<tr>').attr('id', obj.id);
        var logoCell = $('<td>').append($('<img>').addClass('logo-imagen').attr('src', obj.logo).attr('alt', 'Logo'));
        var nombreJuegoCell = $('<td>').addClass('nombre_juego').text(obj.nombreJuego);
        var jugadoresCell = $('<td>').addClass('jugadores').text(obj.numeroJugadores);
        var jugadorGanadorCell = $('<td>').addClass('ganador').text(obj.vencedor);
        var puntuacionCell = $('<td>').addClass('puntuacion').text(obj.puntuacionVencedor);
        var fechaCell = $('<td>').addClass('fecha').text(obj.fecha);
        var duracionCell = $('<td>').addClass('duracion').text(obj.tiempoJuego);
        var editarBtn = $('<button>').addClass('btn btn-warning me-2 editar').text('Editar');
        var eliminarBtn = $('<button>').addClass('btn btn-danger eliminar').text('Eliminar');
        var editarCell = $('<td>').append(editarBtn);
        var eliminarCell = $('<td>').append(eliminarBtn);

        editarBtn.on('click', function () {
            // var boton = $(this).attr('id');
            let registro = $(this).closest('tr');
            console.log(registro.text());

            editarPartida(registro);
        });

        eliminarBtn.on('click', function () {
            var id = $(this).attr('id');
            eliminarPartida(id);
        });

        row.append(logoCell, nombreJuegoCell, jugadoresCell, jugadorGanadorCell, puntuacionCell, fechaCell, duracionCell, editarCell, eliminarCell);
        tbody.append(row);
        $("#mostrando").text("Mostrando la pagina " + pagina + " de " + numeroPaginas);
    });
    document.documentElement.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    document.body.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function eventoBotonesPaginacion() {
    $(document).on("click", ".botones", function (event) {
        event.preventDefault();
        event.stopPropagation();
        boton = $(this).attr("id");

        switch (boton) {
            case "inicio":
                pagina = 1;
                inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
                fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
                partidasPagina = partidas.slice(inicio, fin);
                $("#inicio").prop("disabled", true);
                $("#anterior").prop("disabled", true);
                $("#siguiente").prop("disabled", false);
                $("#final").prop("disabled", false);
                muestraPartidas(partidasPagina);
                break;
            case "anterior":
                pagina--;
                inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
                fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
                partidasPagina = partidas.slice(inicio, fin);
                if (pagina == 1) {
                    $("#inicio").prop("disabled", true);
                    $("#anterior").prop("disabled", true);
                    $("#siguiente").prop("disabled", false);
                    $("#final").prop("disabled", false);
                } else {
                    $("#inicio").prop("disabled", false);
                    $("#anterior").prop("disabled", false);
                    $("#siguiente").prop("disabled", false);
                    $("#final").prop("disabled", false);
                }
                muestraPartidas(partidasPagina);
                break;
            case "siguiente":
                pagina++;
                inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
                fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
                partidasPagina = partidas.slice(inicio, fin);
                if (pagina == numeroPaginas) {
                    $("#siguiente").prop("disabled", true);
                    $("#final").prop("disabled", true);
                    $("#anterior").prop("disabled", false);
                    $("#inicio").prop("disabled", false);
                } else {
                    $("#inicio").prop("disabled", false);
                    $("#anterior").prop("disabled", false);
                    $("#siguiente").prop("disabled", false);
                    $("#final").prop("disabled", false);
                }
                muestraPartidas(partidasPagina);
                break;
            case "final":
                pagina = numeroPaginas;
                inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
                fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
                partidasPagina = partidas.slice(inicio, fin);
                $("#siguiente").prop("disabled", true);
                $("#final").prop("disabled", true);
                $("#inicio").prop("disabled", false);
                $("#anterior").prop("disabled", false);
                muestraPartidas(partidasPagina);
                break;
        }
    });
}


function editarPartida(registro) {

    // Obtener el tr correspondiende entero (el padre)

    // Obtener los datos de la partida
    let idPartida = registro.attr('id');
    let nombre = registro.find('.nombre_juego').html().trim();
    let jugadores = registro.find('.jugadores').html().trim();
    let ganador = registro.find('.ganador').html().trim();
    let puntuacion = registro.find('.puntuacion').html().trim();
    let fecha = registro.find('.fecha').html().trim();
    let duracion = registro.find('.duracion').html().trim();
    let logo = registro.find('.logo-imagen').attr('src');

    // Crear el modal de edición
    let modal = $('<div>').addClass('modal fade').attr('id', 'modalEditar');
    let modalDialog = $('<div>').addClass('modal-dialog');
    let modalContent = $('<div>').addClass('modal-content');
    let modalHeader = $('<div>').addClass('modal-header');
    let modalTitle = $('<h5>').addClass('modal-title').text('Editar partida');
    let modalBody = $('<div>').addClass('modal-body');

    // Crear el formulario de edición
    let form = $('<form>').addClass('needs-validation').attr('id', 'formularioEditar').attr('novalidate', true);

    let idFormulario = $('<input>').attr('type', 'hidden').attr('name', 'idPartida').val(idPartida);
    let nombreJuegoFormulario = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'titulo').val(nombre);
    let jugadoresFormulario = $('<textarea>').attr('type', 'number').addClass('form-control mb-3').attr('name', 'number').css('height', '300px').val(jugadores);
    let ganadorFormulario = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'imagen').val(ganador);
    let puntuacionFormulario = $('<input>').attr('type', 'number').addClass('form-control mb-3').attr('name', 'imagen').val(puntuacion);
    let fechaFormulario = $('<input>').attr('type', 'date').addClass('form-control mb-3').attr('name', 'imagen').val(fecha);
    let duracionFormulario = $('<input>').attr('type', 'number').addClass('form-control mb-3').attr('name', 'imagen').val(duracion);
    let logoFormulario = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'imagen').val(logo);


    // Agregar los elementos del formulario al modal
    form.append(idFormulario);
    form.append($('<label>').text('Nombre del Juego: ')).append(nombreJuegoFormulario);
    form.append($('<label>').text('Nº Jugadores: ')).append(jugadoresFormulario);
    form.append($('<label>').text('Ganador: ')).append(ganadorFormulario);
    form.append($('<label>').text('Puntuacion Ganador: ')).append(puntuacionFormulario);
    form.append($('<label>').text('Fecha: ')).append(fechaFormulario);
    form.append($('<label>').text('Duracion partida: ')).append(duracionFormulario);
    form.append($('<label>').text('Logo: ')).append(logoFormulario);


    modalBody.append(form);

    // Crear los botones de cancelar y confirmar cambios
    let cancelarButton = $('<button>').addClass('btn btn-danger close btn').attr('type', 'button').attr('data-dismiss', 'modal').text('Cancelar');
    let confirmarButton = $('<button>').addClass('btn btn-primary').attr('type', 'button').text('Confirmar Cambios');


    var buttonContainer = $('<div>').addClass('d-flex justify-content-center');
    buttonContainer.append(cancelarButton).append($('<div>').addClass('mx-2')).append(confirmarButton);

    // Agregar los botones al modal
    var modalFooter = $('<div>').addClass('modal-footer d-flex justify-content-center');
    modalFooter.append(buttonContainer);

    // Construir la estructura del modal
    modalHeader.append(modalTitle);
    // $modalHeader.append($modalTitle).append($modalCloseButton);

    modalContent.append(modalHeader).append(modalBody).append(modalFooter);
    modalDialog.append(modalContent);
    modal.append(modalDialog);

    // Agregar el modal al documento
    $('body').append(modal);

    // Mostrar el modal de edición
    $('#modalEditar').modal('show');

    //BOTONES DEL MODAL

    // Evento click en el botón "Cancelar"
    cancelarButton.on('click', function () {
        // Cerrar y eliminar el modal de edición
        $('#modalEditar').modal('hide').remove();
    });

    // Evento click en el botón "Confirmar Cambios"
    confirmarButton.on('click', function () {
        // Obtener los datos actualizados del formular

        // Realizar la petición PUT mediante AJAX
        $.ajax({
            url: 'http://localhost:8001/partidas',
            type: 'PUT',
            dataType: 'json',
            data: JSON.stringify({
                id: idPartida,
                numeroJugadores: jugadoresFormulario.val(),
                puntuacionVencedor: puntuacionFormulario.val(),
                fecha: fechaFormulario.val(),
                nombreJuego: nombreJuegoFormulario.val(),
                logo: logoFormulario.val(),
                tiempoJuego: duracionFormulario.val(),
                vencedor: ganadorFormulario.val()
            }),
            success: function (response) {

                window.location.href = 'registro_partidas.php';
            },
            error: function (xhr, status, error) {

                console.error(error);
            }
        });
    });

}

$(document).ready(function () {

    generarPartidasYBotones(primeraVez);

    // eventoBotonesPaginacion();
});

$(document).ready(function () {
    $("#crearRegistro").on('click', function () {
        // Crear el modal de edición
        let modal = $('<div>').addClass('modal fade').attr('id', 'modalCrear');
        let modalDialog = $('<div>').addClass('modal-dialog');
        let modalContent = $('<div>').addClass('modal-content');
        let modalHeader = $('<div>').addClass('modal-header');
        let modalTitle = $('<h5>').addClass('modal-title').text('Editar partida');
        let modalBody = $('<div>').addClass('modal-body');

        // Crear el formulario de edición
        let form = $('<form>').addClass('needs-validation').attr('id', 'crear').attr('mehotd','post').attr('novalidate', true);

        let jugadoresFormulario = $('<input>').attr('type', 'number').addClass('form-control mb-3').attr('name', 'numeroJugadores');
        let puntuacionFormulario = $('<input>').attr('type', 'number').addClass('form-control mb-3').attr('name', 'puntuacionVencedor');
        let fechaFormulario = $('<input>').attr('type', 'date').addClass('form-control mb-3').attr('name', 'fecha');
        let nombreJuegoFormulario = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'nombreJuego');
        let nombreUsuario = $('<input>').attr('type', 'hidden').addClass('form-control mb-3').attr('name', 'nombreUsuario').val(obtenerValorCookie('nombre'));
        let logoFormulario = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'logo')
        let duracionFormulario = $('<input>').attr('type', 'number').addClass('form-control mb-3').attr('name', 'tiempoJuego');
        let ganadorFormulario = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'vencedor');

        // Agregar los elementos del formulario al modal
        form.append(nombreUsuario)
        form.append($('<label>').text('Nombre del Juego: ')).append(nombreJuegoFormulario);
        form.append($('<label>').text('Nº Jugadores: ')).append(jugadoresFormulario);
        form.append($('<label>').text('Ganador: ')).append(ganadorFormulario);
        form.append($('<label>').text('Puntuacion Ganador: ')).append(puntuacionFormulario);
        form.append($('<label>').text('Fecha: ')).append(fechaFormulario);
        form.append($('<label>').text('Duracion partida: ')).append(duracionFormulario);
        form.append($('<label>').text('Logo: ')).append(logoFormulario);

        modalBody.append(form);

        // Crear los botones de cancelar y confirmar cambios
        let cancelarButton = $('<button>').addClass('btn btn-danger close btn').attr('type', 'button').attr('data-dismiss', 'modal').text('Cancelar');
        let confirmarButton = $('<input>').addClass('btn btn-primary').attr('type', 'submit').text('Confirmar Cambios');


        var buttonContainer = $('<div>').addClass('d-flex justify-content-center');
        buttonContainer.append(cancelarButton).append($('<div>').addClass('mx-2')).append(confirmarButton);

        // Agregar los botones al modal
        var modalFooter = $('<div>').addClass('modal-footer d-flex justify-content-center');
        modalFooter.append(buttonContainer);

        // Construir la estructura del modal
        modalHeader.append(modalTitle);
        // $modalHeader.append($modalTitle).append($modalCloseButton);

        modalContent.append(modalHeader).append(modalBody).append(modalFooter);
        modalDialog.append(modalContent);
        modal.append(modalDialog);

        // Agregar el modal al documento
        $('body').append(modal);

        // Mostrar el modal de edición
        $('#modalCrear').modal('show');

        //BOTONES DEL MODAL

        // Evento click en el botón "Cancelar"
        cancelarButton.on('click', function () {
            // Cerrar y eliminar el modal de edición
            $('#modalCrear').modal('hide').remove();
        });

        confirmarButton.on('click', function () {
            let formData = $('#crear').serialize();
            console.log(formData);
            // Realizar la petición PUT mediante AJAX
            $.ajax({
                url: 'http://localhost:8001/partidas',
                type: 'POST',
                data: formData,
                success: function (response) {

                    window.location.href = 'registro_partidas.php';
                },
                error: function (xhr, status, error) {

                    console.error(error);
                }
            });
        });
    })
})
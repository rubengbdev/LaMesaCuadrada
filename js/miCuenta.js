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

primeraVez = undefined;
let usuario;

function generarUsuariosYBotones(primeraVez) {

    let correoUsuario = obtenerValorCookie("correo");

    if (primeraVez == undefined) {

        $.ajax({
            url: 'http://localhost:8001/usuario',
            method: 'GET',
            data: {
                email: correoUsuario
              },
            success: function (response) {

                usuario = response;
                muestraUsuarios(usuario);
                eventoBotonesPaginacion();
            },
            error: function (xhr, status, error) {

                console.log(error);
            }
        });

        primeraVez = false;
    }
}

function muestraUsuarios(usuario) {

    var usuarioObjeto = JSON.parse(usuario);
    let listaUsuarios = $('#lista-usuarios'); // Contenedor de la lista de usuarios

    listaUsuarios.empty();

        var card = $('<div>').addClass('card mb-3 bg-dark text-white');
        var cardBody = $('<div>').addClass('card-body p-0');
        var row = $('<div>').addClass('row m-0 align-items-center');
        var col1 = $('<div>').addClass('col p-2 border-end text-center').text("nombre");
        var col2 = $('<div>').addClass('col p-2 border-end text-center').text("Email");
        var col3 = $('<div>').addClass('col p-2 border-end text-center').text('Fecha de creacion');
        var col4 = $('<div>').addClass('col p-2 border-end text-center').text('Accion');

        row.append(col1, col2, col3, col4);
        cardBody.append(row);
        card.append(cardBody);
        var colWrapper = $('<div>').addClass('col-12').append(card);
        listaUsuarios.append(colWrapper);
    var card = $('<div>').addClass('card mb-3');
    var cardBody = $('<div>').addClass('card-body p-0');
    var row = $('<div>').addClass('row m-0 align-items-center');
    var col1 = $('<div>').addClass('col p-2 border-end text-center').text(usuarioObjeto.nombre);
    var col2 = $('<div>').addClass('col p-2 border-end text-center').text(usuarioObjeto.email);
    var col3 = $('<div>').addClass('col p-2 border-end text-center').text(usuarioObjeto.fechaCreacion);
    var editarBtn = $('<button>').addClass('btn btn-success editar').text('Editar');
    var col4 = $('<div>').addClass('col p-2 border-end text-center').append(editarBtn);

    editarBtn.on('click', function () {
        editarUsuario(usuarioObjeto.id); // Llamada a la función para eliminar el usuario
    });

    row.append(col1, col2, col3, col4);
    cardBody.append(row);
    card.append(cardBody);
    var colWrapper = $('<div>').addClass('col-12').append(card);
    listaUsuarios.append(colWrapper);
    listaUsuarios.addClass('d-flex flex-wrap justify-cotente-center');
}

function eventoBotonesPaginacion() {

    $(document).ready(function () {
        $("#siguiente").hide();
        $("#final").hide();
        $("#inicio").hide();
        $("#anterior").hide();
        $("#mostrando").hide();
        $("#paginacion-borde").hide();
    });

}



function editarUsuario(usuario) {

    // Obtener el tr correspondiende entero (el padre)

    // Obtener los datos de la partida
    let idPartida = registro.attr('id');
    let nombre = registro.find('.nombre_juego').html().trim();
    let jugadores = registro.find('.jugadores').html().trim();

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

    // Agregar los elementos del formulario al modal
    form.append(idFormulario);
    form.append($('<label>').text('Nombre del Juego: ')).append(nombreJuegoFormulario);
    form.append($('<label>').text('Nº Jugadores: ')).append(jugadoresFormulario);
    form.append($('<label>').text('Ganador: ')).append(ganadorFormulario);

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

    generarUsuariosYBotones(primeraVez);
});
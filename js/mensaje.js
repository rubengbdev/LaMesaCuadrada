var url = new URL(window.location.href);

// Obtener el valor del parámetro "id" de la URL
var id = url.searchParams.get("id");

// Hacer algo con el valor del ID


let mensajes = [];
let mensajesPorPagina = 10;
let numeroPaginas;
let primeraVez;
let paginaActual;
let pagina = -1;

function generarMensajesYBotones(primeraVez) {
    if (primeraVez == undefined) {

        $.ajax({
            url: 'http://localhost:8001/hilo/' + id,
            method: 'GET',
            dataType: 'json',
            success: function (response) {

                mensajes = response;
                numeroPaginas = Math.ceil(response.length / mensajesPorPagina);
                let mensajesPagina;
                if (numeroPaginas > 1) {

                    pagina = 1;
                    let inicio = (pagina - 1) * mensajesPorPagina; // Índice de inicio
                    let fin = inicio + mensajesPorPagina; // Índice de fin (no inclusivo)
                    mensajesPagina = mensajes.slice(inicio, fin);
                } else {
                    pagina = 1;
                    mensajesPagina = mensajes;
                }

                muestraMensajes(mensajesPagina);
                eventoBotonesPaginacion();
            },
            error: function (xhr, status, error) {

                console.log(error);
            }
        });

        primeraVez = false;
    }
}

function muestraMensajes(mensajes) {
    $("#general-mensajes").html('');

    $.each(mensajes, function(index, obj) {
        var cardBody = $('<div>').addClass('card-body h-70');
        var card = $('<div>').addClass('card mb-3 h-100 my-1');
        var row = $('<div>').addClass('row g-0 h-100');
        var col1 = $('<div>').addClass('col-2 border-end h-100');
        var col2 = $('<div>').addClass('col-10 h-100');
        var col1CardBody = $('<div>').addClass('card-body d-flex flex-column align-items-center');
        var col2CardBody = $('<div>').addClass('card-body d-flex flex-column justify-content-between');
        var nombreUsuario = $('<h5>').addClass('card-title mb-1').text(obj.nombreUsuario);
        var fecha = $('<p>').addClass('card-text small text-muted mb-1').text(obj.fecha);
        var texto = $('<p>').addClass('card-text mb-0').text(obj.texto);
      
        col1CardBody.append(nombreUsuario, fecha);
        col2CardBody.append(texto);
        col1.append(col1CardBody);
        col2.append(col2CardBody);
        row.append(col1, col2);
        card.append(row);
        cardBody.append(card);
      
        if (index === 0 && pagina === 1) { // Verifica si es el primer mensaje total y también el de la primera página
          col1.addClass('border-danger');
          col2.addClass('border-danger');
          var titulo = $('<h5>').addClass('card-title').text(obj.titulo);
          col2CardBody.prepend(titulo);
        } else {
          col1.addClass('border-primary');
          col2.addClass('border-primary');
        }
      
        cardBody.append(card);
      
        $('#general-mensajes').append(cardBody);
      });
    if (mensajes.length > 0) {
        $("#mostrando").text("Mostrando la página " + pagina + " de " + numeroPaginas);
    } else {
        $("#mostrando").text("Mostrando la página 1 de 1");
    }

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

    $(document).ready(function () {
        if (numeroPaginas <= 1) {
            $("#siguiente").prop("disabled", true);
            $("#final").prop("disabled", true);
            $("#inicio").prop("disabled", true);
            $("#anterior").prop("disabled", true);
        }
    });


    $(document).on("click", ".botones", function (event) {
        event.preventDefault();
        event.stopPropagation();
        boton = $(this).attr("id");

        if (numeroPaginas > 1) {
            switch (boton) {
                case "inicio":
                    pagina = 1;
                    inicio = (pagina - 1) * mensajesPorPagina; // Índice de inicio
                    fin = inicio + mensajesPorPagina; // Índice de fin (no inclusivo)
                    mensajesPagina = mensajes.slice(inicio, fin);
                    $("#inicio").prop("disabled", true);
                    $("#anterior").prop("disabled", true);
                    $("#siguiente").prop("disabled", false);
                    $("#final").prop("disabled", false);
                    muestraMensajes(mensajesPagina);
                    break;
                case "anterior":
                    pagina--;
                    inicio = (pagina - 1) * mensajesPorPagina; // Índice de inicio
                    fin = inicio + mensajesPorPagina; // Índice de fin (no inclusivo)
                    mensajesPagina = mensajes.slice(inicio, fin);
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
                    muestraMensajes(mensajesPagina);
                    break;
                case "siguiente":
                    pagina++;
                    inicio = (pagina - 1) * mensajesPorPagina; // Índice de inicio
                    fin = inicio + mensajesPorPagina; // Índice de fin (no inclusivo)
                    mensajesPagina = mensajes.slice(inicio, fin);
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
                    muestraMensajes(mensajesPagina);
                    break;
                case "final":
                    pagina = numeroPaginas;
                    inicio = (pagina - 1) * mensajesPorPagina; // Índice de inicio
                    fin = inicio + mensajesPorPagina; // Índice de fin (no inclusivo)
                    mensajesPagina = mensajes.slice(inicio, fin);
                    $("#siguiente").prop("disabled", true);
                    $("#final").prop("disabled", true);
                    $("#inicio").prop("disabled", false);
                    $("#anterior").prop("disabled", false);
                    muestraMensajes(mensajesPagina);
                    break;
            }
        } else {
            pagina = 1;
            mensajesPagina = mensajes;
            $("#siguiente").prop("disabled", true);
            $("#final").prop("disabled", true);
            $("#inicio").prop("disabled", true);
            $("#anterior").prop("disabled", true);
            muestraMensajes(mensajesPagina);
        }

    });
}




$(document).ready(function () {

    generarMensajesYBotones(primeraVez);
});

$(document).ready(function () {
    $("#crearHiloGeneral").on('click', function () {
        // Crear el modal de edición
        let modal = $('<div>').addClass('modal fade').attr('id', 'modalCrear');
        let modalDialog = $('<div>').addClass('modal-dialog');
        let modalContent = $('<div>').addClass('modal-content');
        let modalHeader = $('<div>').addClass('modal-header');
        let modalTitle = $('<h5>').addClass('modal-title').text('Editar partida');
        let modalBody = $('<div>').addClass('modal-body');

        // Crear el formulario de edición
        let form = $('<form>').addClass('needs-validation').attr('id', 'crear').attr('mehotd', 'post').attr('novalidate', true);

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
                url: 'http://localhost:8001/mensajes',
                type: 'POST',
                data: formData,
                success: function (response) {

                    window.location.href = 'registro_mensajes.php';
                },
                error: function (xhr, status, error) {

                    console.error(error);
                }
            });
        });
    })
})


function eliminarHilo(id) {

    // Crear el modal de edición
    let modal = $('<div>').addClass('modal fade').attr('id', 'modalBorrar');
    let modalDialog = $('<div>').addClass('modal-dialog');
    let modalContent = $('<div>').addClass('modal-content');
    let modalHeader = $('<div>').addClass('modal-header');
    let modalTitle = $('<h5>').addClass('modal-title').text('Borrar mensaje');
    let modalBody = $('<div>').addClass('modal-body text-center').text('¿Seguro que quiere eliminar este mensaje?');

    // Crear el formulario de edición
    var form = $('<form>').addClass('needs-validation').attr('id', 'formularioBorrar').attr('novalidate', true);
    var inputId = $('<input>').attr('type', 'hidden').attr('name', 'id').val(id);

    form.append(inputId);
    modalBody.append(form);

    let cancelarButton = $('<button>').addClass('btn btn-danger close btn').attr('type', 'button').attr('data-dismiss', 'modal').text('Cancelar');
    let confirmarButton = $('<button>').addClass('btn btn-primary').attr('type', 'button').text('Confirmar borrado');

    let buttonContainer = $('<div>').addClass('d-flex justify-content-center');
    buttonContainer.append(cancelarButton).append($('<div>').addClass('mx-2')).append(confirmarButton);

    let modalFooter = $('<div>').addClass('modal-footer d-flex justify-content-center');
    modalFooter.append(buttonContainer);

    modalHeader.append(modalTitle);

    modalContent.append(modalHeader).append(modalBody).append(modalFooter);
    modalDialog.append(modalContent);
    modal.append(modalDialog);

    // Agregar el modal al documento
    $('body').append(modal);

    // Mostrar el modal de edición
    $('#modalBorrar').modal('show');

    //BOTONES DEL MODAL

    // Evento click en el botón "Cancelar"
    cancelarButton.on('click', function () {
        // Cerrar y eliminar el modal de edición
        $('#modalBorrar').modal('hide').remove();
    });

    // Evento click en el botón "Confirmar Cambios"
    confirmarButton.on('click', function () {

        $.ajax({
            url: 'http://localhost:8001/hilos',
            type: 'DELETE',
            dataType: 'json',
            data: JSON.stringify({
                id: id
            }),
            success: function (response) {

                window.location.href = 'foro.php';
            },
            error: function (xhr, status, error) {

                console.error(error);
            }
        });
    });

}


$(document).ready(function() {
    $("#eliminarHilo").on("click", function() {

        let url = new URL(window.location.href);
        let id = url.searchParams.get("id");

        eliminarHilo(id);
    });

    $('#publicar-mensaje').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let url = 'http://localhost:8001/hilo';

        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function (response) {

                window.location.href = 'hilo.php?id=' + id;
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
  });
  
let hilos = [];
let hilosPorPagina = 10;
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

function generarHilosYBotones(primeraVez) {
    if (primeraVez == undefined) {

        $.ajax({
            url: 'http://localhost:8001/hilos',
            method: 'GET',
            data: {
                hilo_tipo: "GENERAL"
            },
            dataType: 'json',
            success: function (response) {

                hilos = response;
                numeroPaginas = Math.ceil(response.length / hilosPorPagina);
                let hilosPagina;
                if (numeroPaginas > 1) {

                    pagina = 1;
                    let inicio = (pagina - 1) * hilosPorPagina; // Índice de inicio
                    let fin = inicio + hilosPorPagina; // Índice de fin (no inclusivo)
                    hilosPagina = hilos.slice(inicio, fin);
                } else {
                    pagina = 1;
                    hilosPagina = hilos;
                }

                muestraHilos(hilosPagina);
                eventoBotonesPaginacion();
            },
            error: function (xhr, status, error) {

                console.log(error);
            }
        });

        primeraVez = false;
    }
}

function muestraHilos(hilos) {

    $("#general-hilos .card-body .list-group").html('');

    $.each(hilos, function (index, obj) {
        var liElement = $('<li>').addClass('list-group-item');
        var rowElement = $('<div>').addClass('row align-items-center justify-content-between');

        var col1Element = $('<div>').addClass('col-sm-10');
        var tituloLink = $('<a>').attr('href', 'http://localhost:8001/pages/hilo.php?id=' + obj.id).text(obj.titulo);
        var tituloStrong = $('<strong>').append(tituloLink);
        col1Element.append(tituloStrong);

        var col2Element = $('<div>').addClass('col-sm-1 text-end');
        var horaBadge = $('<span>').addClass('badge bg-primary rounded-pill').text(obj.fecha);
        col2Element.append(horaBadge);

        var col3Element = $('<div>').addClass('col-sm-1 text-end');
        var usuarioBadge = $('<span>');
        col3Element.append(usuarioBadge);

        rowElement.append(col1Element, col2Element, col3Element);
        liElement.append(rowElement);

        $('#general-hilos .card-body .list-group').append(liElement);
        if (hilos.length > 0) {
            $("#mostrando").text("Mostrando la pagina " + pagina + " de " + numeroPaginas);
        } else {
            $("#mostrando").text("Mostrando la pagina 1 de 1 ");
        }
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
                    inicio = (pagina - 1) * hilosPorPagina; // Índice de inicio
                    fin = inicio + hilosPorPagina; // Índice de fin (no inclusivo)
                    hilosPagina = hilos.slice(inicio, fin);
                    $("#inicio").prop("disabled", true);
                    $("#anterior").prop("disabled", true);
                    $("#siguiente").prop("disabled", false);
                    $("#final").prop("disabled", false);
                    muestraHilos(hilosPagina);
                    break;
                case "anterior":
                    pagina--;
                    inicio = (pagina - 1) * hilosPorPagina; // Índice de inicio
                    fin = inicio + hilosPorPagina; // Índice de fin (no inclusivo)
                    hilosPagina = hilos.slice(inicio, fin);
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
                    muestraHilos(hilosPagina);
                    break;
                case "siguiente":
                    pagina++;
                    inicio = (pagina - 1) * hilosPorPagina; // Índice de inicio
                    fin = inicio + hilosPorPagina; // Índice de fin (no inclusivo)
                    hilosPagina = hilos.slice(inicio, fin);
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
                    muestraHilos(hilosPagina);
                    break;
                case "final":
                    pagina = numeroPaginas;
                    inicio = (pagina - 1) * hilosPorPagina; // Índice de inicio
                    fin = inicio + hilosPorPagina; // Índice de fin (no inclusivo)
                    hilosPagina = hilos.slice(inicio, fin);
                    $("#siguiente").prop("disabled", true);
                    $("#final").prop("disabled", true);
                    $("#inicio").prop("disabled", false);
                    $("#anterior").prop("disabled", false);
                    muestraHilos(hilosPagina);
                    break;
            }
        } else {
            pagina = 1;
            hilosPagina = hilos;
            $("#siguiente").prop("disabled", true);
            $("#final").prop("disabled", true);
            $("#inicio").prop("disabled", true);
            $("#anterior").prop("disabled", true);
            muestraHilos(hilosPagina);
        }

    });
}

$(document).ready(function () {

    generarHilosYBotones(primeraVez);
});

$(document).ready(function () {
    $("#crearHiloGeneral").on('click', function () {
        // Crear el modal de edición
        let modal = $('<div>').addClass('modal fade').attr('id', 'modalCrear');
        let modalDialog = $('<div>').addClass('modal-dialog');
        let modalContent = $('<div>').addClass('modal-content');
        let modalHeader = $('<div>').addClass('modal-header');
        let modalTitle = $('<h5>').addClass('modal-title').text('Crear Hilo');
        let modalBody = $('<div>').addClass('modal-body');

        // Crear el formulario de edición
        let form = $('<form>').addClass('needs-validation').attr('id', 'crear').attr('mehotd', 'post').attr('novalidate', true);

        let publicar = $('<input>').attr('type', 'hidden').attr('name', 'publicar_hilo');
        let texto = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'texto');
        let titulo = $('<input>').attr('type', 'text').addClass('form-control mb-3').attr('name', 'titulo');
        let nombreUsuario = $('<input>').attr('type', 'hidden').addClass('form-control mb-3').attr('name', 'nombre_usuario').val(obtenerValorCookie('nombre'));
        let valorTokenForo = tokenForo;

        let tokenForoInput = $('<input>').attr('type', 'hidden').attr('name', 'token_foro').val(valorTokenForo);


        // Agregar los elementos del formulario al modal
        form.append(publicar);
        form.append(nombreUsuario);
        form.append($('<label>').text('Titulo: ')).append(titulo);
        form.append($('<label>').text('Texto: ')).append(texto);
        form.append(tokenForoInput);

        modalBody.append(form);

        // Crear los botones de cancelar y confirmar cambios
        let cancelarButton = $('<button>').addClass('btn btn-danger close btn').attr('type', 'button').attr('data-dismiss', 'modal').text('Cancelar');
        let confirmarButton = $('<input>').addClass('btn btn-primary').attr('type', 'submit').text('Publicar hilo');


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
                url: 'http://localhost:8001/hilos',
                type: 'POST',
                data: formData,
                success: function (response) {

                    window.location.href = 'foro.php';
                },
                error: function (xhr, status, error) {

                    console.error(error);
                }
            });
        });
    })
})

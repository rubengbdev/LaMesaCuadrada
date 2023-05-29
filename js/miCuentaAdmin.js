var url = new URL(window.location.href);

// Obtener el valor del parámetro "id" de la URL
var id = url.searchParams.get("id");

// Hacer algo con el valor del ID


let usuarios = [];
let usuariosPorPagina = 5;
let numeroPaginas;
let primeraVez;
let paginaActual;
let pagina = -1;

function generarUsuariosYBotones(primeraVez) {
    if (primeraVez == undefined) {

        $.ajax({
            url: 'http://localhost:8001/usuario',
            method: 'GET',
            success: function (response) {

                usuarios = response;
                numeroPaginas = Math.ceil(response.length / usuariosPorPagina);
                let usuariosPagina;
                if (numeroPaginas > 1) {

                    pagina = 1;
                    let inicio = (pagina - 1) * usuariosPorPagina; // Índice de inicio
                    let fin = inicio + usuariosPorPagina; // Índice de fin (no inclusivo)
                    usuariosPagina = usuarios.slice(inicio, fin);
                } else {
                    pagina = 1;
                    usuariosPagina = usuarios;
                }

                muestraUsuarios(usuariosPagina);
                eventoBotonesPaginacion();
            },
            error: function (xhr, status, error) {

                console.log(error);
            }
        });

        primeraVez = false;
    }
}

function muestraUsuarios(usuariosDTO) {

    let listaUsuarios = $('#lista-usuarios'); // Contenedor de la lista de usuarios

    // Vaciar la lista de usuarios antes de generarla nuevamente
    listaUsuarios.empty();

    // // Agregar fila de encabezados
    // var encabezadosRow = $('<div>').addClass('row m-0');
    // var encabezado1 = $('<div>').addClass('col p-2 border-end').text('Nombre');
    // var encabezado2 = $('<div>').addClass('col p-2 border-end').text('Email');
    // var encabezado3 = $('<div>').addClass('col p-2 border-end').text('FechaCreacion');
    // var encabezado4 = $('<div>').addClass('col-1 p-2 text-end').text('Acción');
    // encabezadosRow.append(encabezado1, encabezado2, encabezado3, encabezado4);
    // listaUsuarios.append(encabezadosRow);
    // encabezadosRow.addClass('d-flex flex-wrap');


    // Generar la nueva lista de usuarios y agregar los elementos correspondientes
    $.each(usuariosDTO, function (index, obj) {

        if (index === 0) {
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
        }
        var card = $('<div>').addClass('card mb-3');
        var cardBody = $('<div>').addClass('card-body p-0');
        var row = $('<div>').addClass('row m-0 align-items-center');
        var col1 = $('<div>').addClass('col p-2 border-end text-center').text(obj.nombre);
        var col2 = $('<div>').addClass('col p-2 border-end text-center').text(obj.email);
        var col3 = $('<div>').addClass('col p-2 border-end text-center').text(obj.fechaCreacion);
        var eliminarBtn = $('<button>').addClass('btn btn-danger eliminar').text('Eliminar');
        var col4 = $('<div>').addClass('col p-2 border-end text-center').append(eliminarBtn);

        eliminarBtn.on('click', function () {
            eliminarUsuario(obj.id); // Llamada a la función para eliminar el usuario
            // card.remove(); // Eliminar la tarjeta correspondiente al usuario
        });

        row.append(col1, col2, col3, col4);
        cardBody.append(row);
        card.append(cardBody);
        var colWrapper = $('<div>').addClass('col-12').append(card);
        listaUsuarios.append(colWrapper);
    });

    // Ajustar el contenedor para que se ajuste automáticamente al contenido
    listaUsuarios.addClass('d-flex flex-wrap justify-cotente-center');


    if (usuarios.length > 0) {
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
                    inicio = (pagina - 1) * usuariosPorPagina; // Índice de inicio
                    fin = inicio + usuariosPorPagina; // Índice de fin (no inclusivo)
                    usuariosPagina = usuarios.slice(inicio, fin);
                    $("#inicio").prop("disabled", true);
                    $("#anterior").prop("disabled", true);
                    $("#siguiente").prop("disabled", false);
                    $("#final").prop("disabled", false);
                    muestraUsuarios(usuariosPagina);
                    break;
                case "anterior":
                    pagina--;
                    inicio = (pagina - 1) * usuariosPorPagina; // Índice de inicio
                    fin = inicio + usuariosPorPagina; // Índice de fin (no inclusivo)
                    usuariosPagina = usuarios.slice(inicio, fin);
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
                    muestraUsuarios(usuariosPagina);
                    break;
                case "siguiente":
                    pagina++;
                    inicio = (pagina - 1) * usuariosPorPagina; // Índice de inicio
                    fin = inicio + usuariosPorPagina; // Índice de fin (no inclusivo)
                    usuariosPagina = usuarios.slice(inicio, fin);
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
                    muestraUsuarios(usuariosPagina);
                    break;
                case "final":
                    pagina = numeroPaginas;
                    inicio = (pagina - 1) * usuariosPorPagina; // Índice de inicio
                    fin = inicio + usuariosPorPagina; // Índice de fin (no inclusivo)
                    usuariosPagina = usuarios.slice(inicio, fin);
                    $("#siguiente").prop("disabled", true);
                    $("#final").prop("disabled", true);
                    $("#inicio").prop("disabled", false);
                    $("#anterior").prop("disabled", false);
                    muestraUsuarios(usuariosPagina);
                    break;
            }
        } else {
            pagina = 1;
            usuariosPagina = usuarios;
            $("#siguiente").prop("disabled", true);
            $("#final").prop("disabled", true);
            $("#inicio").prop("disabled", true);
            $("#anterior").prop("disabled", true);
            muestraUsuarios(usuariosPagina);
        }

    });
}


function eliminarUsuario(id) {

    // Crear el modal de edición
    let modal = $('<div>').addClass('modal fade').attr('id', 'modalBorrar');
    let modalDialog = $('<div>').addClass('modal-dialog');
    let modalContent = $('<div>').addClass('modal-content');
    let modalHeader = $('<div>').addClass('modal-header');
    let modalTitle = $('<h5>').addClass('modal-title').text('Borrar registro');
    let modalBody = $('<div>').addClass('modal-body text-center').text('¿Seguro que quiere eliminar este registro?');

    // Crear el formulario de edición
    var form = $('<form>').addClass('needs-validation').attr('id', 'formularioBorrar').attr('novalidate', true);
    var idInput = $('<input>').attr('type', 'hidden').attr('name', 'id').val(id);

    form.append(idInput);
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
            url: 'http://localhost:8001/usuario',
            type: 'DELETE',
            dataType: 'json',
            data: JSON.stringify({
                id: id
            }),
            success: function (response) {

                window.location.href = 'mi_cuenta.php';
            },
            error: function (xhr, status, error) {

                console.error(error);
            }
        });
    });

}



$(document).ready(function () {

    generarUsuariosYBotones(primeraVez);

    // eventoBotonesPaginacion();
});
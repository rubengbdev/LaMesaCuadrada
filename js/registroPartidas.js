let partidas = [];
let partidasPorPagina = 5;
let numeroPaginas;
let primeraVez;
var pagina = -1;
let partidasPagina;

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

                if (response.length > 0) {
                    partidas = response;

                    numeroPaginas = Math.ceil(response.length / partidasPorPagina);
                    partidasPagina;
                    if (numeroPaginas > 1) {
    
                        pagina = 1;
                        let inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
                        let fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
                        partidasPagina = partidas.slice(inicio, fin);
                    } else {
                        pagina = 1;
                        partidasPagina = partidas;
                    }
    
                    muestraPartidas(partidasPagina);
                    eventoBotonesPaginacion(partidas);
                }
            },
            error: function (xhr, status, error) {

                console.log(error);
            }
        });

        primeraVez = false;
    }
}

function muestraPartidas(partidasMostrar) {

    $("#partidas-contenido").empty();
    var tbody = $('tbody');
    tbody.empty();

    $.each(partidasMostrar, function (index, obj) {

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
            let registro = $(this).closest('tr');

            editarPartida(registro);
        });

        eliminarBtn.on('click', function () {
            let registro = $(this).closest('tr');
            eliminarPartida(registro);
        });

        row.append(logoCell, nombreJuegoCell, jugadoresCell, jugadorGanadorCell, puntuacionCell, fechaCell, duracionCell, editarCell, eliminarCell);
        tbody.append(row);

        if (partidas.length > 0) {
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

function eventoBotonesPaginacion(partidasMostrar) {

    $(document).ready(function () {

        if (numeroPaginas <= 1) {
            $("#siguiente").prop("disabled", true);
            $("#final").prop("disabled", true);
            $("#inicio").prop("disabled", true);
            $("#anterior").prop("disabled", true);
        }

        if (numeroPaginas > 1) {
            $("#siguiente").prop("disabled", false);
            $("#final").prop("disabled", false);
            $("#inicio").prop("disabled", true);
            $("#anterior").prop("disabled", true);
        }

        $(document).on("click", ".botones", function (event) {
            event.preventDefault();
            event.stopPropagation();
            boton = $(this).attr("id");

            if (numeroPaginas > 1) {
                switch (boton) {
                    case "inicio":
                        pagina = 1;
                        inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
                        fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
                        partidasPagina = partidasMostrar.slice(inicio, fin);
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
                        partidasPagina = partidasMostrar.slice(inicio, fin);
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
                        partidasPagina = partidasMostrar.slice(inicio, fin);
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
                        partidasPagina = partidasMostrar.slice(inicio, fin);
                        $("#siguiente").prop("disabled", true);
                        $("#final").prop("disabled", true);
                        $("#inicio").prop("disabled", false);
                        $("#anterior").prop("disabled", false);
                        muestraPartidas(partidasPagina);
                        break;
                }
            } else {
                pagina = 1;
                partidasPagina = partidasMostrar;
                $("#siguiente").prop("disabled", true);
                $("#final").prop("disabled", true);
                $("#inicio").prop("disabled", true);
                $("#anterior").prop("disabled", true);
                muestraPartidas(partidasPagina);
            }

        });
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
    let jugadoresFormulario = $('<input>').attr('type', 'number').addClass('form-control mb-3').attr('name', 'number').val(jugadores);
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
    let confirmarButton = $('<button>').addClass('btn btn-primary confirmaEdicion').attr('type', 'button').text('Confirmar Cambios').prop("disabled", true);


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

    $(document).on("keyup", "#formularioEditar input", function () {
        console.log("hola dentro de evento");
        var numeroJugadores = $("input[name='numeroJugadores']").val();
        var puntuacionVencedor = $("input[name='puntuacionVencedor']").val();
        var fecha = $("input[name='fecha']").val();
        var nombreJuego = $("input[name='nombreJuego']").val();
        var logo = $("input[name='logo']").val();
        var tiempoJuego = $("input[name='tiempoJuego']").val();
        var vencedor = $("input[name='vencedor']").val();

        // Verificar si todos los campos están completados
        if (numeroJugadores !== "" && puntuacionVencedor !== "" && fecha !== "" && nombreJuego !== "" && logo !== "" && tiempoJuego !== "" && vencedor !== "") {
            $(".confirmaEdicion").prop("disabled", false);
        } else {
            $(".confirmaEdicion").prop("disabled", true);
        }
    });

}

function eliminarPartida(registro) {

    let idPartida = registro.attr("id");

    // Crear el modal de edición
    let modal = $('<div>').addClass('modal fade').attr('id', 'modalBorrar');
    let modalDialog = $('<div>').addClass('modal-dialog');
    let modalContent = $('<div>').addClass('modal-content');
    let modalHeader = $('<div>').addClass('modal-header');
    let modalTitle = $('<h5>').addClass('modal-title').text('Borrar registro');
    let modalBody = $('<div>').addClass('modal-body text-center').text('¿Seguro que quiere eliminar este registro?');

    // Crear el formulario de edición
    var form = $('<form>').addClass('needs-validation').attr('id', 'formularioBorrar').attr('novalidate', true);
    var id = $('<input>').attr('type', 'hidden').attr('name', 'id').val(id);

    form.append(id);
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

    $('body').append(modal);
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
            url: 'http://localhost:8001/partidas',
            type: 'DELETE',
            dataType: 'json',
            data: JSON.stringify({
                id: idPartida
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
        let form = $('<form>').attr('id', 'crear').attr('mehotd', 'post');


        let jugadoresFormulario = $('<input>')
            .attr('type', 'number')
            .addClass('form-control mb-3')
            .attr('name', 'numeroJugadores')
            .attr('placeholder', 'Número de jugadores')
            .prop('required', true)
            .prop('min', 0);

        let puntuacionFormulario = $('<input>')
            .attr('type', 'number')
            .addClass('form-control mb-3')
            .attr('name', 'puntuacionVencedor')
            .attr('placeholder', 'Puntuación del vencedor')
            .prop('required', true)
            .prop('min', 0);

        let fechaFormulario = $('<input>')
            .attr('type', 'date')
            .addClass('form-control mb-3')
            .attr('name', 'fecha')
            .attr('placeholder', 'Fecha')
            .prop('required', true);

        let nombreJuegoFormulario = $('<input>')
            .attr('type', 'text')
            .addClass('form-control mb-3')
            .attr('name', 'nombreJuego')
            .attr('placeholder', 'Nombre del juego')
            .prop('required', true);

        let nombreUsuario = $('<input>')
            .attr('type', 'hidden')
            .addClass('form-control mb-3')
            .attr('name', 'nombreUsuario')
            .val(obtenerValorCookie('nombre'));

        let logoFormulario = $('<input>')
            .attr('type', 'text')
            .addClass('form-control mb-3')
            .attr('name', 'logo')
            .attr('placeholder', 'URL del logo');

        let duracionFormulario = $('<input>')
            .attr('type', 'number')
            .addClass('form-control mb-3')
            .attr('name', 'tiempoJuego')
            .attr('placeholder', 'Duración del juego (minutos)')
            .prop('required', true)
            .prop('min', 0);

        let ganadorFormulario = $('<input>')
            .attr('type', 'text')
            .addClass('form-control mb-3')
            .attr('name', 'vencedor')
            .attr('placeholder', 'Nombre del vencedor')
            .prop('required', true);

        // Agregar los elementos del formulario al modal
        form.append(nombreUsuario)
        form.append($('<label>').text('Nombre del Juego: ')).append(nombreJuegoFormulario);
        form.append($('<label>').text('Nº Jugadores: ')).append(jugadoresFormulario);
        form.append($('<label>').text('Ganador: ')).append(ganadorFormulario);
        form.append($('<label>').text('Puntuacion Ganador: ')).append(puntuacionFormulario);
        form.append($('<label>').text('Fecha: ')).append(fechaFormulario);
        form.append($('<label>').text('Duracion partida (min): ')).append(duracionFormulario);
        form.append($('<label>').text('Logo: ')).append(logoFormulario);

        modalBody.append(form);

        // Crear los botones de cancelar y confirmar cambios
        let cancelarButton = $('<button>').addClass('btn btn-danger close btn').attr('type', 'button').attr('data-dismiss', 'modal').text('Cancelar');
        let confirmarButton = $('<input>').addClass('btn btn-primary confirmar').attr('type', 'submit').text('Crear registro').prop("disabled", true);


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

        $(document).on("keyup", "#crear input", function () {
            console.log("hola dentro de evento");
            var numeroJugadores = $("input[name='numeroJugadores']").val();
            var puntuacionVencedor = $("input[name='puntuacionVencedor']").val();
            var fecha = $("input[name='fecha']").val();
            var nombreJuego = $("input[name='nombreJuego']").val();
            var logo = $("input[name='logo']").val();
            var tiempoJuego = $("input[name='tiempoJuego']").val();
            var vencedor = $("input[name='vencedor']").val();

            // Verificar si todos los campos están completados
            if (numeroJugadores !== "" && puntuacionVencedor !== "" && fecha !== "" && nombreJuego !== "" && logo !== "" && tiempoJuego !== "" && vencedor !== "") {
                $(".confirmar").prop("disabled", false);
            } else {
                $(".confirmar").prop("disabled", true);
            }
        });
    })

})

//Validacion

//BUSCADOR

var searchTermInput = document.getElementById('campoBusqueda');

var timeoutId;

$('#busqueda-input').on('keyup', function () {
    clearTimeout(timeoutId);
    var searchTerm = $(this).val();

    if (searchTerm.length >= 3) {
        timeoutId = setTimeout(function () {
            buscarPartidas(searchTerm);
        }, 300);

    } else {

        pagina = 1
        numeroPaginas = Math.ceil(partidas.length / partidasPorPagina);
        partidasPagina = -1;

        if (numeroPaginas > 1) {

            let inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
            let fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
            partidasPagina = partidas.slice(inicio, fin);
        } else {

            partidasPagina = partidas;
        }

        muestraPartidas(partidasPagina);
        eventoBotonesPaginacion(partidas);
    }
});


function buscarPartidas(searchTerm) {

    var partidasFiltradas = partidas.filter(function (obj) {
        return obj.nombreJuego.toLowerCase().includes(searchTerm.toLowerCase());
    });

    numeroPaginas = Math.ceil(partidasFiltradas.length / partidasPorPagina);

    if (numeroPaginas > 1) {
        pagina = 1;
        let inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
        let fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
        partidasPagina = partidasFiltradas.slice(inicio, fin);
    } else {
        pagina = 1;
        partidasPagina = partidasFiltradas;
    }
    muestraPartidas(partidasPagina);
    eventoBotonesPaginacion(partidasFiltradas);
}


//ORDENA POR FECHA

var ordenAscendente = true;

$(document).ready(function () {

    $(document).on("click", "#ordenar-ascendente", function () {
        ordenAscendente = true;
        ordenarPartidas();
    });

    $(document).on("click", "#ordenar-descendente", function () {
        ordenAscendente = false;
        ordenarPartidas();
    });
});


function ordenarPartidas() {
    var partidasOrdenadas = partidas.slice(); // Crea una copia del arreglo original
    if (ordenAscendente) {
        partidasOrdenadas.sort(function (a, b) {
            return new Date(a.fecha) - new Date(b.fecha);
        });
    } else {
        partidasOrdenadas.sort(function (a, b) {
            return new Date(b.fecha) - new Date(a.fecha);
        });
    }

    numeroPaginas = Math.ceil(partidasOrdenadas.length / partidasPorPagina);
    if (numeroPaginas > 1) {
        pagina = 1;
        let inicio = (pagina - 1) * partidasPorPagina; // Índice de inicio
        let fin = inicio + partidasPorPagina; // Índice de fin (no inclusivo)
        partidasPagina = partidasOrdenadas.slice(inicio, fin);
    } else {
        pagina = 1;
        partidasPagina = partidasOrdenadas;
    }

    muestraPartidas(partidasPagina);
    eventoBotonesPaginacion(partidasOrdenadas);
}

let partidas = [];
let partidasPorPagina = 5;
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
    // document.body.scrollTop = 0;
    // document.documentElement.scrollTop = 0;
    var tbody = $('tbody');
    tbody.empty();

    $.each(partidas, function (index, obj) {
        console.log(obj);
        var tbody = $('tbody');
        var row = $('<tr>').attr('id', obj.id);
        var logoCell = $('<td>').append($('<img>').addClass('logo-imagen').attr('src', obj.logo).attr('alt', 'Logo'));
        var nombreJuegoCell = $('<td>').text(obj.nombreJuego);
        var jugadoresCell = $('<td>').text(obj.numeroJugadores);
        var jugadorGanadorCell = $('<td>').text(obj.vencedor);
        var puntuacionCell = $('<td>').text(obj.puntuacionVencedor);
        var fechaCell = $('<td>').text(obj.fecha);
        var duracionCell = $('<td>').text(obj.tiempoJuego);
        var accionesCell = $('<td>').html('<button type="button" class="btn btn-warning me-2">Editar</button><button type="button" class="btn btn-danger">Eliminar</button>');

        row.append(logoCell, nombreJuegoCell, jugadoresCell, jugadorGanadorCell, puntuacionCell, fechaCell, duracionCell, accionesCell);
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
$(document).ready(function () {

    generarPartidasYBotones(primeraVez);

    // eventoBotonesPaginacion();
});
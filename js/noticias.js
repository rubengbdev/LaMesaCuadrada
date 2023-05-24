let noticias = [];
let noticiasPorPagina = 3;
let numeroPaginas;
let primeraVez;
let paginaActual;
let pagina = -1;

function generarNoticiasYBotones(primeraVez) {
    if (primeraVez == undefined) {
        $.ajax({
            url: 'http://localhost:8001/noticias',
            method: 'GET',
            dataType: 'json',
            success: function (response) {

                noticias = response;
                //Genera botones la primera vez
                numeroPaginas = Math.ceil(response.length / noticiasPorPagina);
                //PRIMERA CARGA
                pagina = 1;

                // Obtener la parte correspondiente de las noticias según la página seleccionada
                let inicio = (pagina - 1) * noticiasPorPagina; // Índice de inicio
                let fin = inicio + noticiasPorPagina; // Índice de fin (no inclusivo)
                let noticiasPagina = noticias.slice(inicio, fin);

                muestraNoticias(noticiasPagina);

                $(document).on('click', '.leerMas', function () {
                    var text = $(this).prev('.texto');
                    text.toggleClass('expanded');
                    if (text.hasClass('expanded')) {
                        $(this).text('Ver menos');
                    } else {
                        $(this).text('Ver más');
                    }
                });
                eventoBotonesPaginacion();
            },
            error: function (xhr, status, error) {
                console.log(error); // Manejar el error de acuerdo a tus necesidades
            }
        });
        primeraVez = false;
    }
}

function muestraNoticias(noticias) {

    $("#noticias-contenido").empty();
    // document.body.scrollTop = 0;
    // document.documentElement.scrollTop = 0;
    $.each(noticias, function (index, obj) {
        var $card = $('<div>').addClass('card mb-3');
        var $img = $('<img>').addClass('card-img-top imagen').attr('src', obj.imagen).attr('alt', '...');
        var $cardBody = $('<div>').addClass('card-body');
        var $title = $('<h3>').addClass('card-title titulo').text(obj.titulo);
        var $text = $('<article>').addClass('card-text clamp-text texto').html(obj.texto.replace(/\n/g, "<br>"));
        var $leerMas = $('<button>').addClass('btn btn-sm btn-outline-primary mt-2 leerMas').text('Ver más');
        var $cardFooter = $('<div>').addClass('card-footer');
        var $fecha = $('<small>').addClass('text-muted fecha').text('Fecha de Publicación: ' + obj.fecha);

        $card.append($img);
        $cardBody.append($title);
        $cardBody.append($text);


        $cardBody.append($leerMas);
        $card.append($cardBody);
        $cardFooter.append($fecha);
        $card.append($cardFooter);

        var $container = $('<div>').addClass('container-fluid my-4');
        var $row = $('<div>').addClass('row');
        var $col = $('<div>').addClass('col-12 col-md-8 offset-md-2 mx-auto');

        $col.append($card);
        $row.append($col);
        $container.append($row);

        $('#noticias-contenido').append($container);
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
                inicio = (pagina - 1) * noticiasPorPagina; // Índice de inicio
                fin = inicio + noticiasPorPagina; // Índice de fin (no inclusivo)
                noticiasPagina = noticias.slice(inicio, fin);
                $("#inicio").prop("disabled", true);
                $("#anterior").prop("disabled", true);
                $("#siguiente").prop("disabled", false);
                $("#final").prop("disabled", false);
                muestraNoticias(noticiasPagina);
                break;
            case "anterior":
                pagina--;
                inicio = (pagina - 1) * noticiasPorPagina; // Índice de inicio
                fin = inicio + noticiasPorPagina; // Índice de fin (no inclusivo)
                noticiasPagina = noticias.slice(inicio, fin);
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
                muestraNoticias(noticiasPagina);
                break;
            case "siguiente":
                pagina++;
                inicio = (pagina - 1) * noticiasPorPagina; // Índice de inicio
                fin = inicio + noticiasPorPagina; // Índice de fin (no inclusivo)
                noticiasPagina = noticias.slice(inicio, fin);
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
                muestraNoticias(noticiasPagina);
                break;
            case "final":
                pagina = numeroPaginas;
                inicio = (pagina - 1) * noticiasPorPagina; // Índice de inicio
                fin = inicio + noticiasPorPagina; // Índice de fin (no inclusivo)
                noticiasPagina = noticias.slice(inicio, fin);
                $("#siguiente").prop("disabled", true);
                $("#final").prop("disabled", true);
                $("#inicio").prop("disabled", false);
                $("#anterior").prop("disabled", false);
                muestraNoticias(noticiasPagina);
                break;
        }
    });
}
$(document).ready(function () {

    generarNoticiasYBotones(primeraVez);

    // eventoBotonesPaginacion();
});
let primeraCarga = true;

$(document).ready(function () {

    $.ajax({
        url: 'http://localhost:8001/noticias',
        method: 'GET',
        dataType: 'json',
        success: function (response) {

            //Genera botones la primera vez
            let noticiasPorPagina = 1;
            let numeroPaginas = Math.ceil(response.length / noticiasPorPagina);

            let paginacionBotones = $("#paginacion-botones");

            let siguiente = $("#siguiente");

            for (let i = 1; i <= numeroPaginas; i++) {
                if (i == 1) {
                    $("<button>", {
                        class: "botones btn btn-sm btn-outline-primary active",
                        text: i,
                        id: i
                    }).insertBefore(siguiente);
                } else if (numeroPaginas > 3) {
                    if (i <= 3) {
                        $("<button>", {
                            class: "botones btn btn-sm btn-outline-primary",
                            text: i,
                            id: i
                        }).insertBefore(siguiente);
                    } else {
                        $("<button>", {
                            class: "botones btn btn-sm btn-outline-primary d-none",
                            text: i,
                            id: i
                        }).insertBefore(siguiente);
                    }
                }
            }

            $(".botones").click(function () {
                // Lógica a ejecutar cuando se hace clic en un botón de paginación
                let pagina = $(this).attr("id");
                console.log(pagina);
                if (pagina == "siguiente") {
                    let botonActivo = $(".botones.btn.btn-sm.btn-outline-primary.active").attr("id");
                    let botonObjetivo = parseInt(botonActivo) + 1;

                    if (botonObjetivo <= numeroPaginas) {

                        $(".botones.btn.btn-sm.btn-outline-primary.active").removeClass("active");
                        $(".botones").each(function () {
                            if ($(this).attr('id') == botonObjetivo) {
                                $(this).addClass("active");
                                console.log($(this).attr("id") +"CAMBIAR TODO");
                            }
                            if ($(this).attr('id') == botonObjetivo || $(this).attr('id') == botonObjetivo + 1 || $(this).attr('id') == botonObjetivo - 1) {
                                $(this).removeClass("d-none");
                            } else if ($(this).attr('id') !== "siguiente" && $(this).attr('id') !== "anterior") {
                                if (botonObjetivo != numeroPaginas) {
                                    $(this).addClass("d-none");
                                }
                            }
                            if (botonObjetivo > 1) {
                                $("#anterior").removeClass("d-none");
                            }
                        })
                    }
                } else if (pagina == "anterior") {
                    let botonActivo = $(".botones.btn.btn-sm.btn-outline-primary.active").attr("id");
                    let botonObjetivo = parseInt(botonActivo) - 1;

                    if (botonObjetivo > 0) {
                        $(".botones.btn.btn-sm.btn-outline-primary.active").removeClass("active");
                        $(".botones").each(function () {
                            if ($(this).attr('id') == botonObjetivo) {
                                $(this).addClass("active");
                                console.log($(this).attr("id") +"EL BUEN EVENTO");
                            }
                            if ($(this).attr('id') == botonObjetivo || $(this).attr('id') == botonObjetivo + 1 || $(this).attr('id') == botonObjetivo - 1) {
                                $(this).removeClass("d-none");
                            } else if ($(this).attr('id') !== "siguiente" && $(this).attr('id') !== "anterior") {
                                if (botonObjetivo != 1) {
                                    $(this).addClass("d-none");
                                }
                            }
                            if (botonObjetivo > 1) {
                                $("#anterior").removeClass("d-none");
                            }
                        })
                    }

                } else {
                    $(".botones").removeClass("active"); // Quita la clase "active" de todos los botones
                    $(this).addClass("active");
                }

            });


            $.each(response, function (index, obj) {
                var $card = $('<div>').addClass('card mb-3');
                var $img = $('<img>').addClass('card-img-top imagen').attr('src', obj.imagen).attr('alt', '...');
                var $cardBody = $('<div>').addClass('card-body');
                var $title = $('<h5>').addClass('card-title titulo').text(obj.titulo);
                var $text = $('<article>').addClass('card-text clamp-text texto').text(obj.texto);
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
            });
            $(document).on('click', '.leerMas', function () {
                var text = $(this).prev('.texto');
                text.toggleClass('expanded');
                if (text.hasClass('expanded')) {
                    $(this).text('Ver menos');
                } else {
                    $(this).text('Ver más');
                }
            });
        },
        error: function (xhr, status, error) {
            console.log(error); // Manejar el error de acuerdo a tus necesidades
        }
    });
});
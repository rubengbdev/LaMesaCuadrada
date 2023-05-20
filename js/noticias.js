$(document).ready(function() {
                $.ajax({
                    url: 'http://localhost:8001/noticias',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $.each(response, function(index, obj) {
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
                        $(document).on('click', '.leerMas', function() {
                            var text = $(this).prev('.texto');
                            text.toggleClass('expanded');
                            if (text.hasClass('expanded')) {
                                $(this).text('Ver menos');
                            } else {
                                $(this).text('Ver más');
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Manejar el error de acuerdo a tus necesidades
                    }
                });
            });
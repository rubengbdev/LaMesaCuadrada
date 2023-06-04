/**
 * Evento encargado del subit del inicio de sesion
 */
$(document).ready(function() {
    $('#login-form').submit(function(event) {
        event.preventDefault(); // Evitar envío predeterminado del formulario

        // Obtener los datos del formulario
        var formData = $(this).serialize();

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8001/login',
            data: formData,
            success: function(response) {

                if (response == "null") {

                    $(document).ready(function() {
                        var errorMessage = '<p id="error-msg">Datos erróneos</p>';
                        var $existingErrorMsg = $('#error-msg');

                        if ($existingErrorMsg.length) {
                            // El mensaje de error ya existe, actualizar su contenido
                            $existingErrorMsg.text('Datos erróneos');
                        } else {
                            // El mensaje de error no existe, crearlo
                            $('.errorLogin').before(errorMessage);
                        }

                        $('#error-msg').css('color', 'red');

                        // En caso de que quieras actualizar el mensaje de error en algún momento
                        function actualizarMensajeError(nuevoMensaje) {
                            $('#error-msg').text(nuevoMensaje);
                        }
                    });

                } else {
                    let userData = JSON.parse(response); // Analizar la respuesta JSON

                    let nombre = userData.usuario_nombre;
                    let email = userData.usuario_email;
                    let tipo = userData.usuario_tipo;

                    document.cookie = "nombre=" + nombre;
                    document.cookie = "correo=" + email;
                    document.cookie = "tipo=" + tipo;

                    window.location.href = window.location.href;
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});
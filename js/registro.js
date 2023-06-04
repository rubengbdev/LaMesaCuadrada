/**
 * Evento que valida los datos introducidos para permitir o no el envio de la peticion
 */
$(document).ready(function () {
    var nombreValido = false;
    var correoValido = false;
    var contrasenaValida = false;

    // Validar el campo de nombre
    $('#registro input[name="nombre"]').keyup(function () {
        var nombreInput = $(this);
        var nombreError = $('#nombre-error');
        var nombre = nombreInput.val();
        if (nombre.length < 4 || !nombre.match(/^[a-zA-Z0-9]+$/)) {
            nombreInput.addClass('error-field');
            if (nombreError.length) {
                nombreError.text('El nombre debe tener al menos 4 caracteres alfanuméricos.');
            } else {
                nombreError.text('El nombre debe tener al menos 4 caracteres alfanuméricos.').appendTo(nombreInput.parent());
            }
            nombreValido = false;
        } else {
            nombreInput.removeClass('error-field');
            nombreError.empty();
            nombreValido = true;
        }

        habilitarBotonRegistro();
    });

    // Validar el campo de correo
    $('#registro input[name="correo"]').keyup(function () {
        var emailInput = $(this);
        var emailError = $('#correo-error');
        var email = emailInput.val();
        var emailPattern = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/;
        if (!email.match(emailPattern)) {
            emailInput.addClass('error-field');
            if (emailError.length) {
                emailError.text('El correo debe tener el formato correcto, por ejemplo: ejemplo@gmail.com.');
            } else {
                emailError.text('El correo debe tener el formato correcto, por ejemplo: ejemplo@gmail.com.').appendTo(emailInput.parent());
            }
            correoValido = false;
        } else {
            emailInput.removeClass('error-field');
            emailError.empty();
            correoValido = true;
        }

        habilitarBotonRegistro();
    });

    $('#registro input[name="contrasena"], #registro input[name="contrasena-repetir"]').keyup(function () {
        var contrasenaInput = $('#registro input[name="contrasena"]');
        var contrasenaRepetirInput = $('#registro input[name="contrasena-repetir"]');
        var contrasenaError = $('#contrasena-error');
        var contrasena = contrasenaInput.val();
        var contrasenaRepetir = contrasenaRepetirInput.val();
        if (contrasena.length < 5 || contrasena !== contrasenaRepetir) {
            contrasenaInput.addClass('error-field');
            contrasenaRepetirInput.addClass('error-field');
            if (contrasenaError.length) {
                contrasenaError.text('La contraseña debe tener al menos 5 caracteres y coincidir en ambos campos.');
            } else {
                contrasenaError.text('La contraseña debe tener al menos 5 caracteres y coincidir en ambos campos.').appendTo(contrasenaRepetirInput.parent());
            }
            contrasenaValida = false;
        } else {
            contrasenaInput.removeClass('error-field');
            contrasenaRepetirInput.removeClass('error-field');
            contrasenaError.empty();
            contrasenaValida = true;
        }

        habilitarBotonRegistro();
    });

    $('#registro #propagacion input[type="checkbox"]').change(function () {
        terminosAceptados = $(this).is(':checked');
        habilitarBotonRegistro();
    });

    // Función para habilitar o deshabilitar el botón de registro
    function habilitarBotonRegistro() {
        var formCompleto = true;
        $('#registro .errorRegistro .form-error').empty();

        $('#registro input[required]').each(function () {
            if ($(this).val() === '') {
                formCompleto = false;
                return false;
            }
        });

        if (formCompleto && nombreValido && correoValido && contrasenaValida && terminosAceptados) {
            $('#boton-registro').prop('disabled', false);
        } else {
            $('#boton-registro').prop('disabled', true);
        }
    }
});

/**
 * Evento que controla la peticion al back
 */
$(document).ready(function () {
    $('#registro').submit(function (event) {
        event.preventDefault(); // Evitar envío predeterminado del formulario

        // Obtener los datos del formulario
        var formData = $(this).serialize();

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8001/registro',
            data: formData,
            success: function (response) {

                if (response == "null") {

                    $(document).ready(function () {
                        $('.errorRegistro').before('<p id="error-msg">Datos erroneos</p>');
                        $('#error-msg').css('color', 'red');
                    });
                } else {

                    alert("Usuario registrado con exito, pulse aceptar para ser redirigido a donde se encontraba");
                    window.location.href = window.location.href;
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores de la solicitud
                console.log(error);
            }
        });
    });
});
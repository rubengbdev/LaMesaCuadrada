$(document).ready(function () {

    $('#olvidarForm').submit(function (event) {
        event.preventDefault();

        let correo = $('#correo').val();
        let nuevaContrasena = $('#nuevaContrasena').val();
        let repetirContrasena = $('#repetirContrasena').val();

        if (nuevaContrasena != repetirContrasena) {

            $("#mensajeError").text('Las contraseñas nueva y su repetición no coinciden').show();
        } else {
            $.ajax({
                url: 'http://localhost:8001/usuario',
                type: 'PUT',
                dataType: 'json',
                data: JSON.stringify({
                    contrasena_olvidada: "null",
                    correo: correo,
                    contrasena_nueva: nuevaContrasena
                }),
                success: function (response) {
                    console.log(response);
                    alert("Contraseña restablecida con exito, pulsa aceptar para volver a Actualidad e iniciar sesión");
                    window.location.href = '../index.php';
                },
                error: function (xhr, status, error) {

                    console.error(error);
                }
            });
        }
    });
});
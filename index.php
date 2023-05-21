<?php
session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location index.php");

    $_SESSION['token_login'] = bin2hex(random_bytes(16));
    $_SESSION['token_registro'] = bin2hex(random_bytes(16));
}
if (isset($_COOKIE['correo'])) {

    $_SESSION['usuario'] = $_COOKIE['correo'];
    $_SESSION['usuario_tipo'] = $_COOKIE['tipo'];
    $_SESSION['nombre'] = $_COOKIE['nombre'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>La Mesa Cuadrada</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- EDITOR TEXTAREA -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/index.css" />
    <!-- <link rel="stylesheet" href="css/foro.css"> -->
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg navbar-transparent">

        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logo.png" alt="logo" width="50em" height="50em">
                <b>La Mesa Cuadrada</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav text-light">
                    <a href="index.php" class="nav-item nav-link active">Actualidad</a>
                    <a href="pages/foro.php" class="nav-item nav-link ">Foro</a>
                    <a href="pages/tienda.html" class="nav-item nav-link ">Tienda</a>
                    <a href="pages/registro_partidas.html" class="nav-item nav-link ">Registro de Partidas</a>
                </div>

                <div class="navbar-nav ms-auto ml-auto action-buttons">

                    <?php if (!isset($_SESSION['usuario'])) : ?>
                        <div class="nav-item dropdown pr-2">
                            <a href="#" role="button" data-bs-toggle="dropdown" class="btn btn-success dropdown-toggle sign-up-btn movida">Login</a>
                            <div class="dropdown-menu action-form">
                                <form id="login-form" action="api/controller" method="post">
                                    <!-- value=\"{$_SESSION['token']}\" -->
                                    <input type="hidden" name="token_login" value="<?= $_SESSION['token_login'] ?>">
                                    <input type="hidden" name="login">
                                    <div class="form-group errorLogin">
                                        <input type="text" name="correo" class="form-control" placeholder="Usuario" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required="required">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                                    <div class="text-center mt-2">
                                        <a href="#">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script>
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
                                                    $('.errorLogin').before('<p id="error-msg">Datos erroneos</p>');
                                                    $('#error-msg').css('color', 'red');
                                                });

                                            } else {
                                                console.log(response);
                                                let userData = JSON.parse(response); // Analizar la respuesta JSON

                                                let nombre = userData.usuario_nombre;
                                                let email = userData.usuario_email;
                                                let tipo = userData.usuario_tipo;

                                                document.cookie = "nombre=" + nombre;
                                                document.cookie = "correo=" + email;
                                                document.cookie = "tipo=" + tipo;

                                                window.location.href = 'index.php';
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    });
                                });
                            });
                        </script>

                        <div class="nav-item dropdown" id="movida">
                            <a href="#" role="button" data-bs-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Registrarse</a>
                            <div class="dropdown-menu action-form">
                                <form id="registro" action="api/controller" method="post">
                                    <p class="hint-text">Rellena el formulario para crear tu cuenta</p>
                                    <input type="hidden" name="token_registro" value="<?= $_SESSION['token_registro'] ?>">
                                    <input type="hidden" name="registro">
                                    <div class="form-group errorRegistro">
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="correo" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirma Contraseña" required>
                                    </div>
                                    <div class="form-group">
                                        <label id="propagacion" class="form-check-label">
                                            <input type="checkbox" required> Acepto las <a href="#">Terminos &amp;
                                                Condiciones</a>
                                        </label>
                                    </div>
                                    <input id="boton-registro" type="submit" class="btn btn-primary btn-block" value="Registrarse" disabled>
                                </form>
                            </div>
                        </div>

                        <script>
                            /*MIRAR SI EL FORMULARIO ESTA CUMPLIMENTO*/
                            $(document).ready(function() {
                                // Escuchar el evento de cambio en los campos del formulario
                                $('#registro input').on('change', function() {
                                    var formCompleto = true;

                                    // Verificar si hay algún campo vacío
                                    $('#registro input[required]').each(function() {
                                        if ($(this).val() === '') {
                                            formCompleto = false;
                                            return false; // Salir del bucle each si hay un campo vacío
                                        }
                                    });

                                    // Habilitar o deshabilitar el botón de registro según el estado del formulario
                                    if (formCompleto) {
                                        $('#boton-registro').prop('disabled', false);
                                    } else {
                                        $('#boton-registro').prop('disabled', true);
                                    }
                                });
                            });

                            /*PETICION*/
                            $(document).ready(function() {
                                $('#registro').submit(function(event) {
                                    event.preventDefault(); // Evitar envío predeterminado del formulario

                                    // Obtener los datos del formulario
                                    var formData = $(this).serialize();

                                    // Realizar la solicitud AJAX
                                    $.ajax({
                                        type: 'POST',
                                        url: 'http://localhost:8001/registro',
                                        data: formData,
                                        success: function(response) {

                                            if (response == "null") {

                                                $(document).ready(function() {
                                                    $('.errorRegistro').before('<p id="error-msg">Datos erroneos</p>');
                                                    $('#error-msg').css('color', 'red');
                                                });
                                            } else {

                                                let tiempoEspera = 2000;
                                                let urlDestino = window.location.href;
                                                alert("Usuario registrado con exito, pulse aceptar para ser redirigido a donde se encontraba");

                                                function redirigir() {
                                                    window.location.href = urlDestino;
                                                }
                                                setTimeout(redirigir, tiempoEspera);
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            // Manejar errores de la solicitud
                                            console.log(error);
                                        }
                                    });
                                });
                            });
                        </script>
                    <?php else : ?>

                        <div class="nav-item dropdown pr-2">
                            <button class="btn btn-success btn-outline-dark opciones-btn" style="border: 3px solid black;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="texto-bienvenida"><?= "Hola " . $_SESSION['nombre'] ?></span>
                                <script>
                                    $(document).ready(function() {
                                        var nombreCookie = getCookie("nombre");
                                        var saludo = "Hola " + nombreCookie;

                                        $(".texto-bienvenida").text(saludo);
                                    });

                                    // Función para obtener el valor de una cookie por su nombre
                                    function getCookie(nombre) {
                                        var name = nombre + "=";
                                        var decodedCookie = decodeURIComponent(document.cookie);
                                        var cookies = decodedCookie.split(';');
                                        for (var i = 0; i < cookies.length; i++) {
                                            var cookie = cookies[i];
                                            while (cookie.charAt(0) == ' ') {
                                                cookie = cookie.substring(1);
                                            }
                                            if (cookie.indexOf(name) == 0) {
                                                return cookie.substring(name.length, cookie.length);
                                            }
                                        }
                                        return "";
                                    }
                                </script>
                                <span class="tres-puntos">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </span>
                            </button>
                            <form id="logout-form" method="post">
                                <div class="dropdown-menu action-form" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Mi cuenta</a>
                                    <a class="dropdown-item" href="#">Mis pedidos</a>
                                    <a class="dropdown-item" href="#">Mis pedidos</a>
                                    <input type="submit" class="btn btn-danger btn-block" style="border: 3px solid black;" value="Cerrar Sesión">
                                </div>
                            </form>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#logout-form').submit(function(event) {
                                    event.preventDefault(); // Evitar envío predeterminado del formulario

                                    // Obtener los datos del formulario
                                    var formData = $(this).serialize();

                                    // Realizar la solicitud AJAX
                                    $.ajax({
                                        type: 'POST',
                                        url: 'http://localhost:8001/logout',
                                        data: formData,
                                        success: function(response) {
                                            console.log("Adios colega");
                                            document.cookie = "correo" + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                                            document.cookie = "nombre" + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                                            document.cookie = "tipo" + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

                                            window.location.href = 'index.php';
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    });
                                });
                            });
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <?php if (isset($_SESSION['usuario_tipo']) && ($_SESSION['usuario_tipo'] == "a")) : ?>
            <div class="container-fluid my-4">
                <div class="row">
                    <div class="col-12 text-center mx-auto">
                        <button class=" btn btn-lg btn-primary" id="crearNoticias">Crear Noticia</button>
                    </div>
                </div>
                <hr>
                <div class="row d-none no-gutters" id="crearNoticiasForm">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="publicar-noticias">
                                    <div class="mb-3">
                                        <label for="newsImageInput" class="form-label">Enlace de la imagen</label>
                                        <input type="text" name="imagen" class="form-control" id="newsImageInput" name="newsImageInput">
                                    </div>
                                    <div class="mb-3">
                                        <label for="newsTextInput" class="form-label">Texto</label>
                                        <div id="editor"></div>
                                        <textarea class="d-none" name="texto" id="newsTextInput" name="newsTextInput"></textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-secondary" id="cancelarNoticia">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="publicarNoticia">Publicar</button>
                                    </div>
                                </form>
                                <!-- CREAR NOTICIAS -->
                                <script>
                                    const crearNoticias = document.querySelector('#crearNoticias');
                                    const crearNoticiasForm = document.querySelector('#crearNoticiasForm');
                                    const cancelarNoticia = document.querySelector('#cancelarNoticia');

                                    crearNoticias.addEventListener('click', () => {
                                        crearNoticias.classList.add('d-none');
                                        crearNoticiasForm.classList.remove('d-none');
                                    });

                                    cancelarNoticia.addEventListener('click', () => {
                                        crearNoticias.classList.add('d-none');
                                        crearNoticiasForm.classList.remove('d-none');
                                    });
                                </script>
                                <script>
                                    // Inicializar el editor de texto
                                    var quill = new Quill('#editor', {
                                        modules: {
                                            toolbar: [
                                                ['bold', 'italic', 'underline', 'strike'], // Negrita, cursiva, subrayado y tachado
                                                [{
                                                    'size': ['small', false, 'large', 'huge']
                                                }], // Tamaño del texto
                                                [{
                                                    'color': []
                                                }, {
                                                    'background': []
                                                }] // Color del texto y del fondo
                                            ]
                                        },
                                        theme: 'snow'
                                    });
                                    // Escuchar el evento submit del formulario
                                    //PUBLICAR NOTICIAS:
                                    $(document).ready(function() {
                                        $('#publicarNoticia').click(function(event) {
                                            event.preventDefault(); // Evitar el envío del formulario por defecto

                                            var formData = {
                                                imagen: $('#newsImageInput').val(),
                                                texto: $('#newsTextInput').val()
                                            };

                                            // Convertir formData a JSON
                                            var jsonData = JSON.stringify(formData);

                                            // Realizar la solicitud Ajax
                                            $.ajax({
                                                url: 'http://localhost:8001/noticias',
                                                type: 'POST',
                                                data: jsonData,
                                                contentType: 'application/json',
                                                success: function(response) {
                                                    // Manejar la respuesta del servidor
                                                    console.log(response);
                                                },
                                                error: function(xhr, status, error) {
                                                    // Manejar errores de la solicitud
                                                    console.log(xhr.responseText);
                                                }
                                            });
                                        });
                                    });


                                    // var form = document.querySelector('form');
                                    // form.addEventListener('submit', function(e) {
                                    //     // Actualizar el valor del textarea oculto con el contenido del editor
                                    //     var newsTextInput = document.querySelector('#newsTextInput');
                                    //     newsTextInput.value = quill.root.innerHTML;
                                    // });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>


    <main>

        <div id="noticias-contenido"></div>

        <div id="paginacion-contenedor" class="d-flex justify-content-center  p-3">
            <div id="paginacion-borde" class="w-20 border rounded bg-white p-3">
                <div id="paginacion-botones" class="d-flex justify-content-center">
                    <button id="anterior" class="botones btn btn-sm btn-outline-primary d-none">Anterior</button>
                    <button id="siguiente" class="botones btn btn-sm btn-outline-primary">Siguiente</button>
                </div>
            </div>
        </div>

    </main>

    <!-- Carga de noticias y paginacion -->
    <div class="pagination"></div>
    <script src="./js/noticias.js"></script>

    <footer class="bg-dark text-light py-3 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>La Mesa Cuadrada &copy; 2023. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#">Contacto</a>
                    <a href="#">Política de privacidad</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        $('.read-more-btn').click(function() {
            var text = $(this).prev();
            text.toggleClass('expanded');
            if (text.hasClass('expanded')) {
                $(this).text('Ver menos');
            } else {
                $(this).text('Ver más');
            }
        });
        $("#propagacion").on("click", function(event) {
            event.stopPropagation();
        });

        //Tema de ver mas del body de las noticias
        const readMoreButtons = document.querySelectorAll('.leerMas');
        readMoreButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const text = btn.previousElementSibling;
                text.classList.toggle('expanded');
                if (text.classList.contains('expanded')) {
                    btn.textContent = 'Ver menos';
                } else {
                    btn.textContent = 'Ver más';
                }
            });
        });
    </script>

    <!-- BOTON SCROLL -->
    <button onclick="topFunction()" id="scrollBtn" class="btn btn-primary rounded-circle"><i class="bi bi-arrow-up"></i></button>
    <script src="./js/botonScroll.js"></script>
</body>

</html>
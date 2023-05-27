<?php
session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location registro_partidas.php");

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
    <title>Registro de Partidas - La Mesa Cuadrada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/registro_partidas.css" />
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg navbar-transparent">

        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../img/logo.png" alt="logo" width="50em" height="50em">
                <b id="titulo">La Mesa Cuadrada</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav text-light">
                    <a href="../index.php" class="nav-item nav-link navegacion">Actualidad</a>
                    <a href="foro.php" class="nav-item nav-link navegacion">Foro</a>
                    <a href="registro_partidas.php" class="nav-item nav-link active navegacion">Registro de Partidas</a>
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

                                                document.cookie = "nombre=" + nombre + "; path=/";
                                                document.cookie = "correo=" + email + "; path=/";
                                                document.cookie = "tipo=" + tipo + "; path=/";

                                                window.location.href = 'registro_partidas.php';
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

                                            window.location.href = 'registro_partidas.php';
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


    <main>
        <div class="container-fluid">
            <h1 class="text-center my-4 text-light">El Buen Registro de Partidas</h1>
            <div class="row mb-3">
                <div class="col-md-6">
                    <form class="d-flex">
                        <input class="form-control me-3" type="search" placeholder="Buscar" aria-label="Buscar">
                        <button class="btn btn-outline-primary" type="submit">Buscar por nombre de juego</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-12">
                    <div claas="table-responsive">
                        <table class="table rounded rounded-3 table-bordered table-striped">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th scope="col">Logo</th>
                                    <th scope="col">Nombre Juego</th>
                                    <th scope="col">Participantes</th>
                                    <th scope="col">Vencedor</th>
                                    <th scope="col">Puntuación Vencedor</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Tiempo de Juego</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-success">
                                <tr>
                                    <td><img src="https://via.placeholder.com/50x50.png?text=Logo1" alt="Logo"></td>
                                    <td>Juego 1</td>
                                    <td>5</td>
                                    <td>Jugador 3</td>
                                    <td>10</td>
                                    <td>12/05/2023</td>
                                    <td>30 minutos</td>
                                    <td>
                                        <button type="button" class="btn btn-warning me-2">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            Guardar
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/50x50.png?text=Logo2" alt="Logo"></td>
                                    <td>Juego 2</td>
                                    <td>4</td>
                                    <td>Jugador 2</td>
                                    <td>8</td>
                                    <td>11/05/2023</td>
                                    <td>45 minutos</td>
                                    <td>
                                        <button type="button" class="btn btn-warning me-2">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            Guardar
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/50x50.png?text=Logo2" alt="Logo"></td>
                                    <td>Juego 214</td>
                                    <td>4</td>
                                    <td>Jugador 2</td>
                                    <td>8</td>
                                    <td>11/05/2023</td>
                                    <td>45 minutos</td>
                                    <td>
                                        <button type="button" class="btn btn-warning me-2">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            Guardar
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/50x50.png?text=Logo2" alt="Logo"></td>
                                    <td>Juego 424</td>
                                    <td>4</td>
                                    <td>Jugador 2</td>
                                    <td>8</td>
                                    <td>11/05/2023</td>
                                    <td>45 minutos</td>
                                    <td>
                                        <button type="button" class="btn btn-warning me-2">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            Guardar
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="https://cf.geekdo-images.com/nagl1li6kYt9elV9jbfVQw__imagepage/img/bmtHK2zXBEUD-Wme7CvkPbL0goA=/fit-in/900x600/filters:no_upscale():strip_icc()/pic6228507.jpg" alt="Logo"></td>
                                    <td>Juego 2</td>
                                    <td>4</td>
                                    <td>Jugador 2</td>
                                    <td>8</td>
                                    <td>11/05/2023</td>
                                    <td>45 minutos</td>
                                    <td>
                                        <button type="button" class="btn btn-warning me-2">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            Guardar
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                                </li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="container-fluid col-md-3 col-8" id="movida2">
                    <h2>Añadir nueva partida</h2>
                    <form>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="text" class="form-control" id="logo" name="logo">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del juego</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="participantes" class="form-label">Número de participantes</label>
                            <input type="number" class="form-control" id="participantes" name="participantes">
                        </div>
                        <div class="mb-3">
                            <label for="vencedor" class="form-label">Vencedor</label>
                            <input type="text" class="form-control" id="vencedor" name="vencedor">
                        </div>
                        <div class="mb-3">
                            <label for="puntuacion" class="form-label">Puntuación del vencedor</label>
                            <input type="number" class="form-control" id="puntuacion" name="puntuacion">
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="tiempo" class="form-label">Tiempo de juego</label>
                            <input type="time" class="form-control" id="tiempo" name="tiempo">
                        </div>
                        <button type="submit" class="btn btn-primary">Añadir juego</button>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <!-- 

        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="card rounded-3 shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Juegos</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-2 fw-bold">Logo</div>
                                <div class="col-12 col-md-2 fw-bold">Nombre Juego</div>
                                <div class="col-12 col-md-1 fw-bold">Participantes</div>
                                <div class="col-12 col-md-2 fw-bold">Vencedor</div>
                                <div class="col-12 col-md-2 fw-bold">Puntuación Vencedor</div>
                                <div class="col-12 col-md-1 fw-bold">Fecha</div>
                                <div class="col-12 col-md-1 fw-bold">Tiempo de Juego</div>
                                <div class="col-12 col-md-1 fw-bold">Acciones</div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-2">
                                            <img src="logo_juego.png" alt="Logo Juego" class="img-fluid">
                                        </div>
                                        <div class="col-12 col-md-2">Nombre del Juego 1</div>
                                        <div class="col-12 col-md-1">4</div>
                                        <div class="col-12 col-md-2">Usuario1</div>
                                        <div class="col-12 col-md-2">500</div>
                                        <div class="col-12 col-md-1">10/05/2023</div>
                                        <div class="col-12 col-md-1">60 min</div>
                                        <div class="col-12 col-md-1">
                                            <button type="button" class="btn btn-sm btn-warning me-1">Editar</button>
                                            <button type="button" class="btn btn-sm btn-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </main>
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
        $("#propagacion").on("click", function(event) {
            event.stopPropagation();
        });
    </script>
</body>

</html>
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: foro.php");
    exit();
}

if (!isset($_SESSION['usuario'])) {
    header("Location foro.php");

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
    <title>Foro - La Mesa Cuadrada</title>
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/foro.css" />
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg navbar-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><img src="../img/logo.png" alt="logo" width="50em" height="50em">
                <b id="titulo">La Mesa Cuadrada</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav text-light">
                    <a href="../index.php" class="nav-item nav-link navegacion">Actualidad</a>
                    <a href="foro.php" class="nav-item nav-link navegacion seleccionado">Foro</a>
                    <a href="registro_partidas.php" class="nav-item nav-link navegacion">Registro de Partidas</a>
                </div>

                <div class="navbar-nav ms-auto ml-auto action-buttons">

                    <?php if (!isset($_SESSION['usuario'])) : ?>
                        <div class="nav-item dropdown pr-2">
                            <a href="#" role="button" data-bs-toggle="dropdown" class="btn btn-success dropdown-toggle sign-up-btn movida">Iniciar sesión</a>
                            <div class="dropdown-menu action-form rounded">
                                <form id="login-form" action="api/controller" method="post">
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
                        <script src="../js/loginSubPaginas.js"></script>
                        <div class="nav-item dropdown" id="movida">
                            <a href="#" role="button" data-bs-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Registrarse</a>
                            <div class="dropdown-menu action-form rounded">
                                <form id="registro" action="api/controller" method="post">
                                    <p class="hint-text">Rellena el formulario para crear tu cuenta</p>
                                    <input type="hidden" name="token_registro" value="<?= $_SESSION['token_registro'] ?>">
                                    <input type="hidden" name="registro">
                                    <div class="form-group errorRegistro">
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                                        <p id="nombre-error" style="color: red;"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="correo" class="form-control" placeholder="Email" required>
                                        <p id="correo-error" style="color: red;"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="contrasena-repetir" class="form-control" placeholder="Confirma Contraseña" required>
                                        <p id="contrasena-error" style="color: red;"></p>
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
                        <script src="../js/registro.js"></script>
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
                                <div class="dropdown-menu action-form rounded" aria-labelledby="dropdownMenuButton">
                                    <?php if ($_SESSION['usuario_tipo'] == "a") : ?>
                                        <a class="dropdown-item" href="mi_cuenta_admin.php">Mi cuenta personal</a>
                                        <a class="dropdown-item" href="mi_cuenta.php">Gestion de usuarios</a>
                                    <?php else : ?>
                                        <a class="dropdown-item" href="mi_cuenta.php">Mi cuenta</a>
                                    <?php endif; ?>
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

                                            window.location.href = 'foro.php';
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
        <a href="foro.php" class="btn btn-primary m-4" id="otroHilo">Ver otro hilo</a>
        <div class="container-fluid">
            <div class="row justify-content-center mt-2 mb-2">
                <div class="col-lg-8 col-md-10 col-12">
                    <div class="row">
                        <?php if (isset($_SESSION['usuario_tipo']) && ($_SESSION['usuario_tipo'] == "a")) : ?>
                            <div class="d-flex justify-content-center my-3">
                                <button type="button" class="btn btn-danger" id="eliminarHilo">Eliminar hilo</button>
                            </div>
                        <?php endif; ?>
                        <div class="col-12">
                            <div id="general-mensajes" class="collapse show" aria-labelledby="headingOne">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-center my-3">
                                <?php if (isset($_SESSION['usuario'])) : ?>
                                    <div class="card mb-3 h-100 my-1 w-100" style="max-width: 30rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Mensaje</h5>
                                            <form id="publicar-mensaje">
                                                <div class="mb-3">
                                                    <label for="texto" class="form-label">Mensaje</label>
                                                    <textarea class="form-control" id="texto" name="texto" rows="4"></textarea>
                                                </div>
                                                <input type="hidden" name="titulo" value="null">
                                                <input type="hidden" name="nombre_usuario" value="<?= $_SESSION['nombre'] ?>">
                                                <input type="hidden" name="id_hilo" value="<?= $_GET['id'] ?>">
                                                <div class="text-end">
                                                    <input type="submit" class="btn btn-primary btn-block" value="Publicar mensaje">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="paginacion-contenedor" class="d-flex justify-content-center p-3">
                            <div id="paginacion-borde" class="w-20 border rounded bg-white p-3">
                                <p id="mostrando"></p>
                                <div id="paginacion-botones" class="d-flex justify-content-center">
                                    <button type="button" id="inicio" class="botones btn btn-sm btn-primary text-white fw-bold" disabled>
                                        <span class="bi bi-chevron-bar-left"></span>
                                    </button>

                                    <button type="button" id="anterior" class="botones btn btn-sm btn-primary text-white fw-bold" disabled>
                                        <span class="bi bi-chevron-left"></span>
                                    </button>

                                    <button type="button" id="siguiente" class="botones btn btn-sm btn-primary text-white fw-bold">
                                        <span class="bi bi-chevron-right"></span>
                                    </button>

                                    <button type="button" id="final" class="botones btn btn-sm btn-primary text-white fw-bold">
                                        <span class="bi bi-chevron-bar-right"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!isset($_SESSION['usuario_tipo'])) : ?>

            <script src="../js/mensaje.js"></script>

        <?php elseif ($_SESSION['usuario_tipo'] == "u") : ?>

            <script src="../js/mensaje.js"></script>

        <?php else : ?>

            <script src="../js/mensajeAdmin.js"></script>

        <?php endif; ?>
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
    <button onclick="topFunction()" id="scrollBtn" class="btn btn-primary rounded-circle"><i class="bi bi-arrow-up"></i></button>
    <script src="../js/botonScroll.js"></script>
</body>

</html>
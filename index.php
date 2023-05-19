<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    $_SESSION['token_login'] = bin2hex(random_bytes(16));
}

if (isset($_COOKIE['correo'])) {
    $correo = $_COOKIE['correo'];

    // Asignar el valor de la cookie a una variable de sesión
    $_SESSION['usuario'] = $correo;
}

if (isset($_SESSION['destruir'])) {
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>La Mesa Cuadrada</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- EDITOR TEXTAREA -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="css/foro.css"> -->
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logo.png" alt="logo" width="50em" height="50em">
                <b>La Mesa Cuadrada</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav text-light">
                    <a href="index.php" class="nav-item nav-link active">Actualidad</a>
                    <a href="pages/foro.html" class="nav-item nav-link ">Foro</a>
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
                                                document.cookie = "nombre=" + nombre;
                                                document.cookie = "correo=" + email;

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
                                <form action="api/controller" method="post">
                                    <p class="hint-text">Rellena el formulario para crear tu cuenta</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Contraseña" required>
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
                                    <input type="submit" class="btn btn-primary btn-block" value="Registrarse">
                                </form>
                            </div>
                        </div>

                    <?php else : ?>

                        <div class="nav-item dropdown pr-2">
                            <button class="btn btn-success dropdown-toggle sign-up-btn movida" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 1 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                            <form id="logout-form" action="api/controller" method="post">
                                <div class="dropdown-menu action-form" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Mi cuenta</a>
                                    <input type="submit" class="btn btn-primary btn-block" value="Cerrar Sesión">
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
    <main>
        <div class="container-fluid my-4">
            <div class="row">
                <div class="col-12 text-center mx-auto"">
                    <button class=" btn btn-lg btn-primary" id="createNewsBtn">Crear Noticia</button>
                </div>
            </div>
            <hr>
            <div class="row d-none no-gutters" id="createNewsForm">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="newsImageInput" class="form-label">Imagen</label>
                                    <input type="file" class="form-control" id="newsImageInput">
                                </div>
                                <div class="mb-3">
                                    <label for="newsTextInput" class="form-label">Texto</label>
                                    <div id="editor"></div>
                                    <textarea class="d-none" id="newsTextInput" name="newsTextInput"></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary" id="cancelNewsBtn">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BOTON SCROLL V2-->

        <button onclick="topFunction()" id="scrollBtn" class="btn btn-primary rounded-circle"><i class="bi bi-arrow-up"></i></button>

        <script>
            // Muestra el botón cuando el usuario ha desplazado 20 píxeles desde la parte superior de la página
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("scrollBtn").style.display = "block";
                } else {
                    document.getElementById("scrollBtn").style.display = "none";
                }
            }

            // Cuando el usuario hace clic en el botón, vuelve al inicio de la página
            function topFunction() {
                document.body.scrollTop = 0; // Para Safari
                document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE y Opera
            }
        </script>
        <!-- CREAR NOTICIAS -->
        <script>
            const createNewsBtn = document.querySelector('#createNewsBtn');
            const createNewsForm = document.querySelector('#createNewsForm');
            const cancelNewsBtn = document.querySelector('#cancelNewsBtn');

            createNewsBtn.addEventListener('click', () => {
                createNewsBtn.classList.add('d-none');
                createNewsForm.classList.remove('d-none');
            });

            cancelNewsBtn.addEventListener('click', () => {
                createNewsForm.classList.add('d-none');
                createNewsBtn.classList.remove('d-none');
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
            var form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // Actualizar el valor del textarea oculto con el contenido del editor
                var newsTextInput = document.querySelector('#newsTextInput');
                newsTextInput.value = quill.root.innerHTML;
            });
        </script>
        <div class="container-fluid my-4">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2 mx-auto">
                    <div class="card mb-3">
                        <img src="https://via.placeholder.com/500x500.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Noticia 1</h5>
                            <article class="card-text clamp-text">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                    lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend
                                    eu.
                                    Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium
                                    elementum.
                                    Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                    vehicula. Nulla rutrum nulla quis orci consequat auctor. Sed fringilla bibendum nisi
                                    ac
                                    dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                    lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend
                                    eu.
                                    Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium
                                    elementum.
                                    Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                    vehicula. Nulla rutrum nulla quis orci consequat auctor. Sed fringilla bibendum nisi
                                    ac
                                    dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                    lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend
                                    eu.
                                    Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium
                                    elementum.
                                    Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                    vehicula. Nulla rutrum
                                <h3>wadawd</h3>ulla quis orci consequat auctor. Sed fringilla bibendum nisi ac
                                dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend eu.
                                Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium elementum.
                                Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                vehicula. Nulla rutrum nulla quis orci consequat auctor. Sed fringilla bibendum nisi ac
                                dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend eu.
                                Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium elementum.
                                Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                vehicula. Nulla rutrum nulla quis orci consequat auctor. Sed fringilla bibendum nisi ac
                                dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend eu.
                                Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium elementum.
                                Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                vehicula. Nulla rutrum nulla quis orci consequat auctor. Sed fringilla bibendum nisi ac
                                dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                    lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend
                                    eu.
                                    Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium
                                    elementum.
                                    Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                    vehicula. Nulla rutrum nulla quis orci consequat auctor. Sed fringilla bibendum nisi
                                    ac
                                    dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                                </p>
                            </article>

                            <button class="btn btn-sm btn-outline-primary mt-2 read-more-btn">Ver más</button>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Publicado hace 1 hora</small>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <h6>Comentarios</h6>
                                    <div class="media border p-3">
                                        <img src="https://via.placeholder.com/50x50.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                        <div class="media-body">
                                            <h6>John Doe <small><i>Publicado el 01/01/2022</i></small></h6>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam ex
                                                sit amet est rutrum tempus. Pellentesque semper arcu in mauris bibendum
                                                interdum. Nunc rutrum mi ac ex pharetra, vel dapibus neque sagittis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2 mx-auto text-center">
                    <div class="card mb-3">
                        <img src="https://via.placeholder.com/100x100.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Noticia 1</h5>
                            <p class="card-text clamp-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor elit vitae
                                lorem ultricies tincidunt. Sed tincidunt fermentum nisi, quis commodo neque eleifend eu.
                                Duis vel tellus ac arcu euismod luctus. Donec vel magna eget felis pretium elementum.
                                Sed vitae tristique nulla. Maecenas euismod felis a purus aliquam, a suscipit massa
                                vehicula. Nulla rutrum nulla quis orci consequat auctor. Sed fringilla bibendum nisi ac
                                dapibus. Vivamus ut dolor suscipit, placerat magna a, lobortis odio.
                            </p>
                            <button class="btn btn-sm btn-outline-primary mt-2 read-more-btn">Ver más</button>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Publicado hace 1 hora</small>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <h6>Comentarios</h6>
                                    <div class="media border p-3">
                                        <img src="https://via.placeholder.com/50x50.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                        <div class="media-body">
                                            <h6>John Doe <small><i>Publicado el 01/01/2022</i></small></h6>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam ex
                                                sit amet est rutrum tempus. Pellentesque semper arcu in mauris bibendum
                                                interdum. Nunc rutrum mi ac ex pharetra, vel dapibus neque sagittis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mx-auto text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="/noticias?page=2">1</a></li>
                            <li class="page-item"><a class="page-link" href="/noticias?page=2">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

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

        //Tema de ver mas del body de las noticias
        const readMoreButtons = document.querySelectorAll('.read-more-btn');
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
</body>

</html>
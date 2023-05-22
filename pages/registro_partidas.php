<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Foro - La Mesa Cuadrada</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: 'Varela Round', sans-serif;
            position: relative;
            min-height: 100vh;
            padding-bottom: 10em;
            background-image: linear-gradient(109.6deg, rgb(41, 31, 63) 11.2%, rgb(2, 6, 48) 91.1%);
        }

        #movida2 {
            background-color: #d6d6d6;
            border-radius: 3em;
            border: solid 0.5rem black;
            padding: 1em;
        }

        .form-control {
            box-shadow: none;
            font-weight: normal;
            font-size: 13px;
        }

        .navbar {
            background: #fff;
            padding-left: 16px;
            padding-right: 16px;
            border-bottom: 1px solid #dfe3e8;
            border-radius: 0;
        }

        .nav-link img {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            margin: -8px 0;
            float: left;
            margin-right: 10px;
        }

        .navbar .navbar-brand {
            padding-left: 0;
            font-size: 20px;
            padding-right: 50px;
        }

        .navbar .navbar-brand b {
            color: #33cabb;
        }

        .navbar .form-inline {
            display: inline-block;
        }

        .navbar a {
            color: #888;
            font-size: 15px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-right: 35px;
            border-color: #dfe3e8;
            border-radius: 4px !important;
            box-shadow: none
        }

        .search-box .input-group-text {
            min-width: 35px;
            border: none;
            background: transparent;
            position: absolute;
            right: 0;
            z-index: 9;
            padding: 7px;
            height: 100%;
        }

        .search-box i {
            color: #a0a5b1;
            font-size: 19px;
        }

        .navbar .sign-up-btn {
            min-width: 110px;
            max-height: 36px;
        }

        .navbar .dropdown-menu {
            color: #999;
            font-weight: normal;
            border-radius: 1px;
            border-color: #e5e5e5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }

        .navbar a {
            color: #ffffff;
            padding: 8px 20px;
            background: transparent;
            line-height: normal;
        }

        .active {
            color: blue;
            text-shadow: 0px 0px 30px red, 0px 0px 30px white, 0px 0px 30px white, 0px 0px 10px #553300, 0px 0px 10px #553300;
        }


        .navbar .navbar-form {
            border: none;
        }

        .navbar .action-form {
            width: 280px;
            padding: 20px;
            left: auto;
            right: 0;
            font-size: 14px;
        }

        .navbar .action-form a {
            color: #33cabb;
            padding: 0 !important;
            font-size: 14px;
        }

        .navbar .action-form .hint-text {
            text-align: center;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .navbar .btn-primary,
        .navbar .btn-primary:active {
            color: #fff;
            background: #33cabb !important;
            border: none;
        }

        .dropdown-menu .form-group {
            margin-bottom: 10px;
        }

        .navbar .btn-success,
        .navbar .btn-success:active {
            color: #fff;
            background: #108a00 !important;
            border: none;
        }

        .navbar .btn-primary:hover,
        .navbar .btn-primary:focus {
            color: #fff;
            background: #31bfb1 !important;
        }

        .navbar .action-buttons .dropdown-toggle::after {
            display: none;
        }

        .form-check-label input {
            position: relative;
            top: 1px;
        }

        @media (min-width: 1200px) {
            .form-inline .input-group {
                width: 300px;
                margin-left: 30px;
            }
        }

        @media (max-width: 768px) {
            .navbar .dropdown-menu.action-form {
                width: 100%;
                padding: 10px 15px;
                background: transparent;
                border: none;
            }

            .navbar .form-inline {
                display: block;
            }

            .navbar .input-group {
                width: 100%;
            }
        }

        .movida {

            margin-right: 20px;
        }

        @media (min-width: 992px) {}

        .card-header button {
            color: #007bff;
        }

        .card-header button:hover {
            text-decoration: none;
            color: #0069d9;
        }

        .list-group-item:hover {
            background-color: #f2f2f2;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .list-group,
        .card {
            max-width: 100%;
            overflow-x: auto;
        }

        .table{
   display: block !important;
   overflow-x: auto !important;
   width: 100% !important;
 }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../img/logo.png" alt="logo" width="50em" height="50em">
                <b>La Mesa Cuadrada</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-start">
                <div class="navbar-nav text-light">
                    <a href="../indexFinal.html" class="nav-item nav-link ">Actualidad</a>
                    <a href="./foro.html" class="nav-item nav-link ">Foro</a>
                    <a href="#" class="nav-item nav-link ">Tienda</a>
                    <a href="./registro_partidas.html" class="nav-item nav-link active">Registro de Partidas</a>
                </div>

                <div class="navbar-nav ms-auto ml-auto action-buttons">


                    <div class="nav-item dropdown pr-2">
                        <a href="#" role="button" data-bs-toggle="dropdown"
                            class="btn btn-success dropdown-toggle sign-up-btn movida">Login</a>
                        <div class="dropdown-menu action-form">
                            <form action="/examples/actions/confirmation.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Usuario" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Contraseña"
                                        required="required">
                                </div>
                                <input type="submit" class="btn btn-primary btn-block" value="Login">
                                <div class="text-center mt-2">
                                    <a href="#">¿Olvidaste tu contraseña?</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="nav-item dropdown" id="movida">
                        <a href="#" role="button" data-bs-toggle="dropdown"
                            class="btn btn-primary dropdown-toggle sign-up-btn">Registrarse</a>
                        <div class="dropdown-menu action-form">
                            <form action="/examples/actions/registro.php" method="post">
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
                                    <input type="password" class="form-control" placeholder="Confirma Contraseña"
                                        required>
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
        $("#propagacion").on("click", function (event) {
            event.stopPropagation();
        });
    </script>
</body>

</html>
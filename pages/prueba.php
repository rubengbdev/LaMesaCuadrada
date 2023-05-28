<?php
session_start();


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
<div id="general-mensajes" class="collapse show" aria-labelledby="headingOne">
    <div class="card-body h-70">
        <div class="card mb-3 h-100">
            <div class="row g-0 h-100">
                <div class="col-2 border-end border-primary h-100">
                    <div class="card-body d-flex align-items-center">
                        <h5 class="card-title">Usuario1</h5>
                    </div>
                </div>
                <div class="col-10 h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Título del mensaje</h5>
                        <p class="card-text">Contenido del mensaje</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repetir la estructura de la tarjeta para cada mensaje -->
    </div>
</div>
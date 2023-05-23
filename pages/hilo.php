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
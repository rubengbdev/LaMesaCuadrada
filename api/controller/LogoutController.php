<?php
session_start();

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

        session_unset();
        session_destroy();
        echo "OK";
        $cookies = $_COOKIE;

        // Iterar sobre todas las cookies y eliminarlas una por una
        foreach ($cookies as $cookie_name => $cookie_value) {
            // Establecer la fecha de caducidad en el pasado para eliminar la cookie
            setcookie($cookie_name, '', time() - 3600);
            // Opcionalmente, también puedes establecer el path y el dominio de la cookie:
            // setcookie($cookie_name, '', time() - 3600, '/', 'dominio.com');
        }

        // Limpiar el array $_COOKIE
        $_COOKIE = array();
        break;
}

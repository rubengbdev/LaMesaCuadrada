<?php

require_once("../service/service_implement/PartidaServiceImpl.php");
require_once("../service/service_implement/UsuarioServiceImpl.php");

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":

        if (isset($_GET["emailUsuario"])) {

            $servicio = new PartidaServiceImpl();
            $datos = $servicio->getAllByUser($_GET['emailUsuario']);

            if (count($datos) > 0) {
                exit(json_encode($datos));
            } else {
                echo "No hay datos";
            }
        }

        break;

    case "POST":

        // if (isset($_POST["texto"]) && isset($_POST["titulo"]) && isset($POST_['nombre_usuario'])) {

            
            $numeroJugadores = seguridadFormularios($_POST["numeroJugadores"]);
            $puntuacionVencedor = seguridadFormularios($_POST["puntuacionVencedor"]);
            $fecha = seguridadFormularios($_POST["fecha"]);
            $nombreJuego = seguridadFormularios($_POST["nombreJuego"]);
            $nombreUsuario = seguridadFormularios($_POST["nombreUsuario"]);
            $logo = seguridadFormularios($_POST["logo"]);
            $tiempoJuego = seguridadFormularios($_POST["tiempoJuego"]);
            $vencedor = seguridadFormularios($_POST["vencedor"]);


            $servicio = new PartidaServiceImpl();
            $id = $servicio->crear($numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $nombreUsuario, $logo, $tiempoJuego, $vencedor);
            exit(json_encode($id));
        // }

        break;

    case "PUT":

        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new PartidaServiceImpl();
        $actualizado = $servicio->update($datos->id, $datos->numeroJugadores, $datos->puntuacionVencedor, $datos->fecha, $datos->nombreJuego, $datos->logo, $datos->tiempoJuego, $datos->vencedor);
        exit(json_encode($actualizado));

    case "DELETE":

        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new PartidaServiceImpl();
        $actualizado = $servicio->delete($datos->id);
        exit(json_encode($actualizado));

        break;
}

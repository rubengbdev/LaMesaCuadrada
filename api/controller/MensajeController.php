<?php

require_once("../service/service_implement/MensajeServiceImpl.php");
require_once("../service/service_implement/UsuarioServiceImpl.php");

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":

        if (isset($_GET["id_hilo"])) {

            $servicio = new MensajeServiceImpl();
            $datos = $servicio->getAllByHilo($_GET['id_hilo']);

            if (count($datos) > 0) {
                exit(json_encode($datos));
            } else {
                echo "No hay datos";
            }
        }

        break;

    case "POST":

        if (isset($_POST["texto"]) && isset($_POST["titulo"]) && isset($POST_['nombre_usuario'])) {

            $texto = seguridadFormularios($_POST["texto"]);
            $titulo = seguridadFormularios($_POST["titulo"]);

            $servicio = new MensajeServiceImpl();
            $id = $servicio->crear($_POST["id_hilo"],$_POST["texto"], $_POST["titulo"], $_POST['nombre_usuario']);
            exit(json_encode($id));
        }

        break;

    case "PUT":

        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new MensajeServiceImpl();
        $actualizado = $servicio->update($datos->id, $datos->titulo, $datos->texto);
        exit(json_encode($actualizado));

    case "DELETE":

        $datos = json_decode(file_get_contents('php://input'));
        print_r($datos);
        $servicio = new MensajeServiceImpl();
        $actualizado = $servicio->delete($datos->id);
        exit(json_encode($actualizado));

        break;
}

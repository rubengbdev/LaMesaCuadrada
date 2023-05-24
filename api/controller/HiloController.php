<?php

require_once("../service/service_implement/HiloServiceImpl.php");
require_once("../service/service_implement/UsuarioServiceImpl.php");

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":

        if (isset($_GET['id'])) {
                
            $servicio = new HiloServiceImpl();
            $datos = $servicio->obtenerHiloPorId($_GET['id']);

            exit(json_encode($datos));

        } else {

            $servicio = new HiloServiceImpl();
            $datos = $servicio->obtenerHilosPorTipo($_GET['hilo_tipo']);

            if (count($datos) > 0) {
                exit(json_encode($datos));
            } else {
                echo "No hay datos";
            }

        }

        break;

    case "POST":

        if (isset($_POST["texto"]) && isset($_POST["titulo"]) && isset($_POST["publicar_hilo"])) {
            
            $texto = seguridadFormularios($_POST["texto"]);
            $titulo = seguridadFormularios($_POST["titulo"]);

            $servicio = new HiloServiceImpl();
            $id = $servicio->crearHilo($_POST["texto"],"GENERAL",$_POST["titulo"]);
            exit(json_encode($id));
        }

        break;

    case "PUT":
        
        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new HiloServiceImpl();
        $actualizado = $servicio->update($datos->id, $datos->titulo, $datos->texto);
        exit(json_encode($actualizado));


        // if($datos != null) {
        //     //Los parametros se lo pasamos por el archivo json
        //     if(UserService::putUsuario($datos->id, $datos->correo, $datos->contrasena)) {
        //         $resultado[] = ["acceso" => true];
        //     } else {
        //         $resultado[] = ["acceso" => false];
        //     }

        //     exit(json_encode($resultado));
        // } else {
        //     echo "error";
        // }

        // break;

    case "DELETE":
        
        $datos = json_decode(file_get_contents('php://input'));
        print_r($datos);
        $servicio = new HiloServiceImpl();
        $actualizado = $servicio->delete($datos->id);
        exit(json_encode($actualizado));

        break;
}

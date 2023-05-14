<?php
require_once("../service/service_implement/UsuarioServiceImpl.php");
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":

        if (isset($_GET['id'])) {
                
            $servicio = new UsuarioServiceImpl();
            $datos = $servicio->obtenerUsuarioPorId($_GET['id']);

            exit(json_encode($datos));

        } else {

            $servicio = new UsuarioServiceImpl();
            $datos = $servicio->obtenerUsuarios();

            if (count($datos) > 0) {
                exit(json_encode($datos));
            } else {
                echo "No hay datos";
            }

        }

        break;

    case "POST":

        if (isset($_POST["correo"]) && isset($_POST["contrasena"]) && isset($_POST["login"]) && isset($_POST["tipo"])) {
             
            // $servicio = new UsuarioServiceImpl();
            // if ($servicio.)
            //     if (UserService::getUsuario($_POST['correo'], $_POST['contrasena'])) {
            //         $datos[] = ["acceso" => true];
            //     } else {
            //         $datos[] = ["acceso" => false];
            //     }
            //     exit(json_encode($datos));

        } elseif (isset($_GET["crear"])) {


            $datos = json_decode(file_get_contents('php://input'));

            $servicio = new UsuarioServiceImpl();

            $id = $servicio->crearUsuario($datos->nombre, $datos->correo, $datos->contrasena, $datos->tipo);

            exit(json_encode($id));
        }

        break;

    case "PUT":
        
        // $datos = json_decode(file_get_contents('php://input'));

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
        
        $id = $_GET["id"];
        $servicio = new UsuarioServiceImpl();
        
        if ($servicio->eliminarUsuario($_GET['id']) != null) {
            $resultado[] = ["borrado" => true];
        } else {
            $resultado[] = ["borrado" => false];
        }

        break;

}
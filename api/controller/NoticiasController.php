<?php
require_once("../service/service_implement/NoticiaServiceImpl.php");
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":

        if (isset($_GET['id'])) {
                
            $servicio = new NoticiaServiceImpl();
            $datos = $servicio->obtenerNoticiaPorId($_GET['id']);

            exit(json_encode($datos));

        } else {

            $servicio = new NoticiaServiceImpl();
            $datos = $servicio->obtenerNoticias();

            if (count($datos) > 0) {
                exit(json_encode($datos));
            } else {
                echo "No hay datos";
            }

        }

        break;

    case "POST":

        if (isset($_POST["texto"]) && isset($_POST["imagen"]) && isset($_POST["titulo"]) && isset($_POST["publicar"])) {
            
            $texto = seguridadFormularios($_POST["texto"]);
            $imagen = seguridadFormularios($_POST["imagen"]);
            $titulo = seguridadFormularios($_POST["titulo"]);

            $servicio = new NoticiaServiceImpl();
            $id = $servicio->crearNoticia($texto,$imagen,$titulo);

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
        $servicio = new NoticiaServiceImpl();
        
        if ($servicio->eliminarNoticiaPorId($_GET['id']) != null) {
            $resultado[] = ["borrado" => true];
        } else {
            $resultado[] = ["borrado" => false];
        }

        break;

}

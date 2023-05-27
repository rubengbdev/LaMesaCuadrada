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
        
        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new NoticiaServiceImpl();
        $actualizado = $servicio->update($datos->id, $datos->texto, $datos->imagen, $datos->titulo);
        exit(json_encode($actualizado));

    case "DELETE":
        
        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new NoticiaServiceImpl();
        $actualizado = $servicio->delete($datos->id);
        exit(json_encode($actualizado));

        break;

}

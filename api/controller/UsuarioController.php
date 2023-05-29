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
            $datos = $servicio->obtenerUsuariosDTO();

            if (count($datos) > 0) {
                exit(json_encode($datos));
            } else {
                echo "No hay datos";
            }

        }

        break;

    case "POST":

        if (isset($_POST["correo"]) && isset($_POST["contrasena"]) && isset($_POST["login"])) {
             
            $servicio = new UsuarioServiceImpl();
            $datos = $servicio->login($_POST['correo'], $_POST['contrasena']);
            if ($datos != null) {
                $_SESSION['usuario'] = $_POST['correo'];
                exit(json_encode($datos));
            } else {

                exit(json_encode(null));
            }

        } elseif (isset($_POST["correo"]) && isset($_POST["contrasena"]) && isset($_POST["registro"])) {
            
            $servicio = new UsuarioServiceImpl();
            $id = $servicio->crearUsuario($_POST["nombre"], $_POST["correo"], $_POST["contrasena"], "u");
            exit(json_encode($id));
        } else {
            if (isset($_POST['correo'])) {
                
                $servicio = new UsuarioServiceImpl();
                $datos = $servicio->obtenerUsuarioPorEmail($_POST['correo']);
    
                exit(json_encode($datos));
            }
        }

        break;

    case "PUT":
        
        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new UsuarioServiceImpl();
        $actualizado = $servicio->update($datos->id, $datos->nombre, $datos->email, $datos->contrasena);
        exit(json_encode($actualizado));

    case "DELETE":
        
        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new UsuarioServiceImpl();
        $actualizado = $servicio->delete($datos->id);
        exit(json_encode($actualizado));

        break;

}

<?php
session_start();
require_once("../service/service_implement/UsuarioServiceImpl.php");
switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":

        if (isset($_GET['id'])) {

            $servicio = new UsuarioServiceImpl();
            $datos = $servicio->obtenerUsuarioPorId($_GET['id']);

            exit(json_encode($datos));
        } elseif (isset($_GET['email'])) {

            $servicio = new UsuarioServiceImpl();
            $datos = $servicio->obtenerUsuarioDtoPorEmail($_GET['email']);

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

            if ($_POST["token_login"] == $_SESSION["token_login"]) {

                $servicio = new UsuarioServiceImpl();
                $datos = $servicio->login($_POST['correo'], $_POST['contrasena']);
                if ($datos != null) {
                    
                    $_SESSION['usuario'] = $_POST['correo'];
                    exit(json_encode($datos));
                } else {

                    exit(json_encode(null));
                }
            } else {

                exit(json_encode(null));
            }
        } elseif (isset($_POST["correo"]) && isset($_POST["contrasena"]) && isset($_POST["registro"])) {

            if ($_POST["token_registro"] == $_SESSION["token_registro"]) {

                $servicio = new UsuarioServiceImpl();
                $id = $servicio->crearUsuario($_POST["nombre"], $_POST["correo"], $_POST["contrasena"], "u");
                exit(json_encode($id));
            } else {

                exit(json_encode(null));
            }
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

        if (isset($datos->correo_nuevo)) {

            $servicio = new UsuarioServiceImpl();

            $datos = $servicio->updateCorreo($datos->correo, $datos->correo_nuevo);
            exit(json_encode($datos));
        }

        if (isset($datos->contrasena_olvidada)) {

            $servicio = new UsuarioServiceImpl();

            $datos = $servicio->updateContrasenaOlvidada($datos->correo, $datos->contrasena_nueva);
            exit(json_encode($datos));
        }

        if (isset($datos->contrasena_nueva)) {

            $servicio = new UsuarioServiceImpl();

            $datos = $servicio->updateContrasena($datos->correo, $datos->contrasena, $datos->contrasena_nueva);
            exit(json_encode($datos));
        } else {

            $servicio = new UsuarioServiceImpl();
            $actualizado = $servicio->update($datos->id, $datos->nombre, $datos->email, $datos->contrasena);
            exit(json_encode($actualizado));
        }


    case "DELETE":

        $datos = json_decode(file_get_contents('php://input'));
        $servicio = new UsuarioServiceImpl();
        $actualizado = $servicio->delete($datos->id);
        exit(json_encode($actualizado));

        break;
}

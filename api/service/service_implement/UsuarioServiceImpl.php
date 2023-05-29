<?php
require_once(__DIR__ . '../../../model/Usuario.php');
require_once(__DIR__ . '/../UsuarioService.php');
require_once(__DIR__ . '/MapperServiceImpl.php');
require_once(__DIR__ . '/../../model/DAO/UsuarioDAO.php');
require_once("../../php/funciones.php");


class UsuarioServiceImpl implements UsuarioService
{

    private $dao;

    public function __construct()
    {
        $this->dao = new UsuarioDao();
    }

    /* ------------------ GET ------------------ */

    public function obtenerUsuarioPorId($id)
    {

        if (!$id) {
            throw new Exception("Falta el ID del usuario");
        }
        $usuario = $this->dao->obtenerUsuarioPorId($id);

        if (!$usuario) {
            throw new Exception("Usuario no encontrado");
        }

        return $usuario;
    }

    public function findById($id)
    {
        try {
            $usuario = $this->dao->findById($id);
            return $usuario;
        } catch (PDOException $e) {
            // Manejo del error
            echo "Error al buscar usuario por ID: " . $e->getMessage();
            return null; // O cualquier otro manejo del error que desees
        }
    }

    public function obtenerUsuarioPorEmail($email)
    {

        $usuario = $this->dao->obtenerUsuarioPorEmail($email);
        if ($this->dao->obtenerUsuarioPorEmail($email)) {
            return $this->dao->obtenerUsuarioPorEmail($email);
        }
        return false;
    }


    public function obtenerUsuarioDtoPorEmail($email)
    {

        $mapperService = new MapperServiceImpl();


        if ($this->dao->obtenerUsuarioPorEmail($email)) {

            $usuario = $this->dao->obtenerUsuarioDtoPorEmail($email);
            return $mapperService->usuarioToDto($usuario)->toArray();
        }
        return false;
    }


    public function obtenerUsuarioPorNombre($nombre)
    {
        $usuario = $this->dao->obtenerUsuarioPorNombre($nombre);
        if ($this->dao->obtenerUsuarioPorNombre($nombre)) {
            return $this->dao->obtenerUsuarioPorNombre($nombre);
        }
        return false;
    }


    public function obtenerUsuarios()
    {

        $usuarios = $this->dao->obtenerUsuarios();

        if (count($usuarios) < 1) {
            throw new Exception("No hay usuarios");
        }
        header('Content-Type: application/json');

        return $usuarios;
    }

    public function obtenerUsuariosDTO()
    {

        $mapperService = new MapperServiceImpl();

        $usuarios = $this->dao->obtenerUsuariosDTO();

        if (count($usuarios) < 1) {
            throw new Exception("No hay usuarios");
        }
        header('Content-Type: application/json');

        $usuariosDTO = array();

        foreach ($usuarios as $usuario) {
            $usuarioDTO = $mapperService->usuarioToDto($usuario); // Llamada al método usuarioToDto
            $usuariosDTO[] = $usuarioDTO->toArray();
        }

        return $usuariosDTO;
    }



    /* ------------------ POST ------------------ */

    public function login($usuario, $contrasena)
    {

        $usuarioVerificado = seguridadFormularios($usuario);
        $contrasenaVerificado = seguridadFormularios($contrasena);

        //Añadir tema seguridad, es decir el verify

        if ($this->dao->existsByUsuarioContrasena($usuarioVerificado)) {

            return $this->dao->login($usuarioVerificado, $contrasenaVerificado);
        }

        return null;
    }

    public function updateContrasena($email, $contrasena, $contrasenaNueva)
    {

        $usuarioVerificado = seguridadFormularios($email);
        $contrasenaVerificado = seguridadFormularios($contrasena);
        $contrasenaNuevaVerificada = seguridadFormularios($contrasenaNueva);
        //Añadir tema seguridad, es decir el verify

        if ($this->dao->existsByUsuarioContrasena($usuarioVerificado)) {

            if ($this->dao->login($usuarioVerificado, $contrasenaVerificado) != null) {

                //Ciframos la nuva contraseña
                $salt = random_bytes(16);
                $saltHex = bin2hex($salt);
                $contrasenaConSalt = $contrasenaNuevaVerificada . $saltHex;
                $contraseñaCifrada = password_hash($contrasenaConSalt, PASSWORD_BCRYPT);

                try {

                    return $this->dao->updateContrasena($usuarioVerificado,$contraseñaCifrada,$saltHex);
                } catch (PDOException $e) {
        
                    echo "Error al crear el usuario: " . $e->getMessage();
                }
            }
        }
    }

    public function updateCorreo($correo, $correoNuevo) {

        $correoVerificado = seguridadFormularios($correo);
        $correoNuevoVerificado = seguridadFormularios($correoNuevo);

        try {

            return $this->dao->updateCorreo($correoVerificado,$correoNuevoVerificado);
        } catch (PDOException $e) {

            echo "Error al crear el usuario: " . $e->getMessage();
        }
    }

    public function crearUsuario($nombre, $email, $contrasena, $tipo) {

        $nombre = seguridadFormularios($nombre);
        $contrasena = seguridadFormularios($contrasena);
        $email = seguridadFormularios($email);
        $tipo = seguridadFormularios($tipo);

        $id = $this->dao->ultimoId();
        // validar los datos del usuario
        if (!$nombre || !$email || !$contrasena || !$tipo) {
            throw new Exception("Faltan datos del usuario");
        }

        // verificar que el email no esté registrado previamente
        $usuarioExistente = $this->dao->obtenerUsuarioPorEmail($email);
        if ($usuarioExistente != null) {
            return null;
            // throw new Exception("Ya existe un usuario con este correo electrónico");
        }

        // Obtener la fecha actual del servidor
        $fechaCreacion = date("Y-m-d H:i:s");

        // Generar un salt aleatorio para la contraseña
        $salt = random_bytes(16);

        //conversion a formato leible
        $saltHex = bin2hex($salt);

        // Concatenar el salt con la contraseña
        $contrasenaConSalt = $contrasena . $saltHex;

        // Cifrar la contraseña usando el algoritmo bcrypt y el salt generado
        $contraseñaCifrada = password_hash($contrasenaConSalt, PASSWORD_BCRYPT);


        try {

            return $this->dao->createUsuario(new Usuario($id, $nombre, $email, $tipo, $contraseñaCifrada, $fechaCreacion, $saltHex));
        } catch (PDOException $e) {

            echo "Error al crear el usuario: " . $e->getMessage();
        }
    }


    /* ------------------ PUT ------------------ */

    public function update($id, $nombre, $email, $password)
    {

        if (!$id) {
            throw new Exception("Falta el id de Partida");
        }

        $partida = $this->dao->findById($id);
        if (!$partida) {
            throw new Exception("Partida no encontrado");
        }

        // Cifrado de contrasena

        $salt = random_bytes(16);
        $saltHex = bin2hex($salt);
        $contrasenaConSalt = $password . $saltHex;
        $contraseñaCifrada = password_hash($contrasenaConSalt, PASSWORD_BCRYPT);

        return ($this->dao->update($id, $nombre, $email, $contraseñaCifrada, $saltHex));
    }


    /* ------------------ DELETE ------------------ */

    public function delete($id)
    {

        if (!$id) {
            throw new Exception("Falta el id de noticia");
        }

        $usuario = $this->dao->obtenerUsuarioPorId($id);
        if (!$usuario) {
            throw new Exception("Partida no encontrado");
        }

        return ($this->dao->delete($id));
    }
}

<?php

require_once("../model/Usuario.php");

class UsuarioDAO {

    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=" . "db" . ";dbname=" . "mesa_cuadrada";
        $this->pdo = new PDO($dsn, "root", "root");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function createUsuario(Usuario $usuario) {

        $stmt = $this->pdo->prepare('INSERT INTO mesa_cuadrada.usuario (usuario_nombre, usuario_email, usuario_contrasena, usuario_tipo, usuario_fecha_creacion) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$usuario->getNombre(), $usuario->getEmail(), $usuario->getContrasena(), $usuario->getTipo(), $usuario->getFechaCreacion()]);
        return $this->pdo->lastInsertId();

    }

    public function obtenerUsuarioPorId($id) {

        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE usuario_id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
                //Hacer una copia de usuarios con solo los elementos que queremos

        return $row;
    }

    public function obtenerUsuarioPorEmail($email) {

        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE usuario_email = ?');
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }
        return true;
        
    }

    public function obtenerUsuarios() {

        //meter todo en un try catch

        $stmt = $this->pdo->prepare('SELECT * FROM mesa_cuadrada.usuario');
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuarios = [];
            foreach ($stmt as $elemento) {
                $user = new Usuario($elemento['usuario_id'],$elemento['usuario_nombre'],$elemento['usuario_email'],$elemento['usuario_tipo'],$elemento['usuario_contrasena'],$elemento['usuario_fecha_creacion']);
                $usuarios[] = $user->toArray();
            }
            print_r($usuarios);
        //Hacer una copia de usuarios con solo los elementos que queremos

            return $usuarios;
        } else {
            return false;
        }

    }

    // public function update(Usuario $usuario) {
    //     $stmt = $this->pdo->prepare('UPDATE usuario SET nombre = ?, email = ?, password = ? WHERE id = ?');
    //     $stmt->execute([$usuario->getNombre(), $usuario->getEmail(), $usuario->getPassword(), $usuario->getId()]);
    //     return $stmt->rowCount();
    // }

    public function eliminarUsuario($id) {
        $stmt = $this->pdo->prepare('DELETE FROM usuario WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

                                            /*LOGIN*/

    public function existsByUsuarioContrasena($usuario, $contrasena) {
        
        $stmt = $this->pdo->prepare('SELECT COUNT(*) as total FROM usuario WHERE usuario_email = ? AND usuario_contrasena = ?');
        $stmt->execute([$usuario, $contrasena]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $row['total'];
    
        return $total > 0 ? true : false;
    }


    public function login($usuario, $contrasena) {
        
        $stmt = $this->pdo->prepare('SELECT usuario_nombre,usuario_email FROM usuario WHERE usuario_email = ? AND usuario_contrasena = ?');
        $stmt->execute([$usuario, $contrasena]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            
            return null;
        }

        return $row;
    }

}
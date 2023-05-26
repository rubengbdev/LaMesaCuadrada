<?php

require_once("../model/Mensaje.php");
require_once("../service/service_implement/MapperServiceImpl.php");

class MensajeDAO {

    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=" . "db" . ";dbname=" . "mesa_cuadrada";
        $this->pdo = new PDO($dsn, "root", "root");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /* ------------------ POST ------------------ */

    public function crear(Mensaje $mensaje) {

        $stmt = $this->pdo->prepare('INSERT INTO mesa_cuadrada.mensaje (id_hilo,mensaje_contenido,mensaje_titulo,mensaje_fecha,id_usuario) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$mensaje->getIdHilo(), $mensaje->getTexto(), $mensaje->getTitulo(), $mensaje->getFecha(), $mensaje->getIdUsuario()]);
        
        return $this->pdo->lastInsertId();
    }

    public function ultimoId() {
        return $this->pdo->lastInsertId() + 1;
    }

    /* ------------------ GET ------------------ */

    public function getById($id) {

        $stmt = $this->pdo->prepare('SELECT * FROM mensaje WHERE mensaje_id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {

            return null;
        }

        return $row;
    }

    public function getAllByHilo($idHilo) {

        $mapperService = new MapperServiceImpl();

        $stmt = $this->pdo->prepare('SELECT * FROM mensaje WHERE id_hilo = ? ORDER BY DATE_FORMAT(mensaje_fecha, "%Y-%m-%d %H:%i:%s") DESC');
        $stmt->execute([$idHilo]);

        if ($stmt->rowCount() > 0) {
            
            $Mensajes = [];

            foreach ($stmt as $elemento) {
                
                $mensaje = new Mensaje($elemento['mensaje_id'],$elemento['id_hilo'],$elemento['mensaje_contenido'],$elemento['mensaje_hilo'],$elemento['mensaje_fecha'], $elemento['id_usuario']);
                $mensajeDto = $mapperService->mensajeToDto($mensaje);
                $mensajes[] = $mensajeDto->toArray();
            }

            return $Mensajes;
        } else {

            return false;
        }
    }

    /* ------------------ PUT ------------------ */

    public function update($id, $titulo, $texto) {
        try {
            $stmt = $this->pdo->prepare('UPDATE mesa_cuadrada.mensaje SET mensaje_contenido = ?, mensaje_titulo = ? WHERE mensaje_id = ?');
            $stmt->execute([$texto, $titulo, $id]);
            $rowCount = $stmt->rowCount();
            
            if ($rowCount > 0) {
                $resultado[] = ["actualizado" => true];
                return $resultado;
            } else {
                $resultado[] = ["actualizado" => false];
                return $resultado;
            }
        } catch (PDOException $e) {
            echo 'Error en la actualización: ' . $e->getMessage();
            return null;
        }
    }

    /* ------------------ DELETE ------------------ */

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM mesa_cuadrada.mensaje WHERE mensaje_id = ?');
            $stmt->execute([$id]);
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                $resultado[] = ["borrado" => true];
                return $resultado;
            } else {
                $resultado[] = ["borrado" => false];
                return $resultado;
            }
        } catch (PDOException $e) {
            echo 'Error en el borrado: ' . $e->getMessage();
            return null;
        }
    }
}
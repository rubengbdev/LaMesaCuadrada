<?php

require_once("../model/Hilo.php");

class HiloDAO {

    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=" . "db" . ";dbname=" . "mesa_cuadrada";
        $this->pdo = new PDO($dsn, "root", "root");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function ultimoId() {
        return $this->pdo->lastInsertId() + 1;
    }

    public function crearHilo(Hilo $hilo) {

        $stmt = $this->pdo->prepare('INSERT INTO mesa_cuadrada.hilo (hilo_fecha,hilo_contenido,id_usuario,hilo_tipo,hilo_titulo) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$hilo->getFecha(), $hilo->getContenido(), $hilo->getIdUsuario(), $hilo->getTipo(), $hilo->getTitulo()]);
        
        $id = $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare('INSERT INTO mesa_cuadrada.mensaje (id_hilo,mensaje_contenido,mensaje_titulo,mensaje_fecha,id_usuario) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$id,$hilo->getContenido(), $hilo->getTitulo(),$hilo->getFecha(), $hilo->getIdUsuario()]);

        return $this->pdo->lastInsertId();
    }



    public function obtenerHiloPorId($id) {

        $stmt = $this->pdo->prepare('SELECT * FROM hilo WHERE hilo_id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {

            return null;
        }

        return $row;
    }

    public function obtenerHilosPorTipo($tipo) {

        $stmt = $this->pdo->prepare('SELECT * FROM hilo WHERE hilo_tipo = ? ORDER BY DATE_FORMAT(hilo_fecha, "%Y-%m-%d %H:%i:%s") DESC');
        $stmt->execute([$tipo]);

        if ($stmt->rowCount() > 0) {
            $hilos = [];
            foreach ($stmt as $elemento) {
                $hilo = new Hilo($elemento['hilo_id'],$elemento['hilo_titulo'],$elemento['hilo_contenido'],$elemento['hilo_tipo'],$elemento['hilo_fecha'], $elemento['id_usuario']);
                $hilos[] = $hilo->toArray();
            }

            return $hilos;
        } else {
            return false;
        }

    }

    public function update($id, $titulo, $texto) {
        try {
            $stmt = $this->pdo->prepare('UPDATE mesa_cuadrada.hilo SET hilo_contenido = ?, hilo_titulo = ? WHERE hilo_id = ?');
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

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM mesa_cuadrada.hilo WHERE hilo_id = ?');
            $stmt->execute([$id]);
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                $resultado[] = ["borrado" => true];
                return ($resultado);
            } else {
                $resultado[] = ["borrado" => false];
                return json_encode($resultado);
            }
        } catch (PDOException $e) {
            echo 'Error en la actualización: ' . $e->getMessage();
            return null;
        }
    }
}
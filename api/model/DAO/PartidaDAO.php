<?php

require_once("../model/Partida.php");
require_once("../service/service_implement/MapperServiceImpl.php");

class PartidaDAO {

    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=" . "db" . ";dbname=" . "mesa_cuadrada";
        $this->pdo = new PDO($dsn, "root", "root");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /* ------------------ POST ------------------ */

    public function crear(Partida $partida) {

        $stmt = $this->pdo->prepare('INSERT INTO mesa_cuadrada.partida (partida_numero_jugadores,partida_puntuacion_vencedor,partida_fecha,partida_nombre_juego,id_usuario,partida_logo,partida_tiempo,partida_vencedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$partida->getNumeroJugadores(), $partida->getPuntuacionVencedor(), $partida->getFecha(), $partida->getNombreJuego(), $partida->getIdUsuario(), $partida->getLogo(), $partida->getTiempoJuego(), $partida->getVencedor()]);
        
        return $this->pdo->lastInsertId();
    }

    public function ultimoId() {
        return $this->pdo->lastInsertId() + 1;
    }

    /* ------------------ GET ------------------ */

    public function getById($id) {

        $stmt = $this->pdo->prepare('SELECT * FROM partida WHERE partida_id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {

            return null;
        }

        return $row;
    }

    public function getAllByUser($idUsuario) {

        $mapperService = new MapperServiceImpl();

        $stmt = $this->pdo->prepare('SELECT * FROM partida WHERE id_usuario = ? ORDER BY DATE_FORMAT(partida_fecha, "%Y-%m-%d") DESC');
        $stmt->execute([$idUsuario]);

        if ($stmt->rowCount() > 0) {
            
            $partidas = [];

            foreach ($stmt as $elemento) {
                
                $partida = new Partida($elemento['partida_id'],$elemento['partida_numero_jugadores'],$elemento['partida_puntuacion_vencedor'],$elemento['partida_fecha'],$elemento['partida_nombre_juego'], $elemento['id_usuario'], $elemento['partida_logo'], $elemento['partida_tiempo'], $elemento['partida_vencedor']);
                $partidas[] = $partida->toArray();
            }
            return $partidas;
        } else {

            return false;
        }
    }

    /* ------------------ PUT ------------------ */

    public function update($id, $numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $logo, $tiempoJuego, $vencedor) {

        try {
            $stmt = $this->pdo->prepare('UPDATE mesa_cuadrada.partida SET partida_numero_jugadores = ?, partida_puntuacion_vencedor = ?, partida_fecha = ?, partida_nombre_juego = ?, partida_logo = ?, partida_tiempo = ?, partida_vencedor = ? WHERE partida_id = ?');
            $stmt->execute([$numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $logo, $tiempoJuego, $vencedor, $id]);
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

            $stmt = $this->pdo->prepare('DELETE FROM mesa_cuadrada.partida WHERE partida_id = ?');
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
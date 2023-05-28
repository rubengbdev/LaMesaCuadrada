<?php
require_once(__DIR__.'../../../model/Partida.php');
require_once (__DIR__.'/../PartidaService.php');
require_once(__DIR__.'/../../model/DAO/PartidaDAO.php');
require_once("../../php/funciones.php");
require_once (__DIR__.'../../service_implement/UsuarioServiceImpl.php');


class PartidaServiceImpl implements PartidaService {
 
    private $dao;

    public function __construct() {
        $this->dao = new PartidaDAO();
    }

    /********************GET********************/

    public function getById($id) {
        
        if (!$id) {
            throw new Exception("Falta el ID de Partida");
        }
        $hilo = $this->dao->getById($id);
        
        if (!$hilo) {
            throw new Exception("Partida no encontrado");
        }

        return $hilo;
    }

    public function getAllByUser($emailUsuario) {

        $servicioUsuario = new UsuarioServiceImpl();
         // Asumiendo que el id del usuario está en la clave 'id' del array devuelto

        $resultadoUsuario = $servicioUsuario->obtenerUsuarioPorEmail($emailUsuario);

        $idUsuario = $resultadoUsuario['usuario_id'];

        $partidas = $this->dao->getAllByUser($idUsuario);

        if (count($partidas) < 1 || !is_array($partidas)) {

            throw new Exception("No hay Partidas");
        }
        header('Content-Type: application/json');

        return $partidas;
    }

    /********************POST********************/

    public function crear($numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $nombreUsuario, $logo, $tiempoJuego, $vencedor) {

        if (!$puntuacionVencedor || !$nombreJuego) {
            throw new Exception("Faltan datos de Partida");
        }

        $id = $this->dao->ultimoId();
        
        try {

            $usuarioService = new UsuarioServiceImpl();
            $idUsuario =  $usuarioService->obtenerUsuarioPorNombre($nombreUsuario);

            return $this->dao->crear(new Partida($id, $numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $idUsuario, $logo, $tiempoJuego, $vencedor));
        } catch (PDOException $e) {

            echo "Error al crear Partida: " . $e->getMessage();
        }
    }
     

    /********************PUT********************/

    public function update($id, $numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $logo, $tiempoJuego, $vencedor) {

        if (!$id) {
            throw new Exception("Falta el id de Partida");
        }

        $partida = $this->dao->getById($id);
        if (!$partida) {
            throw new Exception("Partida no encontrado");
        }

        return ($this->dao->update($id, $numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $logo, $tiempoJuego, $vencedor));
    }

    /********************DELETE********************/

    public function delete($id) {

        if (!$id) {
            throw new Exception("Falta el id de noticia");
        }

        $usuario = $this->dao->getById($id);
        if (!$usuario) {
            throw new Exception("Partida no encontrado");
        }

        header('Content-Type: application/json');

        return ($this->dao->delete($id));
    }
}
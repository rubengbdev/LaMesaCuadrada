<?php

require_once('../model/DAO/PartidaDAO.php');

interface PartidaService {

    public function crear($numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $nombreUsuario, $logo, $tiempoJuego, $vencedor);
    public function getById($id);
    public function getAllByUser($emailUsuario);
    public function update($id, $numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $logo, $tiempoJuego, $vencedor);
    public function delete($id);
}
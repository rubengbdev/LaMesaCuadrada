<?php

class Partida {

    private $id;
    private $numeroJugadores;
    private $puntuacionVencedor;
    private $fecha;
    private $nombreJuego;
    private $idUsuario;
    private $logo;
    private $tiempoJuego;
    private $vencedor;

    public function __construct($id, $numeroJugadores, $puntuacionVencedor, $fecha, $nombreJuego, $idUsuario, $logo, $tiempoJuego, $vencedor) {
        $this->id = $id;
        $this->numeroJugadores = $numeroJugadores;
        $this->puntuacionVencedor = $puntuacionVencedor;
        $this->fecha = $fecha;
        $this->nombreJuego = $nombreJuego;
        $this->idUsuario = $idUsuario;
        $this->logo = $logo;
        $this->tiempoJuego = $tiempoJuego;
        $this->vencedor = $vencedor;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumeroJugadores() {
        return $this->numeroJugadores;
    }

    public function getPuntuacionVencedor() {
        return $this->puntuacionVencedor;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getNombreJuego() {
        return $this->nombreJuego;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getTiempoJuego() {
        return $this->tiempoJuego;
    }

    public function getVencedor() {
        return $this->vencedor;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumeroJugadores($numeroJugadores) {
        $this->numeroJugadores = $numeroJugadores;
    }

    public function setPuntuacionVencedor($puntuacionVencedor) {
        $this->puntuacionVencedor = $puntuacionVencedor;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setNombreJuego($nombreJuego) {
        $this->nombreJuego = $nombreJuego;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setLogo($logo) {
        $this->logo = $logo;
    }

    public function setTiempoJuego($tiempoJuego) {
        $this->tiempoJuego = $tiempoJuego;
    }

    public function setVencedor($vencedor) {
        $this->vencedor = $vencedor;
    }

    public function toArray() {
        return array(
            'id' => $this->id,
            'numeroJugadores' => $this->numeroJugadores,
            'puntuacionVencedor' => $this->puntuacionVencedor,
            'fecha' => $this->fecha,
            'nombreJuego' => $this->nombreJuego,
            'idUsuario' => $this->idUsuario,
            'logo' => $this->logo,
            'tiempoJuego' => $this->tiempoJuego,
            'vencedor' => $this->vencedor
        );
    }
}
<?php

class MensajeDTO {

    private $id;
    private $idHilo;
    private $texto;
    private $titulo;
    private $fecha;
    private $nombreUsuario;

    public function __construct($id, $idHilo, $texto, $titulo, $fecha, $nombreUsuario) {
        $this->id = $id;
        $this->idHilo = $idHilo;
        $this->texto = $texto;
        $this->titulo = $titulo;
        $this->fecha = $fecha;
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdHilo() {
        return $this->idHilo;
    }

    public function setIdHilo($idHilo) {
        $this->idHilo = $idHilo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function toArray() {
        return array(
            'id' => $this->id,
            'idHilo' => $this->idHilo,
            'texto' => $this->texto,
            'titulo' => $this->titulo,
            'fecha' => $this->fecha,
            'nombreUsuario' => $this->nombreUsuario
        );
    }
}
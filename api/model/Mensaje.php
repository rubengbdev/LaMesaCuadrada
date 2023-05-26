<?php

class Mensaje {

    private $id;
    private $idHilo;
    private $texto;
    private $titulo;
    private $fecha;
    private $idUsuario;

    public function __construct($id, $idHilo, $texto, $titulo, $fecha, $idUsuario) {
        $this->id = $id;
        $this->idHilo = $idHilo;
        $this->texto = $texto;
        $this->titulo = $titulo;
        $this->fecha = $fecha;
        $this->idUsuario = $idUsuario;
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
    
    public function getIdUsuario() {
        return $this->idUsuario;
    }
    
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    
    public function toArray() {
        return array(
            'id' => $this->id,
            'idHilo' => $this->idHilo,
            'texto' => $this->texto,
            'titulo' => $this->titulo,
            'fecha' => $this->fecha,
            'idUsuario' => $this->idUsuario
        );
    }
}
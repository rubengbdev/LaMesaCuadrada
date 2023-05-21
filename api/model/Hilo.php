<?php

class Hilo {

    private $id;
    private $titulo;
    private $texto;
    private $tipo;
    private $fecha;
    private $idUsuario;

    public function __construct($titulo, $texto, $tipo, $fecha, $idUsuario) {
        
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->idUsuario = $idUsuario;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
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
        return [
            "id" => $this->id,
            "titulo" => $this->titulo,
            "texto" => $this->texto,
            "tipo" => $this->tipo,
            "fecha" => $this->fecha,
            "idUsuario" => $this->idUsuario
        ];
    }
}
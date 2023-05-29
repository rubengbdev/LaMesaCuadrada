<?php

class UsuarioDTO {
    private $id;
    private $nombre;
    private $email;
    private $fechaCreacion;

    public function __construct($id, $nombre, $email, $fechaCreacion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->fechaCreacion = $fechaCreacion;
    }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function toArray() {
        return array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'fechaCreacion' => $this->fechaCreacion
        );
    }
}
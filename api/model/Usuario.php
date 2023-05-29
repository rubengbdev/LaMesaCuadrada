<?php

class Usuario {

    private $id;
    private $nombre;
    private $email;
    private $tipo;
    private $contrasena;
    private $fechaCreacion;
    private $salt;
    //private $hilos; // relación uno a muchos con la tabla hilo


    public function __construct($id, $nombre, $email, $tipo, $contrasena, $fechaCreacion, $salt) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->tipo = $tipo;
        $this->fechaCreacion = $fechaCreacion;
        $this->salt = $salt;
    }




    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getContrasena() {
        return $this->contrasena;
    }
    
    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function getTipo() {
        return $this->tipo;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    } 

    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }
    
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getSalt() {
        return $this->salt;
    }
    
    public function setSalt($salt) {
        $this->salt = $salt;
    } 

    /* OTROS */

    public function toArray() {
        return array(
            'id' => $this->id,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'tipo' => $this->tipo,
            'contrasena' => $this->contrasena,
            'fechaCreacion' => $this->fechaCreacion
        );
    }
}
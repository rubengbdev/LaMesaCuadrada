<?php

class Usuario {

    private $id;
    private $nombre;
    private $email;
    private $tipo;
    private $contrasena;
    private $fechaCreacion;
    //private $hilos; // relación uno a muchos con la tabla hilo


    public function __construct( $nombre, $email, $tipo, $contrasena, $fechaCreacion) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->tipo = $tipo;
        $this->fechaCreacion = $fechaCreacion;
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
    
    // public function getHilos() {
    //     return $this->hilos;
    // }
    
    // public function setHilos($hilos) {
    //     $this->hilos = $hilos;
    // }
    
    // public function agregarHilo($hilo) {
    //     array_push($this->hilos, $hilo);
    // }

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

    /* OTROS */

    public function toArray() {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "email" => $this->email,
            "contrasena" => $this->contrasena,
            "fechaCreacion" => $this->fechaCreacion
        ];
    }
}
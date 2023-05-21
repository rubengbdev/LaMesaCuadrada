<?php

require_once('../model/DAO/ForoDAO.php');

interface ForoService {

    public function crearHilo($titulo,$texto,$tipo,$idUsuario);
    public function obtenerHiloPorId($id);
    public function obtenerHilosPorTipo($tipo);
}
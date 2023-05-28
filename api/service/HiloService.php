<?php

require_once('../model/DAO/HiloDAO.php');

interface HiloService {

    public function crear($texto,$tipo,$titulo,$nombreUsuario);
    public function obtenerHiloPorId($id);
    public function obtenerHilosPorTipo($tipo);
    public function update($id,$titulo,$texto);
    public function delete($id);
}
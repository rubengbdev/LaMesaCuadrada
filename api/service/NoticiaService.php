<?php

require_once('../model/DAO/NoticiaDAO.php');

interface NoticiaService {

    public function crearNoticia($texto, $imagen, $titulo);
    public function obtenerNoticias();
    public function obtenerNoticiaPorId($id);
    public function update($id, $texto, $imagen, $titulo);
    public function delete($id);
}
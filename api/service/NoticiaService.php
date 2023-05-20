<?php

require_once('../model/DAO/NoticiaDAO.php');

interface NoticiaService {

    public function crearNoticia($texto, $imagen, $titulo);
    public function obtenerNoticias();
    public function obtenerNoticiaPorId($id);
    public function actualizarNoticiaPorId($id);
    // public function actualizarUsuario($id, $nombre, $email, $password);
    public function eliminarNoticiaPorId($id);
}
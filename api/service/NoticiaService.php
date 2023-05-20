<?php

require_once('../model/DAO/NoticiaDao.php');

interface NoticiaService {

    public function crearNoticia($texto, $imagen);
    public function obtenerNoticias();
    public function obtenerNoticiaPorId($id);
    public function actualizarNoticiaPorId($id);
    // public function actualizarUsuario($id, $nombre, $email, $password);
    public function eliminarNoticiaPorId($id);
}
<?php

require_once('../model/DAO/UsuarioDAO.php');

interface UsuarioService {

    public function crearUsuario($nombre, $email, $password, $tipo);

    public function obtenerUsuarioPorId($id);
    public function obtenerUsuarios();
    public function obtenerUsuariosDTO();
    public function obtenerUsuarioDtoPorEmail($email);
    public function obtenerUsuarioPorEmail($email);
    public function obtenerUsuarioPorNombre($nombre);
    public function findById($id);

    public function login($usuario, $password);

    public function update($id, $nombre, $email, $password);

    public function delete($id);
}
<?php

require_once('../model/DAO/HiloDAO.php');

interface MensajeService {

    public function crear($idHilo,$texto,$titulo,$idUsuario);
    public function getById($id);
    public function getAllByHilo($id_hilo);
    public function update($id,$titulo,$texto);
    public function delete($id);
}
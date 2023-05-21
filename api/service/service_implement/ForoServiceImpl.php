<?php
require_once(__DIR__.'../../../model/Hilo.php');
require_once (__DIR__.'/../ForoService.php');
require_once(__DIR__.'/../../model/DAO/ForoDAO.php');
require_once("../../php/funciones.php");


class ForoServiceImpl implements ForoService {
 
    private $dao;

    public function __construct() {
        $this->dao = new ForoDAO();
    }

    /********************GET********************/

    public function obtenerHiloPorId($id) {
        
        if (!$id) {
            throw new Exception("Falta el ID de hilo");
        }
        $hilo = $this->dao->obtenerHiloPorId($id);
        
        if (!$hilo) {
            throw new Exception("Hilo no encontrado");
        }

        return $hilo;
    }

    public function obtenerHilosPorTipo($tipo) {

        $hilos = $this->dao->obtenerHilosPorTipo($tipo);

        if (count($hilos) < 1 || $hilos == null || $hilos == false) {
            throw new Exception("No hay hilos");
        }

        return $hilos;
    }

    /********************POST********************/

    public function crearHilo($titulo,$texto,$tipo,$idUsuario) {
        
        if (!$texto || !$titulo) {
            throw new Exception("Faltan datos de hilo");
        }

        $id = $this->dao->ultimoId();
        $fechaCreacion = date("Y-m-d H:i:s");
    
        try {

            return $this->dao->crearHilo(new Hilo($titulo,$texto,$tipo,$idUsuario));
        } catch (PDOException $e) {

            echo "Error al crear hilo: " . $e->getMessage();
        }
    }
        /********************DELETE********************/


    public function eliminarHiloPorId($id) {

        if (!$id) {
            throw new Exception("Falta el id de noticia");
        }

        $usuario = $this->dao->obtenerHiloPorId($id);
        if (!$usuario) {
            throw new Exception("Usuario no encontrado");
        }

        $this->dao->eliminarHiloPorId($id);
    }


}
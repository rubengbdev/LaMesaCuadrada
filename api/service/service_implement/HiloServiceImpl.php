<?php
require_once(__DIR__.'../../../model/Hilo.php');
require_once (__DIR__.'/../HiloService.php');
require_once(__DIR__.'/../../model/DAO/HiloDAO.php');
require_once("../../php/funciones.php");


class HiloServiceImpl implements HiloService {
 
    private $dao;

    public function __construct() {
        $this->dao = new HiloDAO();
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

    public function crear($texto,$tipo,$titulo) {

        if (!$texto || !$titulo) {
            throw new Exception("Faltan datos de hilo");
        }

        $servicioUsuario = new UsuarioServiceImpl();
        // $usuarioId = $servicioUsuario->obtenerUsuarioPorEmail($_SESSION['correo']);
        $usuarioId = 19;
        $id = $this->dao->ultimoId();
        $fecha = date("Y-m-d H:i:s");
        
        try {
            return $this->dao->crearHilo(new Hilo($id,$titulo,$texto,$tipo,$fecha,$usuarioId));
            
        } catch (PDOException $e) {

            echo "Error al crear hilo: " . $e->getMessage();
        }
    }
    

    /********************PUT********************/

    public function update($id,$titulo,$texto) {

        if (!$id) {
            throw new Exception("Falta el id de hilo");
        }

        $usuario = $this->dao->obtenerHiloPorId($id);
        if (!$usuario) {
            throw new Exception("Hilo no encontrado");
        }

        return ($this->dao->update($id,$titulo,$texto));
    }

    /********************DELETE********************/

    public function delete($id) {

        if (!$id) {
            throw new Exception("Falta el id de noticia");
        }

        $usuario = $this->dao->obtenerHiloPorId($id);
        if (!$usuario) {
            throw new Exception("Hilo no encontrado");
        }

        return ($this->dao->delete($id));
    }


}
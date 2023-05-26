<?php
require_once(__DIR__.'../../../model/Mensaje.php');
require_once (__DIR__.'/../MensajeService.php');
require_once(__DIR__.'/../../model/DAO/MensajeDAO.php');
require_once("../../php/funciones.php");


class MensajeServiceImpl implements MensajeService {
 
    private $dao;

    public function __construct() {
        $this->dao = new MensajeDAO();
    }

    /********************GET********************/

    public function getById($id) {
        
        if (!$id) {
            throw new Exception("Falta el ID de mensaje");
        }
        $hilo = $this->dao->getById($id);
        
        if (!$hilo) {
            throw new Exception("Mensaje no encontrado");
        }

        return $hilo;
    }

    public function getAllByHilo($id_hilo) {

        $mensajes = $this->dao->getAllByHilo($id_hilo);

        if (count($mensajes) < 1 || $mensajes == null || $mensajes == false) {
            throw new Exception("No hay Mensajes");
        }

        return $mensajes;
    }

    /********************POST********************/

    public function crear($idHilo,$texto,$titulo,$nombreUsuario) {

        if (!$texto || !$titulo) {
            throw new Exception("Faltan datos de Mensaje");
        }

        $servicioUsuario = new UsuarioServiceImpl();
        //descomentarlo cuando vaya a probarlo en cliente ya que funciona con la sesion
        // $usuarioId = $servicioUsuario->obtenerUsuarioPorEmail($_SESSION['correo']);
        $usuarioId = 19;
        $id = $this->dao->ultimoId();
        $fecha = date("Y-m-d H:i:s");
        
        try {
            $usuarioService = new UsuarioService();
            $idUsuario =  $usuarioService->obtenerUsuarioPorNombre($nombreUsuario);
            
            return $this->dao->crear(new Mensaje($id,$idHilo,$texto,$titulo,$fecha,$idUsuario));
        } catch (PDOException $e) {

            echo "Error al crear Mensaje: " . $e->getMessage();
        }
    }
    

    /********************PUT********************/

    public function update($id,$titulo,$texto) {

        if (!$id) {
            throw new Exception("Falta el id de Mensaje");
        }

        $usuario = $this->dao->getByid($id);
        if (!$usuario) {
            throw new Exception("Mensaje no encontrado");
        }

        return ($this->dao->update($id,$titulo,$texto));
    }

    /********************DELETE********************/

    public function delete($id) {

        if (!$id) {
            throw new Exception("Falta el id de noticia");
        }

        $usuario = $this->dao->getById($id);
        if (!$usuario) {
            throw new Exception("Mensaje no encontrado");
        }

        return ($this->dao->delete($id));
    }
}
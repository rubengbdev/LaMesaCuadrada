<?php
require_once(__DIR__.'../../../model/Noticia.php');
require_once (__DIR__.'/../NoticiaService.php');
require_once(__DIR__.'/../../model/DAO/NoticiaDAO.php');
require_once("../../php/funciones.php");


class NoticiaServiceImpl implements NoticiaService {
 
    private $dao;

    public function __construct() {
        $this->dao = new NoticiaDAO();
    }

    /********************GET********************/

    public function obtenerNoticiaPorId($id) {
        
        if (!$id) {
            throw new Exception("Falta el ID de noticia");
        }
        $noticia = $this->dao->obtenerNoticiaPorId($id);
        
        if (!$noticia) {
            throw new Exception("Noticia no encontrada");
        }

        return $noticia;
    }

    public function obtenerNoticias() {

        $noticias = $this->dao->obtenerNoticias();

        if (count($noticias) < 1) {
            throw new Exception("No hay noticias");
        }

        return $noticias;
    }

    /********************POST********************/

    public function crearNoticia($texto,$imagen) {
        
        
        if (!$texto || !$imagen) {
            throw new Exception("Faltan datos de noticia");
        }

        $id = $this->dao->ultimoId();
        $fechaCreacion = date("Y-m-d H:i:s");
    
        try {

            return $this->dao->createNoticia(new Noticia($id,$fechaCreacion,$texto,$imagen));
        } catch (PDOException $e) {

            echo "Error al crear noticia: " . $e->getMessage();
        }
    }

    /********************PUT********************/

    public function actualizarNoticiaPorId($id) {}
        /********************DELETE********************/


    public function eliminarNoticiaPorId($id) {

        if (!$id) {
            throw new Exception("Falta el id de noticia");
        }

        $usuario = $this->dao->obtenerNoticiaPorId($id);
        if (!$usuario) {
            throw new Exception("Usuario no encontrado");
        }

        $this->dao->eliminarNoticiaPorId($id);
    }


}
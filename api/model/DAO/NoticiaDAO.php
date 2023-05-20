<?php

require_once("../model/Noticia.php");

class NoticiaDao {

    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=" . "db" . ";dbname=" . "mesa_cuadrada";
        $this->pdo = new PDO($dsn, "root", "root");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function createNoticia(Noticia $noticia) {

        $stmt = $this->pdo->prepare('INSERT INTO mesa_cuadrada.noticia (noticia_fecha,noticia_texto,noticia_imagen,noticia_titulo) VALUES (?, ?, ?, ?)');
        $stmt->execute([$noticia->getFecha(), $noticia->getTexto(), $noticia->getImagen(), $noticia->getTitulo()]);
        
        return $this->pdo->lastInsertId();
    }

    public function ultimoId() {
        return $this->pdo->lastInsertId() + 1;
    }

    public function obtenerNoticiaPorId($id) {

        $stmt = $this->pdo->prepare('SELECT * FROM noticia WHERE noticia_id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {

            return null;
        }

        return $row;
    }

    public function obtenerNoticias() {

        // $stmt = $this->pdo->prepare('SELECT noticia_fecha, noticia_texto, noticia_imagen, noticia_titulo FROM noticia ORDER BY DATE_FORMAT(noticia_fecha, "%Y-%m-%d") DESC');
        // $stmt = $this->pdo->prepare('SELECT noticia_fecha, noticia_texto, noticia_imagen FROM noticia ORDER BY noticia_fecha DESC');
        $stmt = $this->pdo->prepare('SELECT noticia_fecha, noticia_texto, noticia_imagen, noticia_titulo FROM noticia ORDER BY DATE_FORMAT(noticia_fecha, "%Y-%m-%d %H:%i:%s") DESC');


        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $noticias = [];
            foreach ($stmt as $elemento) {
                $noticia = new Noticia($elemento['noticia_fecha'],$elemento['noticia_texto'],$elemento['noticia_imagen'], $elemento['noticia_titulo']);
                $noticias[] = $noticia->toArray();
            }

            return $noticias;
        } else {
            return false;
        }

    }

    // public function update(Usuario $usuario) {
    //     $stmt = $this->pdo->prepare('UPDATE usuario SET nombre = ?, email = ?, password = ? WHERE id = ?');
    //     $stmt->execute([$usuario->getNombre(), $usuario->getEmail(), $usuario->getPassword(), $usuario->getId()]);
    //     return $stmt->rowCount();
    // }

    public function eliminarNoticiaPorId($id) {
        $stmt = $this->pdo->prepare('DELETE FROM noticia WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
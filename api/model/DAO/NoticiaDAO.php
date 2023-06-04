<?php

require_once("../model/Noticia.php");

/**
 * Clase encargada del crud de las noticias
 */
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
        $stmt = $this->pdo->prepare('SELECT noticia_id, noticia_fecha, noticia_texto, noticia_imagen, noticia_titulo FROM noticia ORDER BY DATE_FORMAT(noticia_fecha, "%Y-%m-%d %H:%i:%s") DESC');


        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $noticias = [];
            foreach ($stmt as $elemento) {
                $noticia = new Noticia($elemento['noticia_id'],$elemento['noticia_fecha'],$elemento['noticia_texto'],$elemento['noticia_imagen'], $elemento['noticia_titulo']);
                $noticias[] = $noticia->toArray();
            }

            return $noticias;
        } else {
            return false;
        }

    }

    public function update($id, $texto, $imagen, $titulo) {

        try {
            $stmt = $this->pdo->prepare('UPDATE mesa_cuadrada.noticia SET noticia_texto = ?, noticia_imagen = ?, noticia_titulo = ? WHERE noticia_id = ?');
            $stmt->execute([$texto, $imagen, $titulo, $id]);
            $rowCount = $stmt->rowCount();
            
            if ($rowCount > 0) {
                $resultado[] = ["actualizado" => true];
                return $resultado;
            } else {
                $resultado[] = ["actualizado" => false];
                return $resultado;
            }
        } catch (PDOException $e) {
            echo 'Error en la actualización: ' . $e->getMessage();
            return null;
        }
    }

    /* ------------------ DELETE ------------------ */

    public function delete($id) {

        try {

            $stmt = $this->pdo->prepare('DELETE FROM noticia WHERE noticia_id = ?');
            $stmt->execute([$id]);
            $rowCount = $stmt->rowCount();

            if ($rowCount > 0) {

                $resultado[] = ["borrado" => true];
                return json_encode($resultado);
            } else {

                $resultado[] = ["borrado" => false];
                return json_encode($resultado);
            }
        } catch (PDOException $e) {
            
            echo 'Error en el borrado: ' . $e->getMessage();
            return null;
        }
    }
}
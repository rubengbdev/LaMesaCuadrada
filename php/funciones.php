<?php
/**
 * función : seguridadFormularios
 * 
 * Devuelve filtrada por seguridad la cadena de texto obtenida de un formulario
 * 
 * @author Rubén Gutiérrez Blanco
 * @version 1.0
 * @param string $palabraFormulario Cadena de texto obtenida del formulario
 * @return string $palabraSegura Cadena de texto del formulario filtrada
 */
function seguridadFormularios ($palabraFormulario) {

    $palabraSegura = strip_tags($palabraFormulario);
    $palabraSegura = trim($palabraSegura);
    $palabraSegura = htmlspecialchars($palabraSegura);

    return ($palabraSegura);
}

?>

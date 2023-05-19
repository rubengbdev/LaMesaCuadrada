<?php
session_start();

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

        session_unset();
        session_destroy();
        echo "OK";
        
        break;
}
?>

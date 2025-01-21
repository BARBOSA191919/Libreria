<?php
require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\editorialController; // Cambiado a editorialController

if(isset($_POST['modulo_editorial'])) {  // Cambiado a modulo_editorial

    $insEditorial = new editorialController();  // Instancia de editorialController

    if($_POST['modulo_editorial'] == "registrar") {  // Acción para registrar editorial
        echo $insEditorial->registrarEditorialControlador();  // Método para registrar
    }

    if($_POST['modulo_editorial'] == "eliminar") {  // Acción para eliminar editorial
        echo $insEditorial->eliminarEditorialControlador();  // Método para eliminar
    }

    if($_POST['modulo_editorial'] == "actualizar") {  // Acción para actualizar editorial
        echo $insEditorial->actualizarEditorialControlador();  // Método para actualizar
    }

    if($_POST['modulo_editorial'] == "listar") {
        // Cambio aquí: usando el nombre correcto del método
        echo $insEditorial->listarEditorialControlador(1, 15, "", "");
    }


} else {
    session_destroy();
    header("Location: ".APP_URL."login/");
}

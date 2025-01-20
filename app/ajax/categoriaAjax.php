<?php
require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\categoriaController;

if(isset($_POST['modulo_categoria'])) {
    $insCategoria = new categoriaController();
    
    if($_POST['modulo_categoria'] == "registrar") {
        echo $insCategoria->registrarCategoriaControlador();
    }
    
    if($_POST['modulo_categoria'] == "eliminar") {
        echo $insCategoria->eliminarCategoriaControlador();
    }
    
    if($_POST['modulo_categoria'] == "actualizar") {
        echo $insCategoria->actualizarCategoriaControlador();
    }
    
    if($_POST['modulo_categoria'] == "listar") {
        echo $insCategoria->listarCategoriaControlador(1, 15, "", "");
    }
} else {
    session_destroy();
    header("Location: ".APP_URL."login/");
}
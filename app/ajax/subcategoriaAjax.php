<?php

require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\subcategoriaController;

if(isset($_POST['modulo_subcategoria'])) {
    $insSubcategoria = new subcategoriaController();
    
    if($_POST['modulo_subcategoria'] == "registrar") {
        echo $insSubcategoria->registrarSubcategoriaControlador();
    }
    
    if($_POST['modulo_subcategoria'] == "eliminar") {
        echo $insSubcategoria->eliminarSubcategoriaControlador();
    }
    
    if($_POST['modulo_subcategoria'] == "actualizar") {
        echo $insSubcategoria->actualizarSubcategoriaControlador();
    }
    
    if($_POST['modulo_subcategoria'] == "listar") {
        echo $insSubcategoria->listarSubcategoriaControlador(1, 15, '', '');
    }
    if ($_POST['modulo_subcategoria'] == "obtenerCategoriasSubcategoria") {
    echo json_encode($insSubcategoria->obtenerCategoriaSControlador());
    }
} else {
    session_destroy();
    header("Location: ".APP_URL."login/");
}

<?php

require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\inventarioController;

if (isset($_POST['modulo_inventario'])) {
    $insInventario = new inventarioController();

    if ($_POST['modulo_inventario'] == "registrar") {
        echo $insInventario->registrarInventarioControlador();
    }
    
    if ($_POST['modulo_inventario'] == "eliminar") {
        echo $insInventario->eliminarInventarioControlador();
    }
    
    if ($_POST['modulo_inventario'] == "actualizar") {
        echo $insInventario->actualizarInventarioControlador();
    }
    
    if ($_POST['modulo_inventario'] == "listar") {
        echo $insInventario->listarInventarioControlador(1, 15, "", "");
    }
  
    if ($_POST['modulo_inventario'] == "obtenerAutores") {
    $insInventario = new inventarioController();
    echo json_encode($insInventario->obtenerAutoresControlador());
    }
     if ($_POST['modulo_inventario'] == "obtenerCategoriasInventario") {
    $insInventario = new inventarioController();
    echo json_encode($insInventario->obtenerCategoriaInventarioControlador());
    }
} else {
    session_destroy();
    header("Location: " . APP_URL . "login/");
}
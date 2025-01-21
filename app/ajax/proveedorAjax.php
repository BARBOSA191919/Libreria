<?php
require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\proveedorController;

if(isset($_POST['modulo_proveedor'])) {
    $insProveedor = new proveedorController();
    
    if($_POST['modulo_proveedor'] == "registrar") {
        echo $insProveedor->registrarProveedorControlador();
    }
    
    if($_POST['modulo_proveedor'] == "eliminar") {
        echo $insProveedor->eliminarProveedorControlador();
    }
    
    if($_POST['modulo_proveedor'] == "actualizar") {
        echo $insProveedor->actualizarProveedorControlador();
    }
    
    if($_POST['modulo_proveedor'] == "listar") {
        echo $insProveedor->listarProveedorControlador(1, 15, "", "");
    }
} else {
    session_destroy();
    header("Location: ".APP_URL."login/");
}
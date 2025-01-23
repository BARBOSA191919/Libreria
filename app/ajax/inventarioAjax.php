<?php
require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\inventarioController;

if (isset($_POST['modulo_inventario'])) {
    $insInventario = new inventarioController();

    switch ($_POST['modulo_inventario']) {
        case "registrar":
            echo $insInventario->registrarInventarioControlador();
            break;

        case "eliminar":
            echo $insInventario->eliminarInventarioControlador();
            break;

        case "actualizar":
            echo $insInventario->actualizarInventarioControlador();
            break;

        case "listar":
            echo $insInventario->listarInventarioControlador(1, 15, "", "");
            break;

            
            case 'obtener_editoriales':
                $controlador = new inventarioController();
                $editoriales = $controlador->obtenerEditorialesControlador();
            
                // Asegúrate de que el encabezado sea JSON
                header('Content-Type: application/json');
                echo json_encode($editoriales);
                break;
            
    }
} else {
    session_destroy();
    header("Location: " . APP_URL . "login/");
}
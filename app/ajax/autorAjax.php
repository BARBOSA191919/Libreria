<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\autorController; // Cambiado a autorController

	if(isset($_POST['modulo_autor'])){  // Cambiado a modulo_autor

		$insAutor = new autorController();  // Instancia de autorController

		if($_POST['modulo_autor']=="registrar"){  // Acción para registrar autor
			echo $insAutor->registrarAutorControlador();  // Método para registrar
		}

		if($_POST['modulo_autor']=="eliminar"){  // Acción para eliminar autor
			echo $insAutor->eliminarAutorControlador();  // Método para eliminar
		}

		if($_POST['modulo_autor']=="actualizar"){  // Acción para actualizar autor
			echo $insAutor->actualizarAutorControlador();  // Método para actualizar
		}
        
    if($_POST['modulo_autor'] == "listar") {
        // Cambio aquí: usando el nombre correcto del método
        echo $insAutor->listarAutorControlador(1, 15, "", "");
    }
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}

<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\categoriaController; // Aquí cambias a categoriaController

	if(isset($_POST['modulo_categoria'])){  // Cambiar a modulo_categoria

		$insCategoria = new categoriaController();  // Instancia de categoriaController

		if($_POST['modulo_categoria']=="registrar"){  // Acción para registrar categoría
			echo $insCategoria->registrarCategoriaControlador();  // Método para registrar
		}

		if($_POST['modulo_categoria']=="eliminar"){  // Acción para eliminar categoría
			echo $insCategoria->eliminarCategoriaControlador();  // Método para eliminar
		}

		if($_POST['modulo_categoria']=="actualizar"){  // Acción para actualizar categoría
			echo $insCategoria->actualizarCategoriaControlador();  // Método para actualizar
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}

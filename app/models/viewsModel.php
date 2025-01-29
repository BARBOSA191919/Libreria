<?php
	
	namespace app\models;

	class viewsModel{

		/*---------- Modelo obtener vista ----------*/
		protected function obtenerVistasModelo($vista){

<<<<<<< HEAD
<<<<<<< Updated upstream
			$listaBlanca=["dashboard","userNew","userList","cliente","autor","inventario","categoria","proveedor","editorial","userUpdate","userSearch","userPhoto","logOut"];
=======
			$listaBlanca=["dashboard","userNew","userList","cliente","autor","inventario","categoria", "subcategoria", "proveedor","vender","editorial","userUpdate","userSearch","userPhoto","logOut"];
>>>>>>> Stashed changes
=======
			$listaBlanca=["dashboard","userNew","userList","cliente","autor","inventario","categoria","proveedor","editorial","userUpdate","userSearch","userPhoto","logOut"];
>>>>>>> parent of 484005b (Se suben cambios de diseño y relaciones)

			if(in_array($vista, $listaBlanca)){
				if(is_file("./app/views/content/".$vista."-view.php")){
					$contenido="./app/views/content/".$vista."-view.php";
				}else{
					$contenido="404";
				}
			}elseif($vista=="login" || $vista=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}

	}
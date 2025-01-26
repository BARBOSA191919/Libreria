<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario | Sistema de Gestión de Librería</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/userUpdate.css">
</head>
<body>
    <header class="header-main">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo APP_URL; ?>dashboard/">
                    <img src="<?php echo APP_URL; ?>app/views/img/allBooksC.jpeg" alt="logo libreria">
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo APP_URL; ?>dashboard/">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Usuarios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo APP_URL; ?>userNew/">Nuevo</a></li>
                                <li><a class="dropdown-item" href="<?php echo APP_URL; ?>userList/">Lista</a></li>
                                <li><a class="dropdown-item" href="<?php echo APP_URL; ?>userSearch/">Buscar</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="<?php echo is_file('./app/views/fotos/'.$_SESSION['foto']) ? APP_URL.'app/views/fotos/'.$_SESSION['foto'] : APP_URL.'app/views/fotos/default.png'; ?>" 
                                     class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                <?php echo $_SESSION['usuario']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo APP_URL.'userUpdate/'.$_SESSION['id'].'/'; ?>">Mi cuenta</a></li>
                                <li><a class="dropdown-item" href="<?php echo APP_URL.'userPhoto/'.$_SESSION['id'].'/'; ?>">Mi foto</a></li>
                                <li><a class="dropdown-item" href="<?php echo APP_URL.'logOut/'; ?>" id="btn_exit">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="registration-container">
        <div class="form-header">
            <center>
                <?php   
                    $id=$insLogin->limpiarCadena($url[1]);  
                    if($id==$_SESSION['id']){  
                ?>
                <h1>Mi cuenta - Actualizacion</h1>
                <?php }else{ ?>
                <h2>Actualizar usuario</h2>
                <?php } ?>
            </center>
        </div>

        <?php 
            $datos=$insLogin->seleccionarDatos("Unico","usuario","usuario_id",$id);  
            if($datos->rowCount()==1){ 
                $datos=$datos->fetch(); 
        ?>

        <div class="user-info text-center mb-4">
            <h2><?php echo $datos['usuario_nombre']." ".$datos['usuario_apellido']; ?></h2>
            <p>
                <strong>Usuario creado:</strong> <?php echo date("d-m-Y h:i:s A", strtotime($datos['usuario_creado'])); ?> 
                &nbsp; 
                <strong>Usuario actualizado:</strong> <?php echo date("d-m-Y h:i:s A", strtotime($datos['usuario_actualizado'])); ?>
            </p>
        </div>

		<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off">
            <input type="hidden" name="modulo_usuario" value="actualizar">
            <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>">

            <div class="row mb-4">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="usuario_nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" 
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" 
                           value="<?php echo $datos['usuario_nombre']; ?>" required>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="usuario_apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="usuario_apellido" name="usuario_apellido" 
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" 
                           value="<?php echo $datos['usuario_apellido']; ?>" required>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="usuario_usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" 
                           pattern="[a-zA-Z0-9]{4,20}" maxlength="20" 
                           value="<?php echo $datos['usuario_usuario']; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="usuario_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="usuario_email" name="usuario_email" 
                           maxlength="70" value="<?php echo $datos['usuario_email']; ?>">
                </div>
            </div>

            <div class="alert alert-info text-center mb-2">
			"Para actualizar la clave, complete ambos campos. Déjelos vacíos si no desea cambiarla."
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="usuario_clave_1" class="form-label">Nueva clave</label>
                    <input type="password" class="form-control" id="usuario_clave_1" name="usuario_clave_1" 
                           pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
                <div class="col-md-6">
                    <label for="usuario_clave_2" class="form-label">Repetir nueva clave</label>
                    <input type="password" class="form-control" id="usuario_clave_2" name="usuario_clave_2" 
                           pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>

            <div class="alert alert-warning text-center mb-2">
			"Para actualizar los datos, ingrese su USUARIO y CLAVE de inicio de sesión."
			</div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="administrador_usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="administrador_usuario" name="administrador_usuario" 
                           pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                </div>
                <div class="col-md-6">
                    <label for="administrador_clave" class="form-label">Clave</label>
                    <input type="password" class="form-control" id="administrador_clave" name="administrador_clave" 
                           pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>

            <div class="text-center" >
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>

        <?php 
            }else{ 
                include "./app/views/inc/error_alert.php"; 
            } 
        ?>
    </div>

    <!-- Bootstrap and SweetAlert scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        
function cargarFavicon(url) {
    const link = document.createElement('link');
    link.rel = 'icon';
    link.type = 'image/png';
    link.href = url;
    document.head.appendChild(link);
}
cargarFavicon('http://localhost/Libreria/app/views/img/allbooks.jpg');
    </script></body>
</html>
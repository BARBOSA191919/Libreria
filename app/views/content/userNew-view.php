<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios | Sistema de Gestión de Librería</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/userNew.css">

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
            <h1>Registro de Usuarios</h1>
            <h2>Sistema Integral de Gestión de Librería</h2>
        </div>

		<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" >
		<input type="hidden" name="modulo_usuario" value="registrar">

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="usuario_nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" 
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required
                           placeholder="Ingrese sus nombres completos">
                </div>
                <div class="col-md-6">
                    <label for="usuario_apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="usuario_apellido" name="usuario_apellido" 
                           pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required
                           placeholder="Ingrese sus apellidos completos">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="usuario_usuario" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" 
                           pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required
                           placeholder="Elija un nombre de usuario único">
                </div>
                <div class="col-md-6">
                    <label for="usuario_email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="usuario_email" name="usuario_email" 
                           maxlength="70" placeholder="ejemplo@dominio.com">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="usuario_clave_1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="usuario_clave_1" name="usuario_clave_1" 
                           pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required
                           placeholder="Mínimo 7 caracteres">
                </div>
                <div class="col-md-6">
                    <label for="usuario_clave_2" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="usuario_clave_2" name="usuario_clave_2" 
                           pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required
                           placeholder="Repita su contraseña">
                </div>
            </div>
            <!-- Rest of the form remains the same as previous version -->
            <div class="mb-4">
                <label for="usuario_foto" class="form-label">Foto de Perfil</label>
                <div class="file-input-container">
                    <div class="file-input-trigger">
                        <span class="file-input-text">Seleccionar Archivo</span>
                        <input class="form-control" type="file" id="usuario_foto" name="usuario_foto" 
                               accept=".jpg, .png, .jpeg">
                    </div>
                </div>
                <small class="text-muted">Formatos: JPG, JPEG, PNG (Máximo 5MB)</small>
            </div>

            <!-- Rest of the form and scripts remain the same -->
            <div class="text-center">
                <button type="reset" class="btn btn-outline-secondary me-3">Limpiar Formulario</button>
                <button type="submit" class="btn btn-primary">Registrar Usuario</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap and SweetAlert scripts remain the same -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?php echo APP_URL; ?>app/views/js/userNew.js"></script>
	<script>
        function cargarFavicon(url) {
    const link = document.createElement('link');
    link.rel = 'icon';
    link.type = 'image/png';
    link.href = url;
    document.head.appendChild(link);
}
// Llama a la función con la ruta del favicon
cargarFavicon('http://localhost/Libreria/app/views/img/allbooks.jpg');
    </script>

</body>
</html>
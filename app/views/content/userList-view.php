<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios | Sistema de Gestión de Librería</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/userList.css">
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

    <div class="container pb-6 pt-6">
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar usuarios...">
        </div>

        <div class="form-rest mb-6 mt-6"></div>
        <?php 
        use app\controllers\userController;
        $insUsuario = new userController();
        echo $insUsuario->listarUsuarioControlador($url[1], 15, $url[0], ""); 
        ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo APP_URL; ?>app/views/js/userList.js"></script>
</body>
</html>
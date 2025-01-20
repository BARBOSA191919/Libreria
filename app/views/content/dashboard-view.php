<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            padding: 20px 10px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            width: 250px;
        }
        
        .content-area {
            margin-left: 250px;
        }
        
        .menu-item {
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .menu-item:hover {
            background-color: #e9ecef;
        }
        
        .menu-item .bi {
            margin-right: 10px;
        }
        
        .profile-img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .content-section {
            display: none;
            padding: 20px;
        }
        
        .content-section.active {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }
            .menu-text {
                display: none;
            }
            .content-area {
                margin-left: 60px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="d-flex flex-column">
        <div class="menu-item" onclick="showContent('inicio')">
            <i class="bi bi-house-door"></i>
            <span class="menu-text">Inicio</span>
        </div>
        
        <div class="menu-item" onclick="showContent('ventas')">
            <i class="bi bi-cart-check"></i>
            <span class="menu-text">Ventas</span>
        </div>
        
        <div class="menu-item" onclick="showContent('categoria-view')">
            <i class="bi bi-grid"></i>
            <span class="menu-text">Categoria</span>
        </div>
        
        <div class="menu-item" onclick="showContent('reportes')">
            <i class="bi bi-file-earmark-bar-graph"></i>
            <span class="menu-text">Reportes</span>
        </div>
        
        <div class="menu-item" onclick="showContent('inventario-view')">
            <i class="bi bi-boxes"></i>
            <span class="menu-text">Inventario</span>
        </div>
        
        <div class="menu-item" onclick="showContent('cliente')">
            <i class="bi bi-person-lines-fill"></i>
            <span class="menu-text">Clientes</span>
        </div>
        
        <div class="menu-item" onclick="showContent('proveedores')">
            <i class="bi bi-truck"></i>
            <span class="menu-text">Proveedores</span>
        </div>
        
        <div class="menu-item" onclick="showContent('configuracion')">
            <i class="bi bi-gear-fill"></i>
            <span class="menu-text">Configuración</span>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="content-area">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo APP_URL; ?>dashboard/">
                <img src="<?php echo APP_URL; ?>app/views/img/allBooksC.jpeg" alt="logo libreria" width="160" height="80">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo APP_URL; ?>dashboard/">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Usuarios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo APP_URL; ?>userNew/">Nuevo</a></li>
                            <li><a class="dropdown-item" href="<?php echo APP_URL; ?>cliente/">Nuevo cliente</a></li>
                            <li><a class="dropdown-item" href="<?php echo APP_URL; ?>categoria/">Nueva categoria</a></li>
                            <li><a class="dropdown-item" href="<?php echo APP_URL; ?>userList/">Lista</a></li>
                            <li><a class="dropdown-item" href="<?php echo APP_URL; ?>userSearch/">Buscar</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <?php
                            if(is_file("./app/views/fotos/".$_SESSION['foto'])){
                                echo '<img class="profile-img me-2" src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'" alt="Profile">';
                            }else{
                                echo '<img class="profile-img me-2" src="'.APP_URL.'app/views/fotos/default.png" alt="Profile">';
                            }
                            ?>
                            <?php echo $_SESSION['usuario']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo APP_URL."userUpdate/".$_SESSION['id']."/"; ?>">Mi cuenta</a></li>
                            <li><a class="dropdown-item" href="<?php echo APP_URL."userPhoto/".$_SESSION['id']."/"; ?>">Mi foto</a></li>
                            <li><a class="dropdown-item" href="<?php echo APP_URL."logOut/"; ?>" id="btn_exit">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Sections -->
    <div id="inicio" class="content-section">
        <div class="container-fluid">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-house-door fs-3 me-2"></i>
                <h2 class="mb-0">Página de Inicio</h2>
            </div>
            <p>Bienvenido a la página principal. Aquí podrás ver un resumen de toda tu información.</p>
        </div>
    </div>

    <div id="categoria-view" class="content-section">
        <?php include "./app/views/content/categoria-view.php"; ?>
    </div>

    <div id="cliente" class="content-section">
        <?php include "./app/views/content/cliente-view.php"; ?>
    </div>

    <div id="inventario-view" class="content-section">
        <!-- Contenido del inventario -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showContent(sectionId) {
    // Hide all content sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.style.display = 'none';
    });
    
    // Show the selected section
    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}

// Show inicio section by default
document.addEventListener('DOMContentLoaded', () => {
    showContent('inicio');
});
</script>

</body>
</html>
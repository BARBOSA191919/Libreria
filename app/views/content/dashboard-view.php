<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/dashboard.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" href="/frontend/public/assets/logo/icon-library.ico">
</head>

<body>
  <div class="sidebar" id="sidebar">

    <div class="icon-side">

    </div>

    <div class="menu-item" onclick="showContent('inicio')">
      <span class="emoji">
        <i class="bi bi-house-door"></i>
      </span>
      <span class="menu-text">Inicio</span>
    </div>

    <div class="menu-item" onclick="showContent('inicio')">
      <span class="emoji">
        <i class="bi bi-cart-check"></i>
      </span>
      <span class="menu-text">Ventas</span>
    </div>

    <div class="menu-item" onclick="showContent('categoria-view')">
      <span class="emoji">
        <i class="bi bi-grid"></i>
      </span>
      <span class="menu-text">Categoria</span>
    </div>

    <div class="menu-item" onclick="showContent('mensajes')">
      <span class="emoji">
        <i class="bi bi-file-earmark-bar-graph"></i>
      </span>
      <span class="menu-text">Reportes</span>
    </div>

    <div class="menu-item" onclick="showContent('inventario')">
      <span class="emoji">
        <i class="bi bi-boxes"></i>
      </span>
      <span class="menu-text">Inventario</span>
    </div>

    <div class="menu-item" onclick="showContent('cliente')">
      <span class="emoji">
        <i class="bi bi-person-lines-fill"></i>
      </span>
      <span class="menu-text">Clientes</span>
    </div>

    <div class="menu-item" onclick="showContent('proveedor')">
      <span class="emoji">
        <i class="bi bi-truck"></i>
      </span>
      <span class="menu-text">Proveedores</span>
    </div>

    <div class="menu-item" onclick="showContent('autor')">
      <span class="emoji">
        <i class="bi bi-truck"></i>
      </span>
      <span class="menu-text">Autor</span>
    </div>

    
    <div class="menu-item" onclick="showContent('editorial')">
      <span class="emoji">
        <i class="bi bi-truck"></i>
      </span>
      <span class="menu-text">Editorial</span>
    </div>


    <div class="menu-item" onclick="showContent('configuracion')">
      <span class="emoji">
        <i class="bi bi-gear-fill"></i>
      </span>
      <span class="menu-text">Configuración</span>
    </div>


  </div>

  <div class="content-area" id="contentArea">

    <header class="header-main">
      <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid contenedor-principal">

          <!-- Logo o título -->
          <div class="navbar-brand">
            <a class="img-logo" href="<?php echo APP_URL; ?>dashboard/">
                <img src="<?php echo APP_URL; ?>app/views/img/allBooksC.jpeg" alt="logo libreria" width="160" height="80">
            </a>
              <div class="navbar-burger" data-target="navbarExampleTransparentExample">
                  <span></span>
                  <span></span>
                  <span></span>
              </div>
          </div>

           <div class="navbar-start">
            <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard/">
                Dashboard
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="#">
                    Usuarios
                </a>
                <div class="navbar-dropdown is-boxed">

                    <a class="navbar-item" href="<?php echo APP_URL; ?>userNew/">
                        Nuevo
                    </a>
          
                    <a class="navbar-item" href="<?php echo APP_URL; ?>userList/">
                        Lista
                    </a>
                    <a class="navbar-item" href="<?php echo APP_URL; ?>userSearch/">
                        Buscar
                    </a>
                </div>
            </div>
        </div>

          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="icon-user">
               <figure class="image ">
                    <?php
                      if(is_file("./app/views/fotos/".$_SESSION['foto'])){
                        echo '<img class="is-rounded" src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'">';
                      }else{
                        echo '<img class="is-rounded" src="'.APP_URL.'app/views/fotos/default.png">';
                      }
                    ?>
		          </figure>
              </span>
              <?php echo $_SESSION['usuario']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end"> <!-- Añadir dropdown-menu-end -->
              <li><a class="dropdown-item" href="<?php echo APP_URL."userUpdate/".$_SESSION['id']."/"; ?>">Mi cuenta</a></li>
              <li><a class="dropdown-item" href="<?php echo APP_URL."userPhoto/".$_SESSION['id']."/"; ?>">Mi foto</a></li>
              <li><a class="dropdown-item" href="<?php echo APP_URL."logOut/"; ?>" id="btn_exit">Salir</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>



    <div id="inicio" class="content-section">

      <span class="icon-main__content">
        <i class="bi bi-house-door"></i>
        <h2>Página de Inicio</h2>
      </span>

      <p>Bienvenido a la página principal. Aquí podrás ver un resumen de toda tu información.</p>
    </div>

   

    <div id="categoria-view" class="content-section">
        <?php include "./app/views/content/categoria-view.php"; ?>
    </div>

    <div id="proveedor" class="content-section">
        <?php include "./app/views/content/proveedor-view.php"; ?>
    </div>

    <div id="cliente" class="content-section">
        <?php include "./app/views/content/cliente-view.php"; ?>
    </div>

    
    <div id="autor" class="content-section">
        <?php include "./app/views/content/autor-view.php"; ?>
    </div>

        
    <div id="editorial" class="content-section">
        <?php include "./app/views/content/editorial-view.php"; ?>
    </div>

    <div id="inventario" class="content-section">
        <?php include "./app/views/content/inventario-view.php"; ?>
    </div>


    <div id="inventario-view" class="content-section">
        <!-- Contenido del inventario -->
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="<?php echo APP_URL; ?>app/views/js/main.js"></script>
 
</body>

</html>
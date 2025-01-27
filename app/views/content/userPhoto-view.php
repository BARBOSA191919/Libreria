<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Foto de Perfil | Sistema de Gestión de Librería</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/userPhoto.css">
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
                <h1>Mi foto de perfil</h1>
                <h2>Actualizar foto de perfil</h2>
                <?php }else{ ?>
                <h1>Usuarios</h1>
                <h2>Actualizar foto de perfil</h2>
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

        <div class="row">
            <div class="col-md-5 text-center">
                <?php if(is_file("./app/views/fotos/".$datos['usuario_foto'])){ ?>
                    <div class="mb-4">
                        <img src="<?php echo APP_URL; ?>app/views/fotos/<?php echo $datos['usuario_foto']; ?>" 
                             class="img-fluid rounded-circle mb-3" style="max-width: 250px; max-height: 250px; object-fit: cover;">
                        
                        <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off">
                            <input type="hidden" name="modulo_usuario" value="eliminarFoto">
                            <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>">
                            <button type="submit" class="btn btn-danger rounded-pill">Eliminar foto</button>
                        </form>
                    </div>
                <?php }else{ ?>
                    <div class="mb-4">
                        <img src="<?php echo APP_URL; ?>app/views/fotos/default.png" 
                             class="img-fluid rounded-circle mb-3" style="max-width: 250px; max-height: 250px; object-fit: cover;">
                    </div>
                <?php }?>
            </div>

            <div class="col-md-7">
                <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" 
                      enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="modulo_usuario" value="actualizarFoto">
                    <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>">
                    
                    <label class="form-label">Foto o imagen del usuario</label>
                    
                    <div class="file-input-container mb-4">
                        <input class="form-control" type="file" name="usuario_foto" 
                               accept=".jpg, .png, .jpeg" id="usuario_foto">
                        <small class="text-muted">Formatos: JPG, JPEG, PNG (Máximo 5MB)</small>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary rounded-pill">Actualizar foto</button>
                    </div>
                </form>
            </div>
        </div>

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
    </script>
</body>
</html>
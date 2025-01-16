<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllBooks Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/sesion.css">
</head>

<body>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="col-11 col-sm-8 col-md-6 col-lg-4">
            <div class="text-center mb-4">
            <img src="/Libreria/app/views/img/allBooksC.jpeg" alt="Logo">
            </div>
            
            <div class="login-card">
                <div class="card-header py-3">
                    <h3 class="text-center m-0">INICIO DE SESIÓN</h3>
                </div>

                <div class="card-body p-4">
                    <form class="login" action="" method="POST" autocomplete="off">
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold mb-2">Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input 
                                    type="text" 
                                    name="login_usuario" 
                                    class="form-control border-start-0 ps-0" 
                                    placeholder="Ingrese su usuario"
                                    pattern="[a-zA-Z0-9]{4,20}" 
                                    maxlength="20" 
                                    required
                                >
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label fw-bold mb-2">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input 
                                    type="password" 
                                    name="login_clave" 
                                    class="form-control border-start-0 ps-0" 
                                    placeholder="Ingrese su contraseña"
                                    pattern="[a-zA-Z0-9$@.-]{7,100}" 
                                    maxlength="100" 
                                    required
                                >
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                INICIAR SESIÓN
                            </button>
                        </div>
                    </form>

                    <?php if(isset($_SESSION['login_error'])): ?>
                        <div class="alert alert-danger mt-3 text-center">
                            <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-center mt-3 text-black">
                <small>&copy; <?php echo date('Y'); ?> Sistema  All Books. Todos los derechos reservados.</small>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
            $insLogin->iniciarSesionControlador();
        }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
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
    </div>
</body>
</html>
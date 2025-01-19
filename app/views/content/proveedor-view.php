<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de Proveedores</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container is-fluid mb-6">
        <h1 class="title">Proveedores</h1>
        <h2 class="subtitle">Gestión de Proveedores</h2>
    </div>

    <div class="container pb-6 pt-6">
        <button class="button is-primary mb-4" onclick="abrirModalRegistro()">
            Registrar Nuevo Proveedor
        </button>

        <!-- Listado de Proveedores -->
        <div id="lista-proveedores" class="mt-4">
            <!-- Aquí se cargará la lista de proveedores -->
        </div>

        <!-- Modal de Registro -->
        <div id="modal-registro" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Registrar Proveedor</p>
                    <button class="delete" aria-label="close" onclick="cerrarModalRegistro()"></button>
                </header>
                <section class="modal-card-body">
                    <form id="form-registro" method="POST">
                        <input type="hidden" name="modulo_proveedor" value="registrar">

                        <div class="field">
                            <label class="label">Código</label>
                            <div class="control">
                                <input class="input" type="text" name="proveedor_codigo" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Nombre de la Empresa</label>
                            <div class="control">
                                <input class="input" type="text" name="proveedor_nombreEmpresa" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Contacto</label>
                            <div class="control">
                                <input class="input" type="text" name="proveedor_contacto">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Dirección</label>
                            <div class="control">
                                <textarea class="textarea" name="proveedor_direccion"></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Teléfono</label>
                            <div class="control">
                                <input class="input" type="text" name="proveedor_telefono">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" name="proveedor_email">
                            </div>
                        </div>

                        <div class="field">
                            <button type="submit" class="button is-success">Registrar Proveedor</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!-- Modal de Actualización -->
        <div id="modal-editar" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Actualizar Proveedor</p>
                    <button class="delete" aria-label="close" onclick="cerrarModalEditar()"></button>
                </header>
                <section class="modal-card-body">
                    <form id="form-edicion" method="POST">
                        <input type="hidden" name="modulo_proveedor" value="actualizar">
                        <input type="hidden" id="proveedor_id" name="proveedor_id">

                        <div class="field">
                            <label class="label">Código</label>
                            <div class="control">
                                <input id="edit_proveedor_codigo" class="input" type="text" name="proveedor_codigo" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Nombre de la Empresa</label>
                            <div class="control">
                                <input id="edit_proveedor_nombreEmpresa" class="input" type="text" name="proveedor_nombreEmpresa" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Contacto</label>
                            <div class="control">
                                <input id="edit_proveedor_contacto" class="input" type="text" name="proveedor_contacto">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Dirección</label>
                            <div class="control">
                                <textarea id="edit_proveedor_direccion" class="textarea" name="proveedor_direccion"></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Teléfono</label>
                            <div class="control">
                                <input id="edit_proveedor_telefono" class="input" type="text" name="proveedor_telefono">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input id="edit_proveedor_email" class="input" type="email" name="proveedor_email">
                            </div>
                        </div>

                        <div class="field">
                            <button type="submit" class="button is-success">Actualizar Proveedor</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script>
        // Funciones para los modales
        function abrirModalRegistro() {
            document.getElementById('modal-registro').classList.add('is-active');
        }

        function cerrarModalRegistro() {
            document.getElementById('modal-registro').classList.remove('is-active');
            document.getElementById('form-registro').reset();
        }

        function abrirModalEditar(proveedor) {
            document.getElementById('proveedor_id').value = proveedor.id_proveedor;
            document.getElementById('edit_proveedor_codigo').value = proveedor.codigo;
            document.getElementById('edit_proveedor_nombreEmpresa').value = proveedor.nombreEmpresa;
            document.getElementById('edit_proveedor_contacto').value = proveedor.contacto;
            document.getElementById('edit_proveedor_direccion').value = proveedor.direccion;
            document.getElementById('edit_proveedor_telefono').value = proveedor.telefono;
            document.getElementById('edit_proveedor_email').value = proveedor.email;
            document.getElementById('modal-editar').classList.add('is-active');
        }

        function cerrarModalEditar() {
            document.getElementById('modal-editar').classList.remove('is-active');
            document.getElementById('form-edicion').reset();
        }

        // Función para cargar la lista de proveedores
        function cargarProveedores() {
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
                type: 'POST',
                data: {
                    modulo_proveedor: 'listar'
                },
                success: function(response) {
                    $('#lista-proveedores').html(response);
                }
            });
        }

        // Manejador para el formulario de registro
        $('#form-registro').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'limpiar') {
                        cerrarModalRegistro();
                        cargarProveedores();
                    }
                }
            });
        });

        // Manejador para el formulario de edición
        $('#form-edicion').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'recargar') {
                        cerrarModalEditar();
                        cargarProveedores();
                    }
                }
            });
        });

        // Función para eliminar proveedor
        function eliminarProveedor(id) {
            if(confirm('¿Está seguro de eliminar este proveedor?')) {
                $.ajax({
                    url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
                    type: 'POST',
                    data: {
                        modulo_proveedor: 'eliminar',
                        proveedor_id: id
                    },
                    success: function(response) {
                        const resp = JSON.parse(response);
                        alert(resp.texto);
                        if(resp.tipo === 'recargar') {
                            cargarProveedores();
                        }
                    }
                });
            }
        }

        // Cargar proveedores al iniciar la página
        $(document).ready(function() {
            cargarProveedores();
        });
    </script>
</body>
</html>
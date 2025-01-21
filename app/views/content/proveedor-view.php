

    <div class="container is-fluid mb-6">
        <h1 class="title">Proveedores</h1>
        <h2 class="subtitle">Gestión de Proveedores</h2>
    </div>

    <div class="container pb-6 pt-6">
        <button class="button is-primary mb-4" onclick="abrirModalRegistroproveedor()">
            Registrar Nuevo Proveedor
        </button>

        <!-- Listado de Proveedores -->
        <div id="lista-proveedores" class="mt-4">
            <!-- Aquí se cargará la lista de proveedores -->
        </div>

        <!-- Modal de Registro -->
        <div id="modal-registro-proveedor" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Registrar Proveedor</p>
                    <button class="delete" aria-label="close" onclick="cerrarModalRegistroproveedor()"></button>
                </header>
                <section class="modal-card-body">
                    <form id="form-registro-proveedor" method="POST">
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
        <div id="modal-editar-proveedor" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Actualizar Proveedor</p>
                    <button class="delete" aria-label="close" onclick="cerrarModalEditarproveedor()"></button>
                </header>
                <section class="modal-card-body">
                    <form id="form-edicion-proveedor" method="POST">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // Funciones para los modales
        function abrirModalRegistroproveedor() {
            document.getElementById('modal-registro-proveedor').classList.add('is-active');
        }

        function cerrarModalRegistroproveedor() {
            document.getElementById('modal-registro-proveedor').classList.remove('is-active');
            document.getElementById('form-registro-proveedor').reset();
        }

        function abrirModalEditarproveedor(proveedor) {
            document.getElementById('proveedor_id').value = proveedor.id_proveedor;
            document.getElementById('edit_proveedor_codigo').value = proveedor.codigo;
            document.getElementById('edit_proveedor_nombreEmpresa').value = proveedor.nombreEmpresa;
            document.getElementById('edit_proveedor_contacto').value = proveedor.contacto;
            document.getElementById('edit_proveedor_direccion').value = proveedor.direccion;
            document.getElementById('edit_proveedor_telefono').value = proveedor.telefono;
            document.getElementById('edit_proveedor_email').value = proveedor.email;
            document.getElementById('modal-editar').classList.add('is-active');
        }

        function cerrarModalEditarproveedor() {
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
        $('#form-registro-proveedor').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'limpiar') {
                        cerrarModalRegistroproveedor();
                        cargarProveedores();
                    }
                }
            });
        });

        // Manejador para el formulario de edición
        $('#form-edicion-proveedor').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'recargar') {
                        cerrarModalEditarproveedor();
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
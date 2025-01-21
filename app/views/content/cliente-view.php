
<div class="container is-fluid mb-6">
        <h1 class="title">Clientes</h1>
        <h2 class="subtitle">Gestión de Clientes</h2>
    </div>

    <div class="container pb-6 pt-6">
        <button class="button is-primary mb-4" onclick="abrirModalRegistrocliente()">
            Registrar Nuevo Cliente
        </button>

        <!-- Listado de Clientes -->
        <div id="lista-clientes" class="mt-4">
            <!-- Aquí se cargará la lista de clientes -->
        </div>

        <!-- Modal de Registro -->
        <div id="modal-registro-cliente" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Registrar Cliente</p>
                    <button class="delete" aria-label="close" onclick="cerrarModalRegistrocliente()"></button>
                </header>
                <section class="modal-card-body">
                    <form id="form-registro-cliente" method="POST">
                        <input type="hidden" name="modulo_cliente" value="registrar">

                        <div class="field">
                            <label class="label">Nombre</label>
                            <div class="control">
                                <input class="input" type="text" name="cliente_nombre" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Tipo de Documento</label>
                            <div class="control">
                                <div class="select">
                                    <select name="cliente_tipo_documento" required>
                                    <option value="">Seleccione la opcion</option>
                                        <option value="Cedula Ciudadania">Cedula Ciudadania</option>
                                        <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                        <option value="Cedula extranjera">Cedula extranjera</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Número de Documento</label>
                            <div class="control">
                                <input class="input" type="text" name="cliente_numero_documento" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Teléfono</label>
                            <div class="control">
                                <input class="input" type="text" name="cliente_telefono" required>
                            </div>
                        </div>

                        <div class="field">
                            <button type="submit" class="button is-success">Registrar Cliente</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!-- Modal de Actualización -->
        <div id="modal-editar-cliente" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Actualizar Cliente</p>
                    <button class="delete" aria-label="close" onclick="cerrarModalEditarcliente()"></button>
                </header>
                <section class="modal-card-body">
                    <form id="form-edicion-cliente" method="POST">
                        <input type="hidden" name="modulo_cliente" value="actualizar">
                        <input type="hidden" id="cliente_id" name="cliente_id">

                        <div class="field">
                            <label class="label">Nombre</label>
                            <div class="control">
                                <input id="edit_cliente_nombre" class="input" type="text" name="cliente_nombre" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Tipo de Documento</label>
                            <div class="control">
                                <div class="select">
                                    <select id="edit_cliente_tipo_documento" name="cliente_tipo_documento" required>
                                    <option value="">Seleccione la opcion</option>
                                        <option value="Cedula Ciudadania">Cedula Ciudadania</option>
                                        <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                        <option value="Cedula extranjera">Cedula extranjera</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Número de Documento</label>
                            <div class="control">
                                <input id="edit_cliente_numero_documento" class="input" type="text" name="cliente_numero_documento" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Teléfono</label>
                            <div class="control">
                                <input id="edit_cliente_telefono" class="input" type="text" name="cliente_telefono" required>
                            </div>
                        </div>

                        <div class="field">
                            <button type="submit" class="button is-success">Actualizar Cliente</button>
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
        function abrirModalRegistrocliente() {
            document.getElementById('modal-registro-cliente').classList.add('is-active');
        }

        function cerrarModalRegistrocliente() {
            document.getElementById('modal-registro-cliente').classList.remove('is-active');
            document.getElementById('form-registro-cliente').reset();
        }

        function abrirModalEditarcliente(cliente) {
            document.getElementById('cliente_id').value = cliente.id_cliente;
            document.getElementById('edit_cliente_nombre').value = cliente.nombre;
            document.getElementById('edit_cliente_tipo_documento').value = cliente.tipo_documento;
            document.getElementById('edit_cliente_numero_documento').value = cliente.numero_documento;
            document.getElementById('edit_cliente_telefono').value = cliente.telefono;
            document.getElementById('modal-editar-cliente').classList.add('is-active');
        }

        function cerrarModalEditarcliente() {
            document.getElementById('modal-editar-cliente').classList.remove('is-active');
            document.getElementById('form-edicion-cliente').reset();
        }

        // Función para cargar la lista de clientes
        function cargarClientes() {
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
                type: 'POST',
                data: {
                    modulo_cliente: 'listar'
                },
                success: function(response) {
                    $('#lista-clientes').html(response);
                }
            });
        }

        // Manejador para el formulario de registro
        $('#form-registro-cliente').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'limpiar') {
                        cerrarModalRegistrocliente();
                        cargarClientes();
                    }
                }
            });
        });

        // Manejador para el formulario de edición
        $('#form-edicion-cliente').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'recargar') {
                        cerrarModalEditarcliente();
                        cargarClientes();
                    }
                }
            });
        });

        // Función para eliminar cliente
        function eliminarCliente(id) {
            if(confirm('¿Está seguro de eliminar este cliente?')) {
                $.ajax({
                    url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
                    type: 'POST',
                    data: {
                        modulo_cliente: 'eliminar',
                        cliente_id: id
                    },
                    success: function(response) {
                        const resp = JSON.parse(response);
                        alert(resp.texto);
                        if(resp.tipo === 'recargar') {
                            cargarClientes();
                        }
                    }
                });
            }
        }

        // Cargar clientes al iniciar la página
        $(document).ready(function() {
            cargarClientes();
        });
    </script>
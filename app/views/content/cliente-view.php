 <div class="container py-4">
        <h1>Clientes</h1>
        <h4 class="text-muted mb-4">Gestión de Clientes</h4>

        <button class="btn btn-primary mb-4" onclick="abrirModalRegistro()">
            Registrar Nuevo Cliente
        </button>

        <!-- Listado de Clientes -->
        <div id="lista-clientes" class="mt-4">
            <!-- Aquí se cargará la lista de clientes -->
        </div>

        <!-- Modal de Registro -->
        <div class="modal fade" id="modal-registro" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Cliente</h5>
                        <button type="button" class="btn-close" onclick="cerrarModalRegistro()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-registro" method="POST">
                            <input type="hidden" name="modulo_cliente" value="registrar">

                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input class="form-control" type="text" name="cliente_nombre" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo de Documento</label>
                                <select class="form-select" name="cliente_tipo_documento" required>
                                    <option value="DNI">DNI</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Número de Documento</label>
                                <input class="form-control" type="text" name="cliente_numero_documento" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input class="form-control" type="text" name="cliente_telefono" required>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Registrar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Actualización -->
        <div class="modal fade" id="modal-editar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Cliente</h5>
                        <button type="button" class="btn-close" onclick="cerrarModalEditar()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edicion" method="POST">
                            <input type="hidden" name="modulo_cliente" value="actualizar">
                            <input type="hidden" id="cliente_id" name="cliente_id">

                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input id="edit_cliente_nombre" class="form-control" type="text" name="cliente_nombre" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo de Documento</label>
                                <select id="edit_cliente_tipo_documento" class="form-select" name="cliente_tipo_documento" required>
                                    <option value="DNI">DNI</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Número de Documento</label>
                                <input id="edit_cliente_numero_documento" class="form-control" type="text" name="cliente_numero_documento" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input id="edit_cliente_telefono" class="form-control" type="text" name="cliente_telefono" required>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Actualizar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Funciones para los modales
        const modalRegistro = new bootstrap.Modal(document.getElementById('modal-registro'));
        const modalEditar = new bootstrap.Modal(document.getElementById('modal-editar'));

        function abrirModalRegistro() {
            modalRegistro.show();
        }

        function cerrarModalRegistro() {
            modalRegistro.hide();
            document.getElementById('form-registro').reset();
        }

        function abrirModalEditar(cliente) {
            document.getElementById('cliente_id').value = cliente.id_cliente;
            document.getElementById('edit_cliente_nombre').value = cliente.nombre;
            document.getElementById('edit_cliente_tipo_documento').value = cliente.tipo_documento;
            document.getElementById('edit_cliente_numero_documento').value = cliente.numero_documento;
            document.getElementById('edit_cliente_telefono').value = cliente.telefono;
            modalEditar.show();
        }

        function cerrarModalEditar() {
            modalEditar.hide();
            document.getElementById('form-edicion').reset();
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
        $('#form-registro').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'limpiar') {
                        cerrarModalRegistro();
                        cargarClientes();
                    }
                }
            });
        });

        // Manejador para el formulario de edición
        $('#form-edicion').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'recargar') {
                        cerrarModalEditar();
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
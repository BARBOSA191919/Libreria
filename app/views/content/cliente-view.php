<div class="container">

<div class="position-contenido">

  <div class="position-buttom">
    <button class="btn-registrar btn btn-primary " onclick="abrirModalRegistrocliente()">
      <i class="bi bi-plus-square"></i>
       Nuevo Cliente
    </button>
  </div>

  <div class="content-name">
    <div class="container mt-4 mb-4">
        <h1 class="text-titulo">Clientes</h1>
        <h2 class="h4 text-muted">Gestión de Clientes</h2>
    </div>
 </div>

    </div>

    <!-- Listado de Clientes -->
    <div id="lista-clientes" class="mt-4">
        <!-- Aquí se cargará la lista de clientes -->
    </div>

    <!-- Modal de Registro -->
    <div class="modal fade" id="modal-registro-cliente" tabindex="-1">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-form-label fw-semibold text-model_title">Registrar Cliente</h5>
                    <button type="button" class="btn-close" onclick="cerrarModalRegistrocliente()"></button>
                </div>
                <div class="modal-body">
                    <form id="form-registro-cliente" method="POST">
                        <input type="hidden" name="modulo_cliente" value="registrar">

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Nombre *</label>
                            <input class="form-control text-model_input" type="text" name="cliente_nombre" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Tipo de Documento *</label>
                            <select class="form-select  text-model" name="cliente_tipo_documento" required>
                                <option value="">Seleccione la opcion</option>
                                <option value="Cedula Ciudadania">Cedula Ciudadania</option>
                                <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                <option value="Cedula extranjera">Cedula extranjera</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Número de Documento *</label>
                            <input class="form-control text-model_input" type="text" name="cliente_numero_documento" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Teléfono *</label>
                            <input class="form-control text-model_input" type="text" name="cliente_telefono" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success text-model">Registrar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Actualización -->
    <div class="modal fade" id="modal-editar-cliente" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-model_title">Actualizar Cliente</h5>
                    <button type="button" class="btn-close" onclick="cerrarModalEditarcliente()"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edicion-cliente" method="POST">
                        <input type="hidden" name="modulo_cliente" value="actualizar">
                        <input type="hidden" id="cliente_id" name="cliente_id">

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Nombre</label>
                            <input id="edit_cliente_nombre" class="form-control text-model_input" type="text" name="cliente_nombre" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Tipo de Documento</label>
                            <select id="edit_cliente_tipo_documento" class="form-select" name="cliente_tipo_documento" required>
                                <option value="" class="text-model_input">Seleccione la opcion</option>
                                <option value="Cedula Ciudadania" class="text-model_input">Cedula Ciudadania</option>
                                <option value="Tarjeta de identidad" class="text-model_input">Tarjeta de identidad</option>
                                <option value="Cedula extranjera" class="text-model_input">Cedula extranjera</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Número de Documento</label>
                            <input id="edit_cliente_numero_documento" class="form-control text-model_input" type="text" name="cliente_numero_documento" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Teléfono</label>
                            <input id="edit_cliente_telefono" class="form-control text-model_input" type="text" name="cliente_telefono" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success text-model">Actualizar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/cliente.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    // Funciones para los modales
    function abrirModalRegistrocliente() {
        const modal = new bootstrap.Modal(document.getElementById('modal-registro-cliente'));
        modal.show();
    }

    function cerrarModalRegistrocliente() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('modal-registro-cliente'));
        modal.hide();
        document.getElementById('form-registro-cliente').reset();
    }

    function abrirModalEditarcliente(cliente) {
        document.getElementById('cliente_id').value = cliente.id_cliente;
        document.getElementById('edit_cliente_nombre').value = cliente.nombre;
        document.getElementById('edit_cliente_tipo_documento').value = cliente.tipo_documento;
        document.getElementById('edit_cliente_numero_documento').value = cliente.numero_documento;
        document.getElementById('edit_cliente_telefono').value = cliente.telefono;
        const modal = new bootstrap.Modal(document.getElementById('modal-editar-cliente'));
        modal.show();
    }

    function cerrarModalEditarcliente() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('modal-editar-cliente'));
        modal.hide();
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
            Swal.fire({
                icon: resp.icono || 'info',
                title: resp.titulo,
                text: resp.texto,
                width: '400px',
                padding: '2em',
                customClass: {
                    title: 'fs-4',
                    htmlContainer: 'fs-4',
                    confirmButton: 'fs-5',
                    timer: 2000,
                    timerProgressBar: true
                }
            }).then((result) => {
                if (resp.tipo === 'limpiar') {
                    cerrarModalRegistrocliente();
                    cargarClientes();
                }
            });
        }
    });
});

// Updated edit form handler with SweetAlert2
$('#form-edicion-cliente').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            const resp = JSON.parse(response);
            Swal.fire({
                icon: resp.icono || 'info',
                title: resp.titulo,
                text: resp.texto,
                width: '400px',
                padding: '2em',
                customClass: {
                    title: 'fs-4',
                    htmlContainer: 'fs-5',
                    confirmButton: 'fs-5'
                }
            }).then((result) => {
                if (resp.tipo === 'recargar') {
                    cerrarModalEditarcliente();
                    cargarClientes();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar el cliente. Por favor, intente nuevamente.'
            });
        }
    });
});

// Updated delete function with SweetAlert2
function eliminarCliente(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¿Desea eliminar este cliente?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        width: '400px',
        padding: '2em',
        customClass: {
            title: 'fs-4',
            htmlContainer: 'fs-5',
            confirmButton: 'fs-5',
            cancelButton: 'fs-5',
            popup: 'custom-popup'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/clienteAjax.php',
                type: 'POST',
                data: {
                    modulo_cliente: 'eliminar',
                    cliente_id: id
                },
                success: function(response) {
                    const resp = JSON.parse(response);
                    Swal.fire({
                        icon: resp.icono || 'info',
                        title: resp.titulo,
                        text: resp.texto,
                        width: '400px',
                        padding: '2em',
                        customClass: {
                            title: 'fs-4',
                            htmlContainer: 'fs-5',
                            confirmButton: 'fs-5'
                        }
                    }).then((result) => {
                        if (resp.tipo === 'recargar') {
                            cargarClientes();
                        }
                    });
                }
            });
        }
    });
}

$(document).ready(function() {
    cargarClientes();
});
</script>
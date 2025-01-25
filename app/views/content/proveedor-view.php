

<div class="container">

<div class="position-contenido">
  <div class="position-buttom">
    <button class="btn-registrar btn btn-primary mb-4" onclick="abrirModalRegistroProveedor()">
        Registrar Nuevo Proveedor
    </button>
    </div>

    <div class="content-name">
        <div class="container-fluid mb-4">
          <h1 class="text-titulo">Proveedores</h1>
          <h2 class="h4 text-muted">Gestión de Proveedores</h2>
      </div>
    </div>

</div>
    

    <!-- Listado de Proveedores -->
    <div id="lista-proveedores" class="mt-4">
        <!-- Aquí se cargará la lista de proveedores -->
    </div>

    <!-- Modal de Registro -->
    <div class="modal fade" id="modal-registro-proveedor" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-model_title">Registrar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-registro-proveedor" method="POST">
                        <input type="hidden" name="modulo_proveedor" value="registrar">

                        <div class="mb-3">
                            <label class="form-label  fw-semibold text-model">Código</label>
                            <input class="form-control text-model_input" type="text" name="proveedor_codigo" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label  fw-semibold text-model">Nombre de la Empresa</label>
                            <input class="form-control text-model_input" type="text" name="proveedor_nombreEmpresa" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label  fw-semibold text-model">Contacto</label>
                            <input class="form-control text-model_input" type="text" name="proveedor_contacto">
                        </div>

                        <div class="mb-3">
                            <label class="form-label  fw-semibold text-model">Dirección</label>
                            <textarea class="form-control text-model_input" name="proveedor_direccion"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label  fw-semibold text-model">Teléfono</label>
                            <input class="form-control text-model_input" type="text" name="proveedor_telefono">
                        </div>

                        <div class="mb-3">
                            <label class="form-label  fw-semibold text-model">Email</label>
                            <input class="form-control text-model_input" type="email" name="proveedor_email">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-model" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success text-model">Registrar Proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Actualización -->
    <div class="modal fade" id="modal-editar-proveedor" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-model_title">Actualizar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edicion-proveedor" method="POST">
                        <input type="hidden" name="modulo_proveedor" value="actualizar">
                        <input type="hidden" id="proveedor_id" name="proveedor_id">

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Código</label>
                            <input id="edit_proveedor_codigo" class="form-control text-model_input" type="text" name="proveedor_codigo" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Nombre de la Empresa</label>
                            <input id="edit_proveedor_nombreEmpresa" class="form-control text-model_input" type="text" name="proveedor_nombreEmpresa" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Contacto</label>
                            <input id="edit_proveedor_contacto" class="form-control text-model_input" type="text" name="proveedor_contacto">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Dirección</label>
                            <textarea id="edit_proveedor_direccion" class="form-control text-model_input" name="proveedor_direccion"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Teléfono</label>
                            <input id="edit_proveedor_telefono" class="form-control text-model_input" type="text" name="proveedor_telefono">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Email</label>
                            <input id="edit_proveedor_email" class="form-control text-model_input" type="email" name="proveedor_email">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-model" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success text-model">Actualizar Proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/proveedor.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    // Bootstrap Modal Handler Functions
    function abrirModalRegistroProveedor() {
        var modal = new bootstrap.Modal(document.getElementById('modal-registro-proveedor'));
        modal.show();
    }

    function abrirModalEditarProveedor(proveedor) {
        document.getElementById('proveedor_id').value = proveedor.id_proveedor;
        document.getElementById('edit_proveedor_codigo').value = proveedor.codigo;
        document.getElementById('edit_proveedor_nombreEmpresa').value = proveedor.nombreEmpresa;
        document.getElementById('edit_proveedor_contacto').value = proveedor.contacto;
        document.getElementById('edit_proveedor_direccion').value = proveedor.direccion;
        document.getElementById('edit_proveedor_telefono').value = proveedor.telefono;
        document.getElementById('edit_proveedor_email').value = proveedor.email;

        var modal = new bootstrap.Modal(document.getElementById('modal-editar-proveedor'));
        modal.show();
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
        // Manejador para el formulario de registro con SweetAlert2
$('#form-registro-proveedor').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
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
                if (resp.tipo === "limpiar") {
                    cerrarModalRegistroProveedor();
                    cargarProveedores();
                }
            });
        }
    });
});

// Manejador para el formulario de edición con SweetAlert2
$('#form-edicion-proveedor').on('submit', function(e) {
    e.preventDefault();
    const formData = $(this).serialize() + "&modulo_proveedor=actualizar";
    
    $.ajax({
        url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
        type: 'POST',
        data: formData,
        dataType: "json",
        success: function(response) {
            Swal.fire({
                icon: response.icono || 'info',
                title: response.titulo,
                text: response.texto,
                width: '400px',
                padding: '2em',
                customClass: {
                    title: 'fs-4',
                    htmlContainer: 'fs-5',
                    confirmButton: 'fs-5'
                }
            }).then((result) => {
                if (response.tipo === "recargar") {
                    cerrarModalEditarProveedor();
                    cargarProveedores();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar el proveedor. Por favor, intente nuevamente.'
            });
        }
    });
});
  
// Función para eliminar proveedor con SweetAlert2
function eliminarProveedor(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¿Desea eliminar este proveedor?",
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
                url: '<?= APP_URL ?>app/ajax/proveedorAjax.php',
                type: 'POST',
                data: {
                    modulo_proveedor: 'eliminar',
                    proveedor_id: id
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
                        if (resp.tipo === "recargar") {
                            cargarProveedores();
                        }
                    });
                }
            });
        }
    });
}

// Cargar proveedores al iniciar la página
$(document).ready(function() {
    cargarProveedores();
});
</script>
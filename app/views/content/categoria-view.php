<div class="container">
  <div class="position-contenido">

    <div class="position-buttom">
      <button class="btn-registrar btn btn-primary mb-4" onclick="abrirModalRegistrocategoria()">
        <i class="bi bi-plus-square"></i>
          Nueva Categoría
      </button>
    </div>

    <div class="content-name">
        <div class="container-fluid mb-4">
          <h1 class="text-titulo">Categorías</h1>
          <h2 class="h4 text-muted">Gestión de Categorías</h2>
        </div>
    </div>

  </div>
    <!-- Listado de Categorías -->
    <div id="lista-categorias" class="mt-4">
        <!-- Aquí se cargará la lista de categorías -->
    </div>

    <!-- Modal de Registro -->
    <div id="modal-registro_categoria" class="modal fade" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-model_title" id="modalRegistroLabel">Registrar Categoría</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalRegistrocategoria()"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-registro_categoria" method="POST">
                    <input type="hidden" name="modulo_categoria" value="registrar">

                    <div class="mb-4">
                        <label for="categoria_codigo" class="form-label fw-semibold text-model">Código</label>
                        <input class="form-control form-control-lg text-model_input" type="text" id="categoria_codigo" name="categoria_codigo" required>
                    </div>

                    <div class="mb-4">
                        <label for="categoria_nombre" class="form-label fw-semibold text-model">Nombre</label>
                        <input class="form-control form-control-lg text-model_input" type="text" id="categoria_nombre" name="categoria_nombre" required>
                    </div>

                    <div class="mb-4">
                        <label for="categoria_subcategoria" class="form-label fw-semibold text-model">Subcategoría</label>
                        <input class="form-control form-control-lg text-model_input" type="text" id="categoria_subcategoria" name="categoria_subcategoria" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg px-4 text-model">Registrar Categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de Actualización -->
   <div id="modal-editar_categoria" class="modal fade" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalEditarLabel" class="modal-title text-model_title">Actualizar Categoría</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalEditarcategoria()"></button>
            </div>
            <div class="modal-body">
                <form id="form-edicion_categoria">
                    <input type="hidden" name="modulo_categoria" value="actualizar">
                    <input type="hidden" id="categoria_id" name="categoria_id">

                    <div class="field">
                        <label for="edit_categoria_codigo" class="form-label fw-semibold text-model">Código</label>
                        <input id="edit_categoria_codigo" type="text" class="form-control form-control-lg text-model_input" name="categoria_codigo" required>
                    </div>

                    <div class="field">
                        <label for="edit_categoria_nombre" class="form-label fw-semibold text-model">Nombre</label>
                        <input id="edit_categoria_nombre" type="text" class="form-control form-control-lg text-model_input" name="categoria_nombre" required>
                    </div>

                    <div class="field">
                        <label for="edit_categoria_subcategoria" class="form-label fw-semibold text-model ">Subcategoría</label>
                        <input id="edit_categoria_subcategoria" type="text" class="form-control text-model_input" name="categoria_subcategoria" required>
                    </div>

                    <button type="submit" class="btn btn-primary text-model">Actualizar Categoría</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>


<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/category.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
   // Functions for modals remain the same
function abrirModalRegistrocategoria() {
    const modal = new bootstrap.Modal(document.getElementById("modal-registro_categoria"));
    modal.show();
}

function cerrarModalRegistrocategoria() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-registro_categoria"));
    modal.hide();
    document.getElementById("form-registro_categoria").reset();
}

function abrirModalEditarcategoria(categoria) {
    const modal = new bootstrap.Modal(document.getElementById("modal-editar_categoria"));
    
    document.getElementById("categoria_id").value = categoria.id_categoria;
    document.getElementById("edit_categoria_codigo").value = categoria.codigo;
    document.getElementById("edit_categoria_nombre").value = categoria.nombre;
    document.getElementById("edit_categoria_subcategoria").value = categoria.subcategoria || '';
    
    modal.show();
}

function cerrarModalEditarcategoria() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-editar_categoria"));
    modal.hide();
    document.getElementById("form-edicion_categoria").reset();
}

function cargarCategorias() {
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
        type: "POST",
        data: {
            modulo_categoria: "listar",
            pagina: 1,
            registros: 15,
            url: "categoria",
        },
        success: function(response) {
            $("#lista-categorias").html(response);
        }
    });
}

// Updated registration form handler with SweetAlert2
$("#form-registro_categoria").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
        type: "POST",
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
                    cerrarModalRegistrocategoria();
                    cargarCategorias();
                }
            });
        }
    });
});

// Updated edit form handler with SweetAlert2
$("#form-edicion_categoria").on("submit", function(e) {
    e.preventDefault();
    const formData = $(this).serialize() + "&modulo_categoria=actualizar";
    
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(response) {
            Swal.fire({
                icon: response.icono || 'info',
                title: response.titulo,
                text: response.texto
            }).then((result) => {
                if (response.tipo === "recargar") {
                    cerrarModalEditarcategoria();
                    cargarCategorias();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar la categoría. Por favor, intente nuevamente.'
            });
        }
    });
});

// Updated delete function with SweetAlert2
function eliminarCategoria(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¿Desea eliminar esta categoría?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        width: '400px',
        padding: '2em',
        customClass: {
            title: 'fs-4',          // Clase Bootstrap para texto más grande
            htmlContainer: 'fs-5',   // Clase Bootstrap para texto más grande
            confirmButton: 'fs-5',   // Clase Bootstrap para texto más grande en botones
            cancelButton: 'fs-5',    // Clase Bootstrap para texto más grande en botones
            popup: 'custom-popup'    // Clase personalizada para el popup
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
                type: "POST",
                data: {
                    modulo_categoria: "eliminar",
                    categoria_id: id,
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
                            cargarCategorias();
                        }
                    });
                }
            });
        }
    });
}

$(document).ready(function() {
    cargarCategorias();
});

</script>
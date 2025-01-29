<div class="container">
  <div class="position-contenido">

    <div class="position-buttom">
      <button class="btn-registrar btn btn-primary mb-4" onclick="abrirModalRegistroSubcategoria()">
        <i class="bi bi-plus-square"></i>
          Nueva Subcategoría
      </button>
    </div>

    <div class="content-name">
        <div class="container-fluid mb-4">
          <h1 class="text-titulo">Subcategorías</h1>
          <h2 class="h4 text-muted">Gestión de Subcategorías</h2>
        </div>
    </div>

  </div>
    <!-- Listado de Subcategorías -->
    <div id="lista-subcategorias" class="mt-4">
        <!-- Aquí se cargará la lista de subcategorías -->
    </div>

    <!-- Modal de Registro -->
    <div id="modal-registro_subcategoria" class="modal fade" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-model_title" id="modalRegistroLabel">Registrar Subcategoría</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalRegistroSubcategoria()"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-registro_subcategoria" method="POST">
                    <input type="hidden" name="modulo_subcategoria" value="registrar">

                    <div class="mb-4">
                        <label for="subcategoria_nombre" class="form-label fw-semibold text-model">Nombre</label>
                        <input class="form-control form-control-lg text-model_input" type="text" id="subcategoria_nombre" name="subcategoria_nombre" required>
                    </div>

                    <div class="mb-4">
                        <label for="libro_genero" class="form-label fw-semibold text-model">Categoría *</label>
                        <select class="form-control text-model_input" id="libro_genero" name="subcategoria_id_categoria" required>
                                 <option value="">Seleccionar Categoría</option>
    <!-- Opciones dinámicas -->
                      </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg px-4 text-model">Registrar Subcategoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de Actualización -->
<div id="modal-editar_subcategoria" class="modal fade" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalEditarLabel" class="modal-title text-model_title">Actualizar Subcategoría</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalEditarSubcategoria()"></button>
            </div>
            <div class="modal-body">
                <form id="form-edicion_subcategoria">
                    <input type="hidden" name="modulo_subcategoria" value="actualizar">
                    <input type="hidden" id="subcategoria_id" name="subcategoria_id">
                    <div class="field">
                        <label for="edit_subcategoria_nombre" class="form-label fw-semibold text-model">Nombre</label>
                        <input id="edit_subcategoria_nombre" type="text" class="form-control form-control-lg text-model_input" name="subcategoria_nombre" required>
                    </div>
                    <div class="field">
                        <label for="edit_subcategoria_categoria" class="form-label fw-semibold text-model">Categoría</label>
                        <select id="edit_subcategoria_categoria" class="form-select form-select-lg text-model_input" name="subcategoria_categoria" required>
                          <!-- Aquí se cargarán las categorías dinámicamente -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-model">Actualizar Subcategoría</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>


<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/subcategoria.css">
<script>
function abrirModalRegistroSubcategoria() {
    const modal = new bootstrap.Modal(document.getElementById("modal-registro_subcategoria"));
    modal.show();
    cargarCategoriasEnSelect("#subcategoria_categoria");
}

function cerrarModalRegistroSubcategoria() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-registro_subcategoria"));
    modal.hide();
    document.getElementById("form-registro_subcategoria").reset();
}

function abrirModalEditarSubcategoria(subcategoria) {
    const modal = new bootstrap.Modal(document.getElementById("modal-editar_subcategoria"));
    
    // Establece los valores en el formulario de edición
    document.getElementById("subcategoria_id").value = subcategoria.id_subcategoria;
    document.getElementById("edit_subcategoria_nombre").value = subcategoria.nombre;

    // Cargar la categoría correcta en el select
    cargarCategoriasEnSelect("#edit_subcategoria_categoria", subcategoria.categoria_id);
    
    modal.show();
}

function cerrarModalEditarSubcategoria() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-editar_subcategoria"));
    modal.hide();
    document.getElementById("form-edicion_subcategoria").reset();
}

// Función para cargar las categorías
function cargarCategoriasSubcategoria() {
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/subcategoriaAjax.php",
        type: "POST",
        data: { 
            modulo_subcategoria: "obtenerCategoriasSubcategoria"
        },
        beforeSend: function() {
            $("#libro_genero, #edit_libro_genero").html('<option>Cargando categorías...</option>');
        },
        success: function(response) {
            try {
                const categorias = JSON.parse(response);
                $("#libro_genero, #edit_libro_genero").empty();
                $("#libro_genero, #edit_libro_genero").append('<option value="">Seleccionar Categoría</option>');
                categorias.forEach(function(categoria) {
                    $("#libro_genero, #edit_libro_genero").append(
                        `<option value="${categoria.id_categoria}">${categoria.nombre}</option>`
                    );
                });
            } catch (e) {
                console.error("Error al analizar JSON:", e);
                console.log("Respuesta del servidor:", response);
                $("#libro_genero, #edit_libro_genero").html('<option>Error al cargar las categorías</option>');
            }
        },
        error: function() {
            $("#libro_genero, #edit_libro_genero").html('<option>Error al cargar las categorías</option>');
        }
    });
}


function cargarSubcategorias() {
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/subcategoriaAjax.php",
        type: "POST",
        data: {
            modulo_subcategoria: "listar",
            pagina: 1,
            registros: 15,
            url: "subcategoria",
        },
        success: function (response) {
            $("#lista-subcategorias").html(response);
        }
    });
}

$("#form-registro_subcategoria").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/subcategoriaAjax.php",
        type: "POST",
        data: $(this).serialize(),
        success: function (response) {
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
                }
            }).then((result) => {
                if (resp.tipo === "limpiar") {
                    cerrarModalRegistroSubcategoria();
                    cargarSubcategorias();
                }
            });
        }
    });
});

$("#form-edicion_subcategoria").on("submit", function (e) {
    e.preventDefault();
    const formData = $(this).serialize() + "&modulo_subcategoria=actualizar";

    $.ajax({
        url: "<?= APP_URL ?>app/ajax/subcategoriaAjax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (response) {
            Swal.fire({
                icon: response.icono || 'info',
                title: response.titulo,
                text: response.texto,
                width: '400px',
                padding: '2em',
                customClass: {
                    title: 'fs-4',
                    htmlContainer: 'fs-4',
                    confirmButton: 'fs-5',
                }
            }).then((result) => {
                if (response.tipo === "recargar") {
                    cerrarModalEditarSubcategoria();
                    cargarSubcategorias();
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar la subcategoría. Por favor, intente nuevamente.'
            });
        }
    });
});

function eliminarSubcategoria(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¿Desea eliminar esta subcategoría?",
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
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= APP_URL ?>app/ajax/subcategoriaAjax.php",
                type: "POST",
                data: {
                    modulo_subcategoria: "eliminar",
                    subcategoria_id: id,
                },
                success: function (response) {
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
                            cargarSubcategorias();
                        }
                    });
                }
            });
        }
    });
}

$(document).ready(function () {
    cargarSubcategorias();
    cargarCategoriasSubcategoria();
});

</script>
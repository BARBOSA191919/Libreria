<div class="container-fluid mb-4">
    <h1 class="display-4">Inventario</h1>
    <h2 class="h4 text-muted">Gestión de Inventario</h2>
</div>

<div class="container py-4">
    <button class="btn btn-primary mb-4" onclick="abrirModalRegistroInventario()">
        Registrar Nuevo Libro
    </button>

    <!-- Listado de Inventario -->
    <div id="lista-inventario" class="mt-4">
        <!-- Aquí se cargará la lista de libros -->
    </div>

    <!-- Modal de Registro -->
     <div id="modal-registro_inventario" class="modal fade" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRegistroLabel">Registrar Libro</h5>
                    <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalRegistroInventario()"></button>
                </div>
                <div class="modal-body">
                    <form id="form-registro_inventario" method="POST">
                        <input type="hidden" name="modulo_inventario" value="registrar">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="libro_codigo" class="form-label">Código *</label>
                                <input class="form-control" type="text" id="libro_codigo" name="libro_codigo" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="libro_titulo" class="form-label">Título *</label>
                                <input class="form-control" type="text" id="libro_titulo" name="libro_titulo" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="libro_autor" class="form-label">Autor *</label>
                                <input class="form-control" type="text" id="libro_autor" name="libro_autor" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="libro_editorial" class="form-label">Editorial</label>
                                <input class="form-control" type="text" id="libro_editorial" name="libro_editorial">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="libro_anio" class="form-label">Año de Publicación</label>
                                <input class="form-control" type="number" id="libro_anio" name="libro_anio">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="libro_genero" class="form-label">Género</label>
                                <input class="form-control" type="text" id="libro_genero" name="libro_genero">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="libro_idioma" class="form-label">Idioma</label>
                                <input class="form-control" type="text" id="libro_idioma" name="libro_idioma">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="libro_precio" class="form-label">Precio *</label>
                                <input class="form-control" type="number" step="0.01" id="libro_precio" name="libro_precio" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="libro_cantidad" class="form-label">Cantidad *</label>
                                <input class="form-control" type="number" id="libro_cantidad" name="libro_cantidad" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="libro_paginas" class="form-label">Número de Páginas</label>
                                <input class="form-control" type="number" id="libro_paginas" name="libro_paginas">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="libro_formato" class="form-label">Formato</label>
                            <input class="form-control" type="text" id="libro_formato" name="libro_formato">
                        </div>

                        <button type="submit" class="btn btn-success">Registrar Libro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Actualización -->
     <div id="modal-editar_inventario" class="modal fade" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalEditarLabel" class="modal-title">Actualizar Libro</h5>
                    <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalEditarInventario()"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edicion_inventario">
                        <input type="hidden" name="modulo_inventario" value="actualizar">
                        <input type="hidden" id="libro_id" name="libro_id">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_libro_codigo" class="form-label">Código *</label>
                                <input class="form-control" type="text" id="edit_libro_codigo" name="libro_codigo" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit_libro_titulo" class="form-label">Título *</label>
                                <input class="form-control" type="text" id="edit_libro_titulo" name="libro_titulo" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_libro_autor" class="form-label">Autor *</label>
                                <input class="form-control" type="text" id="edit_libro_autor" name="libro_autor" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit_libro_editorial" class="form-label">Editorial</label>
                                <input class="form-control" type="text" id="edit_libro_editorial" name="libro_editorial">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_anio" class="form-label">Año de Publicación</label>
                                <input class="form-control" type="number" id="edit_libro_anio" name="libro_anio">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_genero" class="form-label">Género</label>
                                <input class="form-control" type="text" id="edit_libro_genero" name="libro_genero">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_idioma" class="form-label">Idioma</label>
                                <input class="form-control" type="text" id="edit_libro_idioma" name="libro_idioma">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_precio" class="form-label">Precio *</label>
                                <input class="form-control" type="number" step="0.01" id="edit_libro_precio" name="libro_precio" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_cantidad" class="form-label">Cantidad *</label>
                                <input class="form-control" type="number" id="edit_libro_cantidad" name="libro_cantidad" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_paginas" class="form-label">Número de Páginas</label>
                                <input class="form-control" type="number" id="edit_libro_paginas" name="libro_paginas">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_libro_formato" class="form-label">Formato</label>
                            <input class="form-control" type="text" id="edit_libro_formato" name="libro_formato">
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Libro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Funciones para los modales
function abrirModalRegistroInventario() {
    const modal = new bootstrap.Modal(document.getElementById("modal-registro_inventario"));
    modal.show();
}

function cerrarModalRegistroInventario() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-registro_inventario"));
    modal.hide();
    document.getElementById("form-registro_inventario").reset();
}

function abrirModalEditarInventario(libro) {
    const modal = new bootstrap.Modal(document.getElementById("modal-editar_inventario"));
    
    // Establece los valores en el formulario de edición
    document.getElementById("libro_id").value = libro.id_libro;
    document.getElementById("edit_libro_codigo").value = libro.codigo;
    document.getElementById("edit_libro_titulo").value = libro.tituloLibro;
    document.getElementById("edit_libro_autor").value = libro.autor;
    document.getElementById("edit_libro_editorial").value = libro.editorial;
    document.getElementById("edit_libro_anio").value = libro.anioPublicacion;
    document.getElementById("edit_libro_genero").value = libro.genero;
    document.getElementById("edit_libro_precio").value = libro.precioVenta;
    document.getElementById("edit_libro_cantidad").value = libro.cantidad;
    document.getElementById("edit_libro_idioma").value = libro.idioma;
    document.getElementById("edit_libro_paginas").value = libro.noPaginas;
    document.getElementById("edit_libro_formato").value = libro.formato;
    
    modal.show();
}

function cerrarModalEditarInventario() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-editar_inventario"));
    modal.hide();
    document.getElementById("form-edicion_inventario").reset();
}

// Función para cargar la lista de libros
function cargarInventario() {
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
        type: "POST",
        data: {
            modulo_inventario: "listar",
            pagina: 1,
            registros: 15,
            url: "inventario",
            busqueda: ""
        },
        success: function(response) {
            $("#lista-inventario").html(response);
        }
    });
}

// Manejador para el formulario de registro
$("#form-registro_inventario").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
            const resp = JSON.parse(response);
            alert(resp.texto);
            if (resp.tipo === "limpiar") {
                cerrarModalRegistroInventario();
                cargarInventario();
            }
        }
    });
});

// Manejador para el formulario de edición
$("#form-edicion_inventario").on("submit", function(e) {
    e.preventDefault();
    const formData = $(this).serialize() + "&modulo_inventario=actualizar";
    
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
        type: "POST",
        data: formData,
        dataType: "json",
        success: function(response) {
            alert(response.texto);
            if (response.tipo === "recargar") {
                cerrarModalEditarInventario();
                cargarInventario();
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
            alert("Error al actualizar el libro. Por favor, intente nuevamente.");
        }
    });
});

// Función para eliminar libro
function eliminarLibro(id) {
    if (confirm("¿Está seguro de eliminar este libro?")) {
        $.ajax({
            url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
            type: "POST",
            data: {
                modulo_inventario: "eliminar",
                libro_id: id
            },
            success: function(response) {
                const resp = JSON.parse(response);
                alert(resp.texto);
                if (resp.tipo === "recargar") {
                    cargarInventario();
                }
            }
        });
    }
}

// Cargar inventario al iniciar la página
$(document).ready(function() {
    cargarInventario();
});
</script>
<div class="container">
<div class="position-contenido">

  <div class="position-buttom">
    <button class="btn-registrar btn btn-primary mb-4" onclick="abrirModalRegistroInventario()">
      <i class="bi bi-plus-square"></i>
        Nuevo Libro
    </button>
 </div>

  <div class="content-name">
    <div class="container-fluid mb-4">
        <h1 class="text-titulo">Inventario</h1>
        <h2 class="h4 text-muted">Gestión de Inventario</h2>
    </div>
  </div>

  </div>

    <!-- Listado de Inventario -->
    <div id="lista-inventario" class="mt-4">
        <!-- Aquí se cargará la lista de libros -->
    </div>

    <!-- Modal de Registro -->
     <div id="modal-registro_inventario" class="modal fade" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-model_title" id="modalRegistroLabel">Registrar Libro</h5>
                    <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalRegistroInventario()"></button>
                </div>
                <div class="modal-body">
                  
                    <form id="form-registro_inventario" method="POST">
                        <input type="hidden" name="modulo_inventario" value="registrar">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="libro_codigo" class="form-label fw-semibold text-model">Código *</label>
                                <input class="form-control text-model_input" type="text" id="libro_codigo" name="libro_codigo" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="libro_titulo" class="form-label fw-semibold text-model">Título *</label>
                                <input class="form-control text-model_input" type="text" id="libro_titulo" name="libro_titulo" required>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                              <label for="libro_autor" class="form-label fw-semibold text-model">Autor *</label>
                                  <select class="form-control text-model_input" id="libro_autor" name="libro_autor" required>
                                      <option value="">Seleccionar Autor</option>
                                      <!-- AQUI SE VAN A SELECCIOANR LOS AUTORES -->
                                  </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="libro_editorial" class="form-label fw-semibold text-model">Editorial</label>
                                <input class="form-control text-model_input" type="text" id="libro_editorial" name="libro_editorial">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="libro_anio" class="form-label fw-semibold text-model">Año de Publicación</label>
                                <input class="form-control text-model_input" type="number" id="libro_anio" name="libro_anio">
                            </div>

                            <div class="col-md-4 mb-3">
                                  <label for="libro_genero" class="form-label fw-semibold text-model">Categoría *</label>
                                  <select class="form-control text-model_input" id="libro_genero" name="libro_genero" required>
                                      <option value="">Seleccionar Categoría</option>
                                      <!-- AQUI SE VAN A SELECCIONAR LAS CATEGORÍAS -->
                                  </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="libro_idioma" class="form-label fw-semibold text-model">Idioma</label>
                                <input class="form-control text-model_input" type="text" id="libro_idioma" name="libro_idioma">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="libro_precio" class="form-label fw-semibold text-model">Precio *</label>
                                <input class="form-control text-model_input" type="number" step="0.01" id="libro_precio" name="libro_precio" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="libro_cantidad" class="form-label fw-semibold text-model">Cantidad *</label>
                                <input class="form-control text-model_input" type="number" id="libro_cantidad" name="libro_cantidad" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="libro_paginas" class="form-label fw-semibold text-model">Número de Páginas</label>
                                <input class="form-control text-model_input" type="number" id="libro_paginas" name="libro_paginas">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="libro_formato" class="form-label fw-semibold text-model">Formato</label>
                            <input class="form-control text-model_input" type="text" id="libro_formato" name="libro_formato">
                        </div>

                        <button type="submit" class="btn btn-success text-model">Registrar Libro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Actualización -->
     <div id="modal-editar_inventario" class="modal fade" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalEditarLabel" class="modal-title text-model_title">Actualizar Libro</h5>
                    <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalEditarInventario()"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edicion_inventario">
                        <input type="hidden" name="modulo_inventario" value="actualizar">
                        <input type="hidden" id="libro_id" name="libro_id">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_libro_codigo" class="form-label text-model">Código *</label>
                                <input class="form-control text-model_input" type="text" id="edit_libro_codigo" name="libro_codigo" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit_libro_titulo" class="form-label text-model">Título *</label>
                                <input class="form-control text-model_input" type="text" id="edit_libro_titulo" name="libro_titulo" required>
                            </div>
                        </div>

                        <div class="row">

                        <div class="col-md-6 mb-3">
                              <label for="edit_libro_autor" class="form-label fw-semibold text-model">Autor *</label>
                                  <select class="form-control text-model_input" id="edit_libro_autor" name="libro_autor" required>
                                      <option value="">Seleccionar Autor</option>
                                      <!-- AQUI SE VAN A SELECCIOANR LOS AUTORES -->
                                  </select>
                            </div>
                          

                            <div class="col-md-6 mb-3">
                                <label for="edit_libro_editorial" class="form-label text-model">Editorial</label>
                                <input class="form-control text-model_input" type="text" id="edit_libro_editorial" name="libro_editorial">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_anio" class="form-label text-model">Año de Publicación</label>
                                <input class="form-control text-model_input" type="number" id="edit_libro_anio" name="libro_anio">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_genero" class="form-label fw-semibold text-model">Categoría *</label>
                                <select class="form-control text-model_input" id="edit_libro_genero" name="libro_genero" required>
                                    <option value="">Seleccionar Categoría</option>
                                    <!-- AQUI SE VAN A SELECCIONAR LAS CATEGORÍAS -->
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_idioma" class="form-label text-model">Idioma</label>
                                <input class="form-control text-model_input" type="text" id="edit_libro_idioma" name="libro_idioma">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_precio" class="form-label text-model">Precio *</label>
                                <input class="form-control text-model_input" type="number" step="0.01" id="edit_libro_precio" name="libro_precio" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_cantidad" class="form-label text-model">Cantidad *</label>
                                <input class="form-control text-model_input" type="number" id="edit_libro_cantidad" name="libro_cantidad" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="edit_libro_paginas" class="form-label text-model">Número de Páginas</label>
                                <input class="form-control text-model_input" type="number" id="edit_libro_paginas" name="libro_paginas">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_libro_formato" class="form-label text-model">Formato</label>
                            <input class="form-control text-model_input" type="text" id="edit_libro_formato" name="libro_formato">
                        </div>

                        <button type="submit" class="btn btn-primary text-model">Actualizar Libro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/inventario.css">


<script>
// Funciones para los modales
function abrirModalRegistroInventario() {
    const modal = new bootstrap.Modal(document.getElementById("modal-registro_inventario"));
    cargarAutores();
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
    
    // Seleccionar el autor correcto en el dropdown
    const autorSelect = document.getElementById("edit_libro_autor");
    autorSelect.value = libro.libro_autor; // Asegúrate de que coincida con el nombre del campo en tu controlador
    
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

// Función para cargar los autores
function cargarAutoresInventario() {
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
        type: "POST",
        data: { 
            modulo_inventario: "obtenerAutores"  // Nuevo endpoint para obtener autores
        },
        beforeSend: function() {
            $("#libro_autor, #edit_libro_autor").html('<option>Cargando autores...</option>');
        },
        success: function(response) {
            const autores = JSON.parse(response);
            
            // Limpiar los select
            $("#libro_autor, #edit_libro_autor").empty();
            
            // Añadir la opción por defecto
            $("#libro_autor, #edit_libro_autor").append('<option value="">Seleccionar Autor</option>');
            
            // Llenar el select con los autores obtenidos
            autores.forEach(function(autor) {
                $("#libro_autor, #edit_libro_autor").append(
                    `<option value="${autor.idAutor}">${autor.nombre}</option>`
                );
            });
        },
        error: function() {
            $("#libro_autor, #edit_libro_autor").html('<option>Error al cargar los autores</option>');
        }
    });
}

// Función para cargar las categorías
function cargarCategoriasInventario() {
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
        type: "POST",
        data: { 
            modulo_inventario: "obtenerCategoriasInventario"  // Nuevo endpoint para obtener categorías
        },
        beforeSend: function() {
            $("#libro_genero, #edit_libro_genero").html('<option>Cargando categorías...</option>');
        },
        success: function(response) {
            const categorias = JSON.parse(response);
            
            // Limpiar los select
            $("#libro_genero, #edit_libro_genero").empty();
            
            // Añadir la opción por defecto
            $("#libro_genero, #edit_libro_genero").append('<option value="">Seleccionar Categoría</option>');
            
            // Llenar el select con las categorías obtenidas
            categorias.forEach(function(categoria) {
                $("#libro_genero, #edit_libro_genero").append(
                    `<option value="${categoria.id_categoria}">${categoria.nombre}</option>`
                );
            });
        },
        error: function() {
            $("#libro_genero, #edit_libro_genero").html('<option>Error al cargar las categorías</option>');
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
            Swal.fire({
                icon: resp.icono || 'info',
                title: resp.titulo,
                text: resp.texto,
                width: '400px',
                padding: '2em',
                customClass: {
                    title: 'fs-4',
                    htmlContainer: 'fs-5',
                    confirmButton: 'fs-5',
                    timer: 2000,
                    timerProgressBar: true
                }
            }).then((result) => {
                if (resp.tipo === "limpiar") {
                    cerrarModalRegistroInventario();
                    cargarInventario();
                }
            });
        }
    });
});

// Updated edit form handler with SweetAlert2
$("#form-edicion_inventario").on("submit", function(e) {
    e.preventDefault();
    const formData = $(this).serialize() + "&modulo_inventario=actualizar";
    
    $.ajax({
        url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
        type: "POST",
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
                    cerrarModalEditarInventario();
                    cargarInventario();
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar el libro. Por favor, intente nuevamente.',
                width: '400px',
                padding: '2em',
                customClass: {
                    title: 'fs-4',
                    htmlContainer: 'fs-5',
                    confirmButton: 'fs-5'
                }
            });
        }
    });
});

// Updated delete function with SweetAlert2
function eliminarLibro(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¿Desea eliminar este libro?",
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
            htmlContainer: 'fs-4',
            confirmButton: 'fs-5',
            cancelButton: 'fs-5',
            popup: 'custom-popup'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
                type: "POST",
                data: {
                    modulo_inventario: "eliminar",
                    libro_id: id
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
                            htmlContainer: 'fs-4',
                            confirmButton: 'fs-5'
                        }
                    }).then((result) => {
                        if (resp.tipo === "recargar") {
                            cargarInventario();
                        }
                    });
                }
            });
        }
    });
}

$(document).ready(function() {
    cargarInventario();
    cargarAutoresInventario();
    cargarCategoriasInventario();
});
</script>
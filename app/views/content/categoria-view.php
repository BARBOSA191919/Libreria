
<div class="container-fluid mb-4">
    <h1 class="display-4">Categorías</h1>
    <h2 class="h4 text-muted">Gestión de Categorías</h2>
</div>

<div class="container py-4">
    <button class="btn btn-primary mb-4" onclick="abrirModalRegistrocategoria()">
        Registrar Nueva Categoría
    </button>

    <!-- Listado de Categorías -->
    <div id="lista-categorias" class="mt-4">
        <!-- Aquí se cargará la lista de categorías -->
    </div>

    <!-- Modal de Registro -->
    <div id="modal-registro_categoria" class="modal fade" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRegistroLabel">Registrar Categoría</h5>
                    <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalRegistrocategoria()"></button>
                </div>
                <div class="modal-body">
                    <form id="form-registro_categoria" method="POST">
                        <input type="hidden" name="modulo_categoria" value="registrar">

                        <div class="mb-3">
                            <label for="categoria_codigo" class="form-label">Código</label>
                            <input class="form-control" type="text" id="categoria_codigo" name="categoria_codigo" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoria_nombre" class="form-label">Nombre</label>
                            <input class="form-control" type="text" id="categoria_nombre" name="categoria_nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="categoria_subcategoria" class="form-label">Subcategoría</label>
                            <input class="form-control" type="text" id="categoria_subcategoria" name="categoria_subcategoria" required>
                        </div>

                        <button type="submit" class="btn btn-success">Registrar Categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Actualización -->
   <div id="modal-editar_categoria" class="modal fade" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalEditarLabel" class="modal-title">Actualizar Categoría</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalEditarcategoria()"></button>
            </div>
            <div class="modal-body">
                <form id="form-edicion_categoria">
                    <input type="hidden" name="modulo_categoria" value="actualizar">
                    <input type="hidden" id="categoria_id" name="categoria_id">
                    <div class="mb-3">
                        <label for="edit_categoria_codigo" class="form-label">Código</label>
                        <input id="edit_categoria_codigo" type="text" class="form-control" name="categoria_codigo" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_categoria_nombre" class="form-label">Nombre</label>
                        <input id="edit_categoria_nombre" type="text" class="form-control" name="categoria_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_categoria_subcategoria" class="form-label">Subcategoría</label>
                        <input id="edit_categoria_subcategoria" type="text" class="form-control" name="categoria_subcategoria" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>


 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
      // Funciones para los modales
// Funciones para los modales
// Función para abrir el modal de registro
function abrirModalRegistrocategoria() {
    const modal = new bootstrap.Modal(document.getElementById("modal-registro_categoria"));
    modal.show();
}

// Función para cerrar el modal de registro
function cerrarModalRegistrocategoria() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-registro_categoria"));
    modal.hide();
    document.getElementById("form-registro_categoria").reset(); // Limpia el formulario
}

// Función para abrir el modal de edición
function abrirModalEditarcategoria(categoria) {
    const modal = new bootstrap.Modal(document.getElementById("modal-editar_categoria"));
    
    // Establece los valores en el formulario de edición
    document.getElementById("categoria_id").value = categoria.id_categoria;
    document.getElementById("edit_categoria_codigo").value = categoria.codigo;
    document.getElementById("edit_categoria_nombre").value = categoria.nombre;
    document.getElementById("edit_categoria_subcategoria").value = categoria.subcategoria || '';
    
    modal.show();
}

// Función para cerrar el modal de edición
function cerrarModalEditarcategoria() {
    const modal = bootstrap.Modal.getInstance(document.getElementById("modal-editar_categoria"));
    modal.hide();
    document.getElementById("form-edicion_categoria").reset(); // Limpia el formulario
}


// Función para cargar la lista de categorías
function cargarCategorias() {
  $.ajax({
    url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
    type: "POST",
    data: {
      modulo_categoria: "listar",
      pagina: 1,
      registros: 10,
      url: "categoria",
    },
    success: function (response) {
      $("#lista-categorias").html(response);
    },
  });
}

// Manejador para el formulario de registro
$("#form-registro_categoria").on("submit", function (e) {
  e.preventDefault();
  $.ajax({
    url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
    type: "POST",
    data: $(this).serialize(),
    success: function (response) {
      const resp = JSON.parse(response);
      alert(resp.texto);
      if (resp.tipo === "limpiar") {
        cerrarModalRegistrocategoria();
        cargarCategorias();
      }
    },
  });
});

// Manejador para el formulario de edición
// Manejador para el formulario de edición
$("#form-edicion_categoria").on("submit", function (e) {
  e.preventDefault();
  const formData = $(this).serialize() + "&modulo_categoria=actualizar";
  
  $.ajax({
    url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
    type: "POST",
    data: formData,
    dataType: "json", // Especificamos que esperamos JSON
    success: function (response) {
      alert(response.texto);
      if (response.tipo === "recargar") {
        cerrarModalEditarcategoria();
        cargarCategorias();
      }
    },
    error: function(xhr, status, error) {
      // Manejador de errores para depuración
      console.error("Error en la petición:", error);
      console.log("Respuesta del servidor:", xhr.responseText);
      alert("Error al actualizar la categoría. Por favor, intente nuevamente.");
    }
  });
});

// Función para eliminar categoría
function eliminarCategoria(id) {
  if (confirm("¿Está seguro de eliminar esta categoría?")) {
    $.ajax({
      url: "<?= APP_URL ?>app/ajax/categoriaAjax.php",
      type: "POST",
      data: {
        modulo_categoria: "eliminar",
        categoria_id: id,
      },
      success: function (response) {
        const resp = JSON.parse(response);
        alert(resp.texto);
        if (resp.tipo === "recargar") {
          cargarCategorias();
        }
      },
    });
  }
}

// Cargar categorías al iniciar la página
$(document).ready(function () {
  cargarCategorias();
});


</script>
    <div class="container mt-4 mb-4">
        <h1 class="display-4">Inventario de Libros</h1>
        <h2 class="h3 text-muted">Gestión de Inventario</h2>
    </div>

    <div class="container py-4">
        <button class="btn btn-primary mb-4" onclick="abrirModalRegistro1()">
            Registrar Nuevo Libro
        </button>

        <!-- Listado de Libros -->
        <div id="lista-libros" class="mt-4">
            <!-- Aquí se cargará la lista de libros -->
        </div>

        <!-- Modal de Registro -->
        <div class="modal fade" id="modal-registro1" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Libro</h5>
                        <button type="button" class="btn-close" onclick="cerrarModalRegistro1()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-registro1" method="POST">
                            <input type="hidden" name="modulo_libro" value="registrar">

                            <div class="mb-3">
                                <label class="form-label">Código</label>
                                <input class="form-control" type="text" name="libro_codigo" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Título del Libro</label>
                                <input class="form-control" type="text" name="libro_titulo" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Autor</label>
                                <input class="form-control" type="text" name="libro_autor" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Editorial</label>
                                <input class="form-control" type="text" name="libro_editorial">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Año de Publicación</label>
                                    <input class="form-control" type="number" name="libro_año">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Género</label>
                                    <input class="form-control" type="text" name="libro_genero">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Precio de Venta</label>
                                    <input class="form-control" type="number" step="0.01" name="libro_precio" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Cantidad</label>
                                    <input class="form-control" type="number" name="libro_cantidad" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Idioma</label>
                                    <input class="form-control" type="text" name="libro_idioma">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Número de Páginas</label>
                                    <input class="form-control" type="number" name="libro_paginas">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Formato</label>
                                <select class="form-select" name="libro_formato">
                                    <option value="Tapa Dura">Tapa Dura</option>
                                    <option value="Tapa Blanda">Tapa Blanda</option>
                                    <option value="Digital">Digital</option>
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Registrar Libro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Actualización -->
        <div class="modal fade" id="modal-editar1" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Libro</h5>
                        <button type="button" class="btn-close" onclick="cerrarModalEditar1()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edicion1" method="POST">
                            <input type="hidden" name="modulo_libro" value="actualizar">
                            <input type="hidden" id="libro_id" name="libro_id">

                            <div class="mb-3">
                                <label class="form-label">Código</label>
                                <input id="edit_libro_codigo" class="form-control" type="text" name="libro_codigo" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Título del Libro</label>
                                <input id="edit_libro_titulo" class="form-control" type="text" name="libro_titulo" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Autor</label>
                                <input id="edit_libro_autor" class="form-control" type="text" name="libro_autor" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Editorial</label>
                                <input id="edit_libro_editorial" class="form-control" type="text" name="libro_editorial">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Año de Publicación</label>
                                    <input id="edit_libro_año" class="form-control" type="number" name="libro_año">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Género</label>
                                    <input id="edit_libro_genero" class="form-control" type="text" name="libro_genero">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Precio de Venta</label>
                                    <input id="edit_libro_precio" class="form-control" type="number" step="0.01" name="libro_precio" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Cantidad</label>
                                    <input id="edit_libro_cantidad" class="form-control" type="number" name="libro_cantidad" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Idioma</label>
                                    <input id="edit_libro_idioma" class="form-control" type="text" name="libro_idioma">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Número de Páginas</label>
                                    <input id="edit_libro_paginas" class="form-control" type="number" name="libro_paginas">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Formato</label>
                                <select id="edit_libro_formato" class="form-select" name="libro_formato">
                                    <option value="Tapa Dura">Tapa Dura</option>
                                    <option value="Tapa Blanda">Tapa Blanda</option>
                                    <option value="Digital">Digital</option>
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Actualizar Libro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  
// // Funciones para los modales
// function abrirModalRegistro1() {
//     document.getElementById("modal-registro1").classList.add("is-active");
// }

// function cerrarModalRegistro1() {
//     document.getElementById("modal-registro1").classList.remove("is-active");
//     document.getElementById("form-registro1").reset();
// }

// function abrirModalEditar1(libro) {
//     document.getElementById("libro_id").value = libro.id_libro;
//     document.getElementById("edit_libro_codigo").value = libro.codigo;
//     document.getElementById("edit_libro_titulo").value = libro.titulo;
//     document.getElementById("edit_libro_autor").value = libro.autor;
//     document.getElementById("edit_libro_editorial").value = libro.editorial;
//     document.getElementById("edit_libro_año").value = libro.año;
//     document.getElementById("edit_libro_genero").value = libro.genero;
//     document.getElementById("edit_libro_precio").value = libro.precio;
//     document.getElementById("edit_libro_cantidad").value = libro.cantidad;
//     document.getElementById("edit_libro_idioma").value = libro.idioma;
//     document.getElementById("edit_libro_paginas").value = libro.paginas;
//     document.getElementById("edit_libro_formato").value = libro.formato;
//     document.getElementById("modal-editar1").classList.add("is-active");
// }

// function cerrarModalEditar1() {
//     document.getElementById("modal-editar1").classList.remove("is-active");
//     document.getElementById("form-edicion1").reset();
// }

// // Función para cargar la lista de libros
// function cargarLibros() {
//     $.ajax({
//         url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
//         type: "POST",
//         data: {
//             modulo_libro: "listar",
//             pagina: 1,
//             registros: 10,
//             url: "libro",
//         },
//         success: function(response) {
//             $("#lista-libros").html(response);
//         },
//     });
// }

// // Manejador para el formulario de registro
// $("#form-registro1").on("submit", function(e) {
//     e.preventDefault();
//     $.ajax({
//         url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
//         type: "POST",
//         data: $(this).serialize(),
//         success: function(response) {
//             const resp = JSON.parse(response);
//             alert(resp.texto);
//             if (resp.tipo === "limpiar") {
//                 cerrarModalRegistro1();
//                 cargarLibros();
//             }
//         },
//     });
// });

// // Manejador para el formulario de edición
// $("#form-edicion1").on("submit", function(e) {
//     e.preventDefault();
//     $.ajax({
//         url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
//         type: "POST",
//         data: $(this).serialize(),
//         success: function(response) {
//             const resp = JSON.parse(response);
//             alert(resp.texto);
//             if (resp.tipo === "recargar") {
//                 cerrarModalEditar1();
//                 cargarLibros();
//             }
//         },
//     });
// });

// // Función para eliminar libro
// function eliminarLibro(id) {
//     if (confirm("¿Está seguro de eliminar este libro?")) {
//         $.ajax({
//             url: "<?= APP_URL ?>app/ajax/inventarioAjax.php",
//             type: "POST",
//             data: {
//                 modulo_libro: "eliminar",
//                 libro_id: id,
//             },
//             success: function(response) {
//                 const resp = JSON.parse(response);
//                 alert(resp.texto);
//                 if (resp.tipo === "recargar") {
//                     cargarLibros();
//                 }
//             },
//         });
//     }
// }

// // Cargar libros al iniciar la página
// $(document).ready(function() {
//     cargarLibros();
// }); 
</script>
<div class="container is-fluid mb-6">
    <h1 class="title">Inventario de Libros</h1>
    <h2 class="subtitle">Gestión de Inventario</h2>
</div>

<div class="container pb-6 pt-6">
    <button class="button is-primary mb-4" onclick="abrirModalRegistro1()">
        Registrar Nuevo Libro
    </button>

    <!-- Listado de Libros -->
    <div id="lista-libros" class="mt-4">
        <!-- Aquí se cargará la lista de libros -->
    </div>

    <!-- Modal de Registro -->
    <div id="modal-registro1" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Registrar Libro</p>
                <button class="delete" aria-label="close" onclick="cerrarModalRegistro1()"></button>
            </header>
            <section class="modal-card-body">
                <form id="form-registro1" method="POST">
                    <input type="hidden" name="modulo_libro" value="registrar">

                    <div class="field">
                        <label class="label">Código</label>
                        <div class="control">
                            <input class="input" type="text" name="libro_codigo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Título del Libro</label>
                        <div class="control">
                            <input class="input" type="text" name="libro_titulo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Autor</label>
                        <div class="control">
                            <input class="input" type="text" name="libro_autor" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Editorial</label>
                        <div class="control">
                            <input class="input" type="text" name="libro_editorial">
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Año de Publicación</label>
                                <div class="control">
                                    <input class="input" type="number" name="libro_año">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Género</label>
                                <div class="control">
                                    <input class="input" type="text" name="libro_genero">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Precio de Venta</label>
                                <div class="control">
                                    <input class="input" type="number" step="0.01" name="libro_precio" required>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Cantidad</label>
                                <div class="control">
                                    <input class="input" type="number" name="libro_cantidad" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Idioma</label>
                                <div class="control">
                                    <input class="input" type="text" name="libro_idioma">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Número de Páginas</label>
                                <div class="control">
                                    <input class="input" type="number" name="libro_paginas">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Formato</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="libro_formato">
                                    <option value="Tapa Dura">Tapa Dura</option>
                                    <option value="Tapa Blanda">Tapa Blanda</option>
                                    <option value="Digital">Digital</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <button type="submit" class="button is-success">Registrar Libro</button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <!-- Modal de Actualización -->
    <div id="modal-editar1" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Actualizar Libro</p>
                <button class="delete" aria-label="close" onclick="cerrarModalEditar1()"></button>
            </header>
            <section class="modal-card-body">
                <form id="form-edicion1" method="POST">
                    <input type="hidden" name="modulo_libro" value="actualizar">
                    <input type="hidden" id="libro_id" name="libro_id">

                    <div class="field">
                        <label class="label">Código</label>
                        <div class="control">
                            <input id="edit_libro_codigo" class="input" type="text" name="libro_codigo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Título del Libro</label>
                        <div class="control">
                            <input id="edit_libro_titulo" class="input" type="text" name="libro_titulo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Autor</label>
                        <div class="control">
                            <input id="edit_libro_autor" class="input" type="text" name="libro_autor" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Editorial</label>
                        <div class="control">
                            <input id="edit_libro_editorial" class="input" type="text" name="libro_editorial">
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Año de Publicación</label>
                                <div class="control">
                                    <input id="edit_libro_año" class="input" type="number" name="libro_año">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Género</label>
                                <div class="control">
                                    <input id="edit_libro_genero" class="input" type="text" name="libro_genero">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Precio de Venta</label>
                                <div class="control">
                                    <input id="edit_libro_precio" class="input" type="number" step="0.01" name="libro_precio" required>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Cantidad</label>
                                <div class="control">
                                    <input id="edit_libro_cantidad" class="input" type="number" name="libro_cantidad" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Idioma</label>
                                <div class="control">
                                    <input id="edit_libro_idioma" class="input" type="text" name="libro_idioma">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Número de Páginas</label>
                                <div class="control">
                                    <input id="edit_libro_paginas" class="input" type="number" name="libro_paginas">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Formato</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select id="edit_libro_formato" name="libro_formato">
                                    <option value="Tapa Dura">Tapa Dura</option>
                                    <option value="Tapa Blanda">Tapa Blanda</option>
                                    <option value="Digital">Digital</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <button type="submit" class="button is-success">Actualizar Libro</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
//                 cerrarModalRegistro();
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
//                 cerrarModalEditar();
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
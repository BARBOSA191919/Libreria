<div class="container">
  <div class="position-contenido">

  <div class="position-buttom">
  <button class="btn-registrar btn btn-primary mb-4" onclick="abrirModalRegistroAutor()">
        Registrar Nuevo Autor
    </button>
  </div>

  <div class="content-name">
    <div class="container-fluid mb-4">
    <h1 class="text-titulo">Autores</h1>
    <h2 class="h5 text-muted">Gestión de Autores</h2>
</div>
  </div>

  </div>

   

    <!-- Lista de Autores -->
    <div id="lista-autores" class="mt-4">
        <!-- Aquí se cargará la lista de autores -->
    </div>

    <!-- Modal de Registro -->
    <div class="modal fade" id="registroAutorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-model_title">Registrar Autor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="form-registro-autor">
                        <input type="hidden" name="modulo_autor" value="registrar">

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Código</label>
                            <input class="form-control" type="text" name="autor_codigo" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Nombre</label>
                            <input class="form-control" type="text" name="autor_nombre" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">País de Origen</label>
                            <input class="form-control" type="text" name="autor_paisorigen">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-model">Biografía</label>
                            <textarea class="form-control" name="autor_biografia" rows="4"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-model" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success text-model">Registrar Autor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Actualización -->
   <div id="modal-editar-autor" class="modal" class="modal fade" tabindex="-1" aria-labelledby="modalEditarLabel">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <header class="modal-header">
                <h5 class="modal-title fw-bold text-model_title">Actualizar Autor</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="cerrarModalEditarautor()"></button>
            </header>
            <section class="modal-card-body">
                <form id="form-edicion-autor" method="POST">
                    <input type="hidden" name="modulo_autor" value="actualizar">
                    <input type="hidden" id="autor_id" name="autor_id">

                    <div class="field">
                        <label class="label fw-semibold text-model">Código</label>
                        <input id="edit_autor_codigo" class="form-control form-control-lg text-model_input" type="text" name="autor_codigo" required>
                    </div>

                    <div class="field">
                        <label class="label fw-semibold text-model">Nombre</label>
                        <input id="edit_autor_nombre" class="form-control form-control-lg text-model_input" type="text" name="autor_nombre" required>
                    </div>

                    <div class="field">
                        <label class="label fw-semibold text-model">País de Origen</label>
                        <input id="edit_autor_paisorigen" class="form-control form-control-lg text-model_input" type="text" name="autor_paisorigen">
                    </div>

                    <div class="field">
                        <label class="label fw-semibold text-model">Biografía</label>
                        <textarea id="edit_autor_biografia" class="textarea" name="autor_biografia"></textarea>
                    </div>

                    <div class="field">
                        <button type="submit" class="btn btn-success text-model">Actualizar Autor</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
    </div>
</div>


<link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/autor.css">

<script>
    // Función para abrir el Modal de Registro de Autor
    function abrirModalRegistroAutor() {
        var modal = new bootstrap.Modal(document.getElementById('registroAutorModal'));
        modal.show();
    }

    // Función para cerrar el Modal de Registro de Autor
    function cerrarModalRegistroautor() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('registroAutorModal'));
        modal.hide();
        document.getElementById('form-registro-autor').reset();  // Limpiar formulario al cerrar
    }

    // Función para abrir el Modal de Edición de Autor
    function abrirModalEditarautor(autor) {
        document.getElementById('autor_id').value = autor.idAutor;
        document.getElementById('edit_autor_codigo').value = autor.codigo;
        document.getElementById('edit_autor_nombre').value = autor.nombre;
        document.getElementById('edit_autor_paisorigen').value = autor.paisorigen;
        document.getElementById('edit_autor_biografia').value = autor.biografia;

        var modal = new bootstrap.Modal(document.getElementById('modal-editar-autor'));
        modal.show();
    }

// Funciones para manejar modales
function cerrarModalRegistroautor() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('registroAutorModal'));
    modal.hide();
    $('#form-registro-autor')[0].reset();
}

function cerrarModalEditarautor() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('modal-editar-autor'));
    modal.hide();
    $('#form-edicion-autor')[0].reset(); // Corregido el ID del formulario
}

    // Función para cargar la lista de autores
    function cargarAutores() {
        $.ajax({
            url: '<?= APP_URL ?>app/ajax/autorAjax.php',
            type: 'POST',
            data: {
                modulo_autor: 'listar'
            },
            success: function(response) {
                $('#lista-autores').html(response);
            }
        });
    }

   // Manejador para el formulario de registro
$('#form-registro-autor').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?= APP_URL ?>app/ajax/autorAjax.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            const resp = JSON.parse(response);
            if (resp.tipo === "limpiar") {
                cerrarModalRegistroautor();
                cargarAutores(); // Primero cargamos los datos
                
                // Después mostramos el mensaje
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
                    },
                    timer: 2000,
                    timerProgressBar: true
                });
            }
        }
    });
});

// Manejador para el formulario de edición
$('#form-edicion-autor').on('submit', function(e) {
    e.preventDefault();
    const formData = $(this).serialize() + "&modulo_autor=actualizar";
    
    $.ajax({
        url: '<?= APP_URL ?>app/ajax/autorAjax.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            const resp = JSON.parse(response);
            if (resp.tipo === "recargar") {
                cerrarModalEditarautor();
                cargarAutores(); // Primero cargamos los datos
                
                // Después mostramos el mensaje
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
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar el autor. Por favor, intente nuevamente.'
            });
        }
    });
});

    // Función para eliminar un autor
    function eliminarAutor(id) {
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea eliminar este autor?",
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
                    url: '<?= APP_URL ?>app/ajax/autorAjax.php',
                    type: 'POST',
                    data: {
                        modulo_autor: 'eliminar',
                        autor_id: id
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
                                cargarAutores();  // Recargar la lista de autores
                            }
                        });
                    }
                });
            }
        });
    }

    // Cargar la lista de autores al cargar la página
    $(document).ready(function() {
        cargarAutores();
    });
</script>
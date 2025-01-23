<div class="container">
  <div class="position-contenido">

  <div class="position-buttom">
   <button class="btn btn-registrar btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#registroAutorModal">
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    // Función para cargar la lista de autores
     // Funciones para los modales
    function abrirModalRegistroautor() {
        document.getElementById('modal-registro-autor').classList.add('is-active');
    }

    function cerrarModalRegistroautor() {
        document.getElementById('modal-registro-autor').classList.remove('is-active');
        document.getElementById('form-registro-autor').reset();
    }

    function abrirModalEditarautor(autor) {
        document.getElementById('autor_id').value = autor.idAutor;
        document.getElementById('edit_autor_codigo').value = autor.codigo;
        document.getElementById('edit_autor_nombre').value = autor.nombre;
        document.getElementById('edit_autor_paisorigen').value = autor.paisorigen;
        document.getElementById('edit_autor_biografia').value = autor.biografia;
        document.getElementById('modal-editar-autor').classList.add('is-active');
    }

    function cerrarModalEditarautor() {
        document.getElementById('modal-editar-autor').classList.remove('is-active');
        document.getElementById('form-edicion').reset();
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
                alert(resp.texto);
                if(resp.tipo === 'limpiar') {
                    cerrarModalRegistroautor();
                    cargarAutores();
                }
            }
        });
    });

    // Manejador para el formulario de edición
    $('#form-edicion-autor').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= APP_URL ?>app/ajax/autorAjax.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const resp = JSON.parse(response);
                alert(resp.texto);
                if(resp.tipo === 'recargar') {
                    cerrarModalEditarautor();
                    cargarAutores();
                }
            }
        });
    });

    // Función para eliminar autor
    function eliminarAutor(id) {
        if(confirm('¿Está seguro de eliminar este autor?')) {
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/autorAjax.php',
                type: 'POST',
                data: {
                    modulo_autor: 'eliminar',
                    autor_id: id
                },
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'recargar') {
                        cargarAutores();
                    }
                }
            });
        }
    }

    // Cargar autores al iniciar la página
    $(document).ready(function() {
        cargarAutores();
    });
</script>
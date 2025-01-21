<div class="container is-fluid mb-6">
    <h1 class="title">Autores</h1>
    <h2 class="subtitle">Gestión de Autores</h2>
</div>

<div class="container pb-6 pt-6">
    <button class="button is-primary mb-4" onclick="abrirModalRegistroautor()">
        Registrar Nuevo Autor
    </button>

    <!-- Listado de Autores -->
    <div id="lista-autores" class="mt-4">
        <!-- Aquí se cargará la lista de autores -->
    </div>

    <!-- Modal de Registro -->
    <div id="modal-registro-autor" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Registrar Autor</p>
                <button class="delete" aria-label="close" onclick="cerrarModalRegistroautor()"></button>
            </header>
            <section class="modal-card-body">
                <form id="form-registro-autor" method="POST">
                    <input type="hidden" name="modulo_autor" value="registrar">

                    <div class="field">
                        <label class="label">Código</label>
                        <div class="control">
                            <input class="input" type="text" name="autor_codigo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                            <input class="input" type="text" name="autor_nombre" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">País de Origen</label>
                        <div class="control">
                            <input class="input" type="text" name="autor_paisorigen">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Biografía</label>
                        <div class="control">
                            <textarea class="textarea" name="autor_biografia"></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <button type="submit" class="button is-success">Registrar Autor</button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <!-- Modal de Actualización -->
    <div id="modal-editar-autor" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Actualizar Autor</p>
                <button class="delete" aria-label="close" onclick="cerrarModalEditarautor()"></button>
            </header>
            <section class="modal-card-body">
                <form id="form-edicion-autor" method="POST">
                    <input type="hidden" name="modulo_autor" value="actualizar">
                    <input type="hidden" id="autor_id" name="autor_id">

                    <div class="field">
                        <label class="label">Código</label>
                        <div class="control">
                            <input id="edit_autor_codigo" class="input" type="text" name="autor_codigo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                            <input id="edit_autor_nombre" class="input" type="text" name="autor_nombre" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">País de Origen</label>
                        <div class="control">
                            <input id="edit_autor_paisorigen" class="input" type="text" name="autor_paisorigen">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Biografía</label>
                        <div class="control">
                            <textarea id="edit_autor_biografia" class="textarea" name="autor_biografia"></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <button type="submit" class="button is-success">Actualizar Autor</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
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
        document.getElementById('modal-editar').classList.add('is-active');
    }

    function cerrarModalEditarautor() {
        document.getElementById('modal-editar').classList.remove('is-active');
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
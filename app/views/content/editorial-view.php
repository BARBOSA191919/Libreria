<div class="container is-fluid mb-6">
    <h1 class="title">Editoriales</h1>
    <h2 class="subtitle">Gestión de Editoriales</h2>
</div>

<div class="container pb-6 pt-6">
    <button class="button is-primary mb-4" onclick="abrirModalRegistroeditorial()">
        Registrar Nueva Editorial
    </button>

    <!-- Listado de Editoriales -->
    <div id="lista-editoriales" class="mt-4">
        <!-- Aquí se cargará la lista de editoriales -->
    </div>

    <!-- Modal de Registro -->
    <div id="modal-registro-editorial" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Registrar Editorial</p>
                <button class="delete" aria-label="close" onclick="cerrarModalRegistroeditorial()"></button>
            </header>
            <section class="modal-card-body">
                <form id="form-registro-editorial" method="POST">
                    <input type="hidden" name="modulo_editorial" value="registrar">

                    <div class="field">
                        <label class="label">Código</label>
                        <div class="control">
                            <input class="input" type="text" name="editorial_codigo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                            <input class="input" type="text" name="editorial_nombre" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">País</label>
                        <div class="control">
                            <input class="input" type="text" name="editorial_pais">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Información de Contacto</label>
                        <div class="control">
                            <textarea class="textarea" name="editorial_informacioncontacto"></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <button type="submit" class="button is-success">Registrar Editorial</button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <!-- Modal de Actualización -->
    <div id="modal-editar-editorial" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Actualizar Editorial</p>
                <button class="delete" aria-label="close" onclick="cerrarModalEditareditorial()"></button>
            </header>
            <section class="modal-card-body">
                <form id="form-edicion-editorial" method="POST">
                    <input type="hidden" name="modulo_editorial" value="actualizar">
                    <input type="hidden" id="editorial_id" name="editorial_id">

                    <div class="field">
                        <label class="label">Código</label>
                        <div class="control">
                            <input id="edit_editorial_codigo" class="input" type="text" name="editorial_codigo" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                            <input id="edit_editorial_nombre" class="input" type="text" name="editorial_nombre" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">País</label>
                        <div class="control">
                            <input id="edit_editorial_pais" class="input" type="text" name="editorial_pais">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Información de Contacto</label>
                        <div class="control">
                            <textarea id="edit_editorial_informacioncontacto" class="textarea" name="editorial_informacioncontacto"></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <button type="submit" class="button is-success">Actualizar Editorial</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    // Funciones para los modales
    function abrirModalRegistroeditorial() {
        document.getElementById('modal-registro-editorial').classList.add('is-active');
    }

    function cerrarModalRegistroeditorial() {
        document.getElementById('modal-registro-editorial').classList.remove('is-active');
        document.getElementById('form-registro-editorial').reset();
    }

    function abrirModalEditar(editorial) {
        document.getElementById('editorial_id').value = editorial.idEditorial;
        document.getElementById('edit_editorial_codigo').value = editorial.codigo;
        document.getElementById('edit_editorial_nombre').value = editorial.nombre;
        document.getElementById('edit_editorial_pais').value = editorial.pais;
        document.getElementById('edit_editorial_informacioncontacto').value = editorial.informacioncontacto;
        document.getElementById('modal-editar').classList.add('is-active');
    }

    function cerrarModalEditareditorial() {
        document.getElementById('modal-editar').classList.remove('is-active');
        document.getElementById('form-edicion').reset();
    }

    // Función para cargar la lista de editoriales
    function cargarEditoriales() {
        $.ajax({
            url: '<?= APP_URL ?>app/ajax/editorialAjax.php',
            type: 'POST',
            data: {
                modulo_editorial: 'listar'
            },
            success: function(response) {
                $('#lista-editoriales').html(response);
            }
        });
    }

    // Manejador para el formulario de registro
    $('#form-registro-editorial').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= APP_URL ?>app/ajax/editorialAjax.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const resp = JSON.parse(response);
                alert(resp.texto);
                if(resp.tipo === 'limpiar') {
                    cerrarModalRegistroeditorial();
                    cargarEditoriales();
                }
            }
        });
    });

    // Manejador para el formulario de edición
    $('#form-edicion-editorial').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= APP_URL ?>app/ajax/editorialAjax.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const resp = JSON.parse(response);
                alert(resp.texto);
                if(resp.tipo === 'recargar') {
                    cerrarModalEditareditorial();
                    cargarEditoriales();
                }
            }
        });
    });

    // Función para eliminar editorial
    function eliminarEditorial(id) {
        if(confirm('¿Está seguro de eliminar esta editorial?')) {
            $.ajax({
                url: '<?= APP_URL ?>app/ajax/editorialAjax.php',
                type: 'POST',
                data: {
                    modulo_editorial: 'eliminar',
                    editorial_id: id
                },
                success: function(response) {
                    const resp = JSON.parse(response);
                    alert(resp.texto);
                    if(resp.tipo === 'recargar') {
                        cargarEditoriales();
                    }
                }
            });
        }
    }

    // Cargar editoriales al iniciar la página
    $(document).ready(function() {
        cargarEditoriales();
    });
</script>
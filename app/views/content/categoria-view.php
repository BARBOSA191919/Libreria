<div class="container">
    <h1>Categorías</h1>

    <!-- Formulario para agregar nueva categoría -->
    <form method="POST" action="<?=APP_URL?>app/ajax/categoriaAjax.php">
        <input type="hidden" name="modulo_categoria" value="registrar">
        
        <div class="field">
            <label class="label">Código</label>
            <div class="control">
                <input class="input" type="text" name="categoria_codigo" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Nombre</label>
            <div class="control">
                <input class="input" type="text" name="categoria_nombre" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Subcategoría</label>
            <div class="control">
                <input class="input" type="text" name="categoria_subcategoria" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">Registrar Categoría</button>
            </div>
        </div>
    </form>

    <!-- Tabla de Categorías -->
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Subcategoría</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?= $categoria ?>
        </tbody>
    </table>
</div>

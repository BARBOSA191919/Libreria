<div class="container">
    <h1>Clientes</h1>

    <!-- Formulario para agregar nuevo cliente -->
    <form method="POST" action="<?=APP_URL?>app/ajax/clientesAjax.php">
        <input type="hidden" name="modulo_cliente" value="registrar">
        <div class="field">
            <label class="label">Nombre</label>
            <div class="control">
                <input class="input" type="text" name="cliente_nombre" required>
            </div>
        </div>
        <div class="field">
            <label class="label">Tipo de Documento</label>
            <div class="control">
                <select name="cliente_tipo_documento" required>
                    <option value="DNI">DNI</option>
                    <option value="Pasaporte">Pasaporte</option>
                </select>
            </div>
        </div>
        <div class="field">
            <label class="label">Número de Documento</label>
            <div class="control">
                <input class="input" type="text" name="cliente_numero_documento" required>
            </div>
        </div>
        <div class="field">
            <label class="label">Teléfono</label>
            <div class="control">
                <input class="input" type="text" name="cliente_telefono" required>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">Registrar Cliente</button>
            </div>
        </div>
    </form>

    <!-- Tabla de Clientes -->
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo Documento</th>
                <th>Documento</th>
                <th>Teléfono</th>
                <th>Fecha Registro</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?= $cliente?>
        </tbody>
    </table>
</div>

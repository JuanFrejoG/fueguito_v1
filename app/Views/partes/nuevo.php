

<form action="<?= site_url('partes/guardar') ?>" method="post">
    <!-- Campo desplegable para seleccionar un profesional -->
    <select name="id_profesional" required>
        <option value="">Seleccione un Profesional</option>
        <?php foreach($empleados as $empleado): ?>
            <option value="<?= $empleado['id'] ?>"><?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Campos adicionales para otros profesionales si son necesarios -->
    <!-- ... -->

    <!-- Campo desplegable para seleccionar una localidad -->
    

    <!-- Resto de los campos del formulario -->
    <!-- ... -->

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>


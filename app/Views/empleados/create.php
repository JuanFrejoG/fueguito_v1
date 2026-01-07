<div class="container-fluid">
    <div class="dashboard-container">

<div class="container mt-5">
    <h2>Crear Nuevo Empleado</h2>
    
    <form action="<?= base_url('empleado/store') ?>" method="post">
        
        <!-- Campo Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <!-- Campo Apellido -->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>

        <!-- Campo Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!-- Campo Teléfono -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required>
        </div>

        <!-- Campo Departamento -->
        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" class="form-control" id="departamento" name="departamento" required>
        </div>
		
		<!-- Campo Vehículo -->
<div class="mb-3">
    <label for="vehiculo" class="form-label">Vehículo</label>
    <input type="text" class="form-control" id="vehiculo" name="vehiculo" required>
</div>


        <!-- Campo Fecha de Contratación -->
        <div class="mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" required>
        </div>

        <!-- Campo Activo -->
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="activo" name="activo">
            <label class="form-check-label" for="activo">Activo</label>
        </div>

        <!-- Campo Vacaciones -->
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" id="vacaciones" name="vacaciones">
            <label class="form-check-label" for="vacaciones">En vacaciones</label>
        </div>

        <!-- Botones -->
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?= base_url('empleados') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div></div></div>

<div class="container-fluid">
    <div class="dashboard-container">
		<a href="<?= base_url('empleado/create') ?>" class="btn btn-primary mb-3">Crear Empleado</a> <a href="<?= base_url('empleado/kpisempleados') ?>" class="btn btn-primary mb-3">KPI's conjuntos</a>

    <h2>Lista de Empleados</h2>
    <table class="table table-bordered table-striped" id="myTable">
        <thead>
            <tr>
    
    <th>Nombre</th>
    <th>Apellido</th>
    
    <th>Teléfono</th>
    <th>Departamento</th>
				<th>Vehículo</th>

    
   
    <th>Acciones</th>
</tr>

        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
                <tr>
                   
					<td><?= $empleado['nombre'] ?></td>
					<td><?= $empleado['apellido'] ?></td>
					
					<td><?= $empleado['telefono'] ?></td>
					<td><?= $empleado['departamento'] ?></td>
					<td><?= $empleado['vehiculo'] ?></td>
					
					
					
<td>
    <a href="<?= base_url('empleado/edit/' . $empleado['id']) ?>" class="btn btn-warning btn-sm">
    <i class="fas fa-edit"></i> <!-- Icono de editar -->
</a>
<a href="<?= base_url('empleado/kpis/' . $empleado['id']) ?>" class="btn btn-info btn-sm">
    <i class="fas fa-chart-line"></i> <!-- Icono para KPI's -->
</a>
<a href="<?= base_url('empleado/delete/' . $empleado['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar?')">
    <i class="fas fa-trash-alt"></i> <!-- Icono de eliminar -->
</a>

</td>

                       
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	</div>
</div>

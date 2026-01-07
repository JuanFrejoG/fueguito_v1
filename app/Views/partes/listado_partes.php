<div class="container-fluid">
    <div class="dashboard-container">
		<a href="<?= base_url('partes/nuevo') ?>" class="btn btn-primary mb-3">Nuevo parte</a>

    <h2>Lista de Partes</h2>
<div class="container mt-4">
    <!-- Mensaje de éxito -->
    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>

    <!-- Mensajes de error -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Contenido del formulario aquí -->
</div>

	

<div class="container mt-4">
    <div class="row">
        <!-- Fila para los filtros -->
        <div class="col-lg-12">
           <form action="<?= site_url('partes') ?>" method="get" id="formFiltraPartes">
    <div class="row">
        <!-- Columna para el filtro por profesional -->
        <div class="col-md-4 mb-3">
            <label for="professionalSelect" class="form-label">Filtrar por Profesional</label>
            <select class="form-select" name="professional_id" id="professionalSelect">
                <option value="">Seleccione un Profesional</option>
                <?php foreach ($empleados as $empleado): ?>
                    <option value="<?= esc($empleado['id']) ?>" <?= (isset($_GET['professional_id']) && $empleado['id'] == $_GET['professional_id']) ? 'selected' : '' ?>>
                        <?= esc($empleado['nombre']) . ' ' . esc($empleado['apellido']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Columna para el campo de búsqueda -->
        <div class="col-md-4 mb-3">
            <label for="search" class="form-label">Buscar</label>
            <input type="text" class="form-control" name="search" id="search" value="<?= $search ?? '' ?>" placeholder="Buscar por expediente, teléfono o dirección">
        </div>
        <!-- Columna para el filtro por fecha de inicio -->
        <div class="col-md-2 mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?= $fechaInicio;?>">
        </div>
        <!-- Columna para el filtro por fecha de fin -->
        <div class="col-md-2 mb-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?= $fechaFin;?>">
        </div>
    </div>
    <!-- Botón de filtrado -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</form>
<!-- Botón para filtrar por el mes anterior -->
<div class="mb-3">
    <button type="button" id="filterLastMonthBtn" class="btn btn-secondary">Mes Anterior</button>  <button type="button" id="filterMonthBtn" class="btn btn-secondary">Mes actual</button>
</div>

        </div>
    </div>
</div>




   <table id="myTable" class="display compact stripe" style="background-color: #ffffff" data-order='[[ 1, "desc" ]]' data-page-length='25'>
    <thead>
        <tr>
            <th>ID</th>
			<th>Fecha del Parte</th>            
            <th>Expediente</th>
			<th>Tipo</th>
            <th>Datos cliente</th>
            <th>Importe</th>
            <th>Profesional</th>
            <th>Descripción del Trabajo</th>
			<th>Estado</th>
            <th>Acciones</th>
		<!--	<th>Debug</th>-->
        </tr>
    </thead>
    <tbody>
        <?php 
	
	$tipo_map = [
    0 => "Siniestro",
    1 => "Bricolaje",
    2 => "Asistencia"
];
	/*echo "<pre>";				   
	print_r($partes);
	echo "</pre>";
	die();*/
	foreach ($partes as $parte): ?>
		
        <tr>
			<td><?= $parte['id'] ?></td>
            <td><?= $parte['fecha_parte'] ?></td>
           
            <td><a href="<?= site_url('partes/mostrar/' . $parte['id']) ?>"><?= $parte['numero_de_expediente'] ?></a></td>
			<td><?php echo $tipo_map[$parte['tipo']] ?? 'Tipo no definido'; ?></td>
            <td><?php if($parte['nombre']!=""){ echo $parte['nombre']."<br>"; };?><?= $parte['direccion'] ?><br><?= $parte['localidad_nombre'] ?? 'N/A' ?><br><?= $parte['telefono'] ?></td>
            <td><?= $parte['importe'] ?>€</td>            
            <td><?= $parte['empleado_nombre'] . ' ' . $parte['empleado_apellido'] ?>
			
			<?php if (!empty($parte['empleado2_nombre'])): ?>
				<br><?= esc($parte['empleado2_nombre']) . ' ' . esc($parte['empleado2_apellido']) ?>
			<?php endif; ?>
			<?php if (!empty($parte['empleado3_nombre'])): ?>
				<br><?= esc($parte['empleado3_nombre']) . ' ' . esc($parte['empleado3_apellido']) ?>
			<?php endif; ?>
			<?php if (!empty($parte['empleado4_nombre'])): ?>
				<br><?= esc($parte['empleado4_nombre']) . ' ' . esc($parte['empleado4_apellido']) ?>
			<?php endif; ?>
			<?php if (!empty($parte['empleado5_nombre'])): ?>
				<br><?= esc($parte['empleado5_nombre']) . ' ' . esc($parte['empleado5_apellido']) ?>
			<?php endif; ?>

			
			</td>
            <td><?= $parte['descripcion_del_trabajo'] ?></td>
			<td><?= $parte['estado'] == 0 ? 'Activo' : 'Cerrado' ?></td>
<script type="text/javascript">
function confirmDelete(e, parteId) {
    e.preventDefault(); // Prevent the default button behavior
    
    var confirmed = confirm("¿Estás seguro de que quieres borrar este parte?");
    if (confirmed) {
        // Si el usuario confirma, redirigir para eliminar el parte
        window.location.href = '/partes/eliminar/' + parteId;
    }
}
</script>

            <td>
                <a href="<?= site_url('partes/editar/' . $parte['id']) ?>" class="btn btn-primary btn-sm">
    <i class="fas fa-edit"></i> <!-- Icono de editar -->
</a>
<button onclick="confirmDelete(event, <?= $parte['id'] ?>)" class="btn btn-danger btn-sm">
    <i class="fas fa-trash-alt"></i> <!-- Icono de eliminar -->
</button>


            </td>
			<!--<td><?php print_r($parte);?></td>-->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>







	</div>
	</div>
</div>
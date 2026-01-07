<!-- app/Views/empleados/listado_kpis.php -->
<div class="container-fluid">
  <div class="dashboard-container">
	 <pre> <?php // print_r($kpisPorEmpleado); die();?></pre>
	  <div class="row">
		  <div class="col-md-6">
<form action="<?= site_url('empleado/kpisempleados/');?>" method="get">
    <div class="row">
        <!-- Columna para 'Desde' -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="desde">Desde:</label>
                <input type="date" id="desde" name="desde" class="form-control" value="<?= esc($kpisPorEmpleado['desde']->format('Y-m-d'));?>">
            </div>
        </div>
        <!-- Columna para 'Hasta' -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="hasta">Hasta:</label>
                <input type="date" id="hasta" name="hasta" class="form-control" value="<?= esc($kpisPorEmpleado['hasta']->format('Y-m-d'));?>">
            </div>
        </div>
    </div>
	<br>
    <button type="submit" class="btn btn-primary">Filtrar</button>
	
</form>
		  </div>	  </div>
 <table class="table display compact stripe" id="myTable" data-order='[[ 1, "desc" ]]' data-page-length='25'>
        <thead>
            <tr>
               <th>Activo</th>
				<th>Empleado</th>
                <th>Total Partes Asignados</th>
				<th>Siniestros</th>
				<th>Bricolaje</th>
				<th>Siniestros</th>
                <th>Importe Facturado</th>				
                <th>Partes con Foto</th>
                <th>Detalles de Limpieza</th>
                <th>Ofrece Asistencia</th>
                <th>Reclamaciones</th>
                <th>Felicitaciones</th>
				
                <!-- Añade más columnas si son necesarias -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kpisPorEmpleado['empleado'] as $idEmpleado => $kpis): ?>
                <tr>
                    <td><?= $kpis['activo'] == 1 ? 'Sí' : 'No' ?></td>
					<td><?= esc($kpis['nombreCompleto']) ?></td>
                    <td><?= esc($kpis['totalPartesAsignados']) ?></td>
					<td><?= esc($kpis['partesPorTipo']['Siniestro']['cantidad'])?><br><?= esc(number_format($kpis['partesPorTipo']['Siniestro']['sumaImporte'], 2, ',', ''))?>€
					
					</td>	
					<td><?= esc($kpis['partesPorTipo']['Bricolaje']['cantidad'])?><br><?= esc(number_format($kpis['partesPorTipo']['Bricolaje']['sumaImporte'], 2, ',', ''))?>€
					
					</td>	
					<td><?= esc($kpis['partesPorTipo']['Asistencia']['cantidad'])?><br><?= esc(number_format($kpis['partesPorTipo']['Asistencia']['sumaImporte'], 2, ',', ''))?>€
					
					</td>	
                    <td><?= esc(number_format($kpis['sumaImportes'], 2, ',', '')) ?> €</td>
                    <td>
                        <?= esc($kpis['partesConFotos']) ?> / <?= esc($kpis['totalPartesAsignados']) ?>
                        <br>
                        <?= esc(number_format(($kpis['totalPartesAsignados'] > 0 ? ($kpis['partesConFotos'] / $kpis['totalPartesAsignados']) * 100 : 0), 2)) ?> %
                    </td>
                    <td>
                        <?= esc($kpis['partesConLimpiezaRealizada']) ?> / <?= esc($kpis['partesConLimpiezaObligatoria']) ?>
                        <br>
                        <?= esc(number_format(($kpis['partesConLimpiezaObligatoria'] > 0 ? ($kpis['partesConLimpiezaRealizada'] / $kpis['partesConLimpiezaObligatoria']) * 100 : 0), 2)) ?> %
                    </td>
					
					
					
					
					
					
					
					
                    <td>
                        <?= esc($kpis['ofreceAsistencia']) ?> / <?= esc($kpis['totalPartesAsignados']) ?>
                        <br>
                        <?= esc(number_format(($kpis['totalPartesAsignados'] > 0 ? ($kpis['ofreceAsistencia'] / $kpis['totalPartesAsignados']) * 100 : 0), 2)) ?> %
                    </td>
                    <td>
                        <?= esc($kpis['conteoReclamaciones']) ?>
                        <br>
                        <?= esc(number_format($kpis['sumaReclamaciones'], 2, ',', '')) ?> €
                        <br>
                        <?= esc(number_format(($kpis['totalPartesAsignados'] > 0 ? ($kpis['conteoReclamaciones'] / $kpis['totalPartesAsignados']) * 100 : 0), 2)) ?> %
                    </td>
                    <td>
                        <?= esc($kpis['felicitaciones']) ?> / <?= esc($kpis['totalPartesAsignados']) ?>
                        <br>
                        <?= esc(number_format(($kpis['totalPartesAsignados'] > 0 ? ($kpis['felicitaciones'] / $kpis['totalPartesAsignados']) * 100 : 0), 2)) ?> %
                    </td>
                    <!-- Añade más celdas si son necesarias -->
                </tr>
			
					
            <?php endforeach; ?>
        </tbody>
    </table>
	</div>
</div>
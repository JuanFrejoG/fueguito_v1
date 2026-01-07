

<div class="container-fluid">
  <div class="dashboard-container">
	   <h1>KPIs de
      <?= esc($nombre) . ' ' . esc($apellido) ?></h1>
<form action="<?= site_url('empleado/kpis/' . esc($idEmpleado)) ?>" method="get">
    <div class="row">
        <!-- Columna para 'Desde' -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="desde">Desde:</label>
                <input type="date" id="desde" name="desde" class="form-control" value="<?= esc($desde->format('Y-m-d'));?>">
            </div>
        </div>
        <!-- Columna para 'Hasta' -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="hasta">Hasta:</label>
                <input type="date" id="hasta" name="hasta" class="form-control" value="<?= esc($hasta->format('Y-m-d'));?>">
            </div>
        </div>
    </div>
	<br>
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>

   
     
     <div class="container mt-4">
  <div class="row">
    <!-- KPI 1 -->
<div class="col-md-3 mb-4">
    <div class="card h-100 kpi-card">
        <div class="card-body">
            <div class="kpi-icon">
                <i class="fas fa-list-alt"></i>
            </div>
            <h5 class="card-title">Total Partes Asignados</h5>
            <p class="card-text"><?= esc($totalPartesAsignados) ?></p>
        </div>
    </div>
</div>


  <!-- KPI 2 -->
<div class="col-md-3 mb-4">
    <div class="card h-100 kpi-card kpi-card-importe">
        <div class="card-body">
            <div class="kpi-icon">
                <i class="fas fa-euro-sign"></i> <!-- Icono de euro, puedes cambiarlo según sea necesario -->
            </div>
            <h5 class="card-title">Importe Facturado</h5>
            <p class="card-text"><?= esc(number_format($sumaImportes, 2, ',', '')) ?> €</p>
        </div>
    </div>
</div>

<?php
// Asegúrate de que $totalPartesAsignados no sea cero para evitar división por cero.
$porcentajeConFoto = $totalPartesAsignados > 0 ? ($partesConFotos / $totalPartesAsignados) * 100 : 0;
?>

<div class="col-md-3 mb-4">
    <div class="card h-100 kpi-card kpi-card-conFoto">
        <div class="card-body">
            <div class="kpi-icon">
                <i class="fas fa-camera"></i> <!-- Icono de cámara, cambia según necesites -->
            </div>
            <h5 class="card-title">Partes con foto</h5>
            <!-- Muestra el número de partes con foto -->
            <p class="card-text"><?= esc($partesConFotos) ?> / <?= esc($totalPartesAsignados) ?></p>
            <!-- Muestra el porcentaje de partes con foto -->
            <p class="card-text" style="font-size: 0.9em"><?= esc(number_format($porcentajeConFoto, 2)) ?> %</p>
        </div>
    </div>
</div>


	<div class="col-md-3 mb-4">
    <div class="card h-100 kpi-card kpi-card-detallesLimpieza">
        <div class="card-body">
            <div class="kpi-icon">
                <i class="fas fa-broom"></i> <!-- Icono de limpieza, cámbialo según necesites -->
            </div>
            <h5 class="card-title">Detalles de Limpieza</h5>
            <p class="card-text"><?= esc($limpiezaRealizada) ?> / <?= esc($limpiezaObligatoria) ?> </p>
            
            <p class="card-text" style="font-size: 0.9em"><?= esc(number_format($porcentajeLimpiezaCorrecta, 2)) ?> %</p>
        </div>
    </div>
</div>

</div>
<div class="row">
  <?php foreach($partesPorTipo as $tipo => $datos): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100 kpi-card kpi-card-tipo">
            <div class="card-body">
                <!-- Icono representativo por tipo -->
                <div class="kpi-icon">
                    <?php if($tipo == 'Siniestro'): ?>
                        <i class="fas fa-home"></i> <!-- Icono para Siniestro -->
                    <?php elseif($tipo == 'Bricolaje'): ?>
                        <i class="fas fa-hammer"></i> <!-- Icono para Bricolaje -->
                    <?php elseif($tipo == 'Asistencia'): ?>
                        <i class="fas fa-hands-helping"></i> <!-- Icono para Asistencia -->
                    <?php endif; ?>
                </div>
                <h5 class="card-title"><?= esc($tipo) ?></h5>
                <p class="card-text"><?= esc($datos['cantidad']) ?> partes</p>
                <p class="card-text"><?= esc(number_format($datos['sumaImporte'], 2, '.', '')) ?> €</p>
            </div>
        </div>
    </div>
  <?php endforeach; ?>
</div>

    <!-- Aquí irían los otros KPIs... -->
  
<div class="row">
    <!-- KPI para Ofrece Asistencia -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 kpi-card kpi-card-ofrece">
            <div class="card-body">
                <div class="kpi-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h5 class="card-title">Ofrece Asistencia</h5>
                <p class="card-text"><?= esc($ofreceAsistencia) ?> / <?= esc($totalPartesAsignados) ?></p>
                <?php if ($totalPartesAsignados > 0): ?>
    <p class="card-text" style="font-size: 0.9em">
        <?= esc(number_format(($ofreceAsistencia / $totalPartesAsignados) * 100, 2)) ?> %
    </p>
<?php else: ?>
    <p class="card-text" style="font-size: 0.9em">0 %</p>
<?php endif; ?>

            </div>
        </div>
    </div>

    <!-- KPI para Reclamaciones -->
 <div class="col-md-4 mb-4">
    <div class="card h-100 kpi-card kpi-card-reclama">
        <div class="card-body">
            <div class="kpi-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h5 class="card-title">Reclamaciones</h5>
            <!-- Asegúrate de acceder a las claves correctas del arreglo -->
            <p class="card-text">
                <?= esc($reclamacion['conteoReclamaciones']) ?>
            </p>
            <p class="card-text">
                 <?= esc(number_format($reclamacion['sumaReclamaciones'], 2, '.', '')) ?> €
            </p>
            <?php if ($totalPartesAsignados > 0 && $reclamacion['conteoReclamaciones'] > 0): ?>
                <p class="card-text" style="font-size: 0.9em">
                    <?= esc(number_format(($reclamacion['conteoReclamaciones'] / $totalPartesAsignados) * 100, 2)) ?> %
                </p>
            <?php else: ?>
                <p class="card-text" style="font-size: 0.9em">0 %</p>
            <?php endif; ?>
        </div>
    </div>
</div>



    <!-- KPI para Felicitaciones -->
    <div class="col-md-4 mb-4">
        <div class="card h-100 kpi-card kpi-card-felicitacion">
            <div class="card-body">
                <div class="kpi-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h5 class="card-title">Felicitaciones</h5>
                <p class="card-text"><?= esc($felicitacion) ?> / <?= esc($totalPartesAsignados) ?></p>
                <?php if ($totalPartesAsignados > 0): ?>
    <p class="card-text" style="font-size: 0.9em">
        <?= esc(number_format(($felicitacion / $totalPartesAsignados) * 100, 2)) ?> %
    </p>
<?php else: ?>
    <p class="card-text" style="font-size: 0.9em">0 %</p>
<?php endif; ?>

            </div>
        </div>
    </div>
</div>


      <a href="<?= base_url('empleado/') ?>" class="btn btn-primary mb-3">Volver</a> 
  </div>
</div>

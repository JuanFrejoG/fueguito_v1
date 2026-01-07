<div class="container-fluid">
  <div class="dashboard-container">
    <div class="container mt-4">
      <h2>Detalle Parte</h2>
      <form action="<?= site_url('partes/guardar') ?>" method="post">
        <div class="row"> 
          <!-- Columna izquierda -->
          <div class="col-md-4">
            <div class="mb-3">
              <label for="numero_de_expediente" class="form-label">Número de Expediente <sup style="font-size: 20px;color:#990000;top: -2px;">*</sup></label>
              <input type="text" class="form-control" id="numero_de_expediente" name="numero_de_expediente" value="<?=$parte['numero_de_expediente'];?>" disabled>
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" disabled value="<?=$parte['nombre'];?>">
            </div>
            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="telefono" name="telefono" disabled value="<?=$parte['telefono'];?>">
            </div>
            <div class="mb-3">
              <label for="direccion" class="form-label">Dirección <sup style="font-size: 20px;color:#990000;top: -2px;">*</sup></label>
              <input type="text" class="form-control" id="direccion" name="direccion" disabled value="<?=$parte['direccion'];?>">
            </div>
            <div class="mb-3">
    <label for="localidad" class="form-label">Localidad</label>
    <select class="form-select" id="localidad" name="localidad" disabled>
        <!-- Asumimos que partes['localidad'] contiene el ID de la localidad seleccionada -->
        <?php foreach($localidades as $localidad): ?>
            <option value="<?= $localidad['id'] ?>" <?= ($localidad['id'] == $parte['localidad']) ? 'selected' : '' ?>>
                <?= $localidad['nombre'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

            <div class="mb-3">
              <label for="cp" class="form-label">Código Postal</label>
              <input type="text" class="form-control" id="cp" name="cp" disabled value="<?=$parte['cp'];?>">
            </div>
			<?php
			// Obtiene la fecha actual en el formato correcto para un input de tipo date
			$fechaActual = date('Y-m-d');
			?>

			<div class="mb-3">
				<label for="fecha_parte" class="form-label">Fecha del Parte</label>
				<sup style="font-size: 20px;color:#990000;top: -2px;">*</sup>
				<!-- Inserta la fecha actual como valor por defecto -->
				<input type="date" class="form-control" id="fecha_parte" name="fecha_parte" value="<?=$parte['fecha_parte'];?>" disabled>
			</div>

            <div class="mb-3">
              <label for="tipo" class="form-label">Tipo</label>
              <select class="form-select" id="tipo" name="tipo" disabled>
                <option value="0" <?= ($parte['tipo'] ==0) ? 'selected' : '' ?>>Siniestro</option>
                <option value="1" <?= ($parte['tipo'] ==1) ? 'selected' : '' ?>>Bricolaje</option>
                <option value="2" <?= ($parte['tipo'] ==2) ? 'selected' : '' ?>>Asistencia</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="importe" class="form-label">Importe</label>
              <sup style="font-size: 20px;color:#990000;top: -2px;">*</sup>
              <input type="number" class="form-control" id="importe" name="importe" step="0.01" disabled value="<?=$parte['importe'];?>">
            </div>
            <div class="mb-3">
              <label for="estado" class="form-label">Estado</label>
              <select class="form-select" id="estado" name="estado" disabled>
                <option value="0" <?= ($parte['estado'] ==0) ? 'selected' : '' ?>>Abierto</option>
                <option value="1" <?= ($parte['estado'] ==1) ? 'selected' : '' ?>>Cerrado</option>
              </select>
            </div>
          </div>
          <!-- Columna derecha -->
          <div class="col-md-8">
            <div class="mb-3">
              <label for="id_profesional" class="form-label">Profesional Asignado</label>
              <sup style="font-size: 20px;color:#990000;top: -2px;">*</sup>
              <select class="form-select" id="id_profesional" name="id_profesional" disabled>
    <option value="">Seleccione un Empleado</option>
    <?php foreach($empleados as $empleado): ?>
        <option value="<?= $empleado['id'] ?>" <?= ($empleado['id'] == $parte['id_profesional']) ? 'selected' : '' ?>>
            <?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?>
        </option>
    <?php endforeach; ?>
</select>

            </div>
            <div class="mb-3">
              <label for="id_profesional2" class="form-label">Segundo Profesional Asignado</label>
              <select class="form-select" id="id_profesional2" name="id_profesional2" disabled>
                <option value="">Seleccione un Empleado</option>
                <?php foreach($empleados as $empleado): ?>
                <option value="<?= $empleado['id'] ?>" <?= ($empleado['id'] == $parte['id_profesional2']) ? 'selected' : '' ?>>
                <?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?> 
                </option>
                <?php endforeach; ?>
              </select>
              <div class="mb-3">
                <label for="id_profesional" class="form-label">Tercer Profesional Asignado</label>
                <select class="form-select" id="id_profesional3" name="id_profesional3" disabled>
                  <option value="">Seleccione un Empleado</option>
                  <?php foreach($empleados as $empleado): ?>
                  <option value="<?= $empleado['id'] ?>" <?= ($empleado['id'] == $parte['id_profesional3']) ? 'selected' : '' ?>>
                  <?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="id_profesional" class="form-label">Cuarto Profesional Asignado</label>
                <select class="form-select" id="id_profesional4" name="id_profesional4" disabled>
                  <option value="">Seleccione un Empleado</option>
                  <?php foreach($empleados as $empleado): ?>
                  <option value="<?= $empleado['id'] ?>" <?= ($empleado['id'] == $parte['id_profesional4']) ? 'selected' : '' ?>>
                  <?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="id_profesional" class="form-label">Quinto Profesional Asignado</label>
                <select class="form-select" id="id_profesional5" name="id_profesional5" disabled>
                  <option value="">Seleccione un Empleado</option>
                  <?php foreach($empleados as $empleado): ?>
                  <option value="<?= $empleado['id'] ?>" <?= ($empleado['id'] == $parte['id_profesional5']) ? 'selected' : '' ?>>
                  <?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <!-- Repetir para id_profesional3, id_profesional4, id_profesional5 --> 
            
            <!-- Campo para empleado_comision -->
            <div class="mb-3">
              <label for="empleado_comision" class="form-label">Empleado Comisión</label>
              <select class="form-select" id="empleado_comision" name="empleado_comision" disabled>
                <option value="">Seleccione un Empleado</option>
                <?php foreach($empleados as $empleado): ?>
                <option value="<?= $empleado['id'] ?>" <?= ($empleado['id'] == $parte['empleado_comision']) ? 'selected' : '' ?>>
                <?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            
            <!-- Campo para fecha_parte -->
           
            <div class="mb-3">
              <label for="abre_nueva_asistencia" class="form-label">Abre siguiente profesional</label>
              <select class="form-select" id="abre_nueva_asistencia" name="abre_nueva_asistencia" disabled>
                <option value="No se abre otra sistencia" <?= ($parte['abre_nueva_asistencia'] == "No se abre otra sistencia") ? 'selected' : '' ?>>Seleccione una opción</option>
                <option value="Por profesional" <?= ($parte['abre_nueva_asistencia'] == "Por profesional") ? 'selected' : '' ?>>Por profesional</option>
                <option value="Por oficina" <?= ($parte['abre_nueva_asistencia'] == "Por oficina") ? 'selected' : '' ?>>Por oficina</option>
                <option value="Por cliente" <?= ($parte['abre_nueva_asistencia'] == "Por cliente") ? 'selected' : '' ?>>Por cliente</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="descripcion_del_trabajo" class="form-label">Descripción del Trabajo</label>
              <textarea class="form-control" id="descripcion_del_trabajo" name="descripcion_del_trabajo" rows="3" disabled ><?=$parte['descripcion_del_trabajo'];?></textarea>
            </div>
            <!-- Campo para codigos -->
            <div class="mb-3">
              <label for="codigos" class="form-label">Códigos</label>
              <input type="text" class="form-control" id="codigos" name="codigos" disabled value="<?=$parte['codigos'];?>">
            </div>
            
            <!-- Campo para interviene_taller -->
            <div class="container">
              <div class="row"> 
                <!-- Columna izquierda -->
                <div class="col-md-6">
                  <div class="mb-3 d-flex align-items-center">
    <label for="interviene_taller" class="form-label mb-0 me-2">Interviene Taller</label>
    <div class="form-switch">
        <input type="checkbox" class="form-check-input" id="interviene_taller" name="interviene_taller" <?= $parte['interviene_taller'] ? 'checked' : ''; ?> disabled>
    </div>
</div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="ofrece_asistencia" class="form-label mb-0 me-2">Ofrece Asistencia</label>
                    <div class="form-switch">
                      <input type="checkbox" class="form-check-input" id="ofrece_asistencia" name="ofrece_asistencia" <?= $parte['ofrece_asistencia'] ? 'checked' : ''; ?> disabled>
                    </div>
                  </div>
                  <div class="mb-3 d-flex align-items-center">
                    <label for="felicitacion" class="form-label mb-0 me-2">Felicitación</label>
                    <div class="form-switch">
                      <input type="checkbox" class="form-check-input" id="felicitacion" name="felicitacion" <?= $parte['felicitacion'] ? 'checked' : ''; ?> disabled>
                    </div>
                  </div>
                </div>
                <!-- Columna derecha -->
                <div class="col-md-6">
                  <div class="mb-3 d-flex align-items-center">
                    <label for="ha_realizado_fotos" class="form-label mb-0 me-2">Ha realizado fotos</label>
                    <div class="form-switch">
                      <input type="checkbox" class="form-check-input" id="ha_realizado_fotos" name="ha_realizado_fotos" <?= $parte['ha_realizado_fotos'] ? 'checked' : ''; ?> disabled>
                    </div>
                  </div>
                  <div class="mb-3 d-flex align-items-center">
                    <label for="hay_que_limpiar" class="form-label mb-0 me-2">Hay que limpiar</label>
                    <div class="form-switch">
                      <input type="checkbox" class="form-check-input" id="hay_que_limpiar" name="hay_que_limpiar" <?= $parte['hay_que_limpiar'] ? 'checked' : ''; ?> disabled>
                    </div>
                  </div>
                  <div class="mb-3 d-flex align-items-center">
                    <label for="ha_limpiado" class="form-label mb-0 me-2">Ha limpiado</label>
                    <div class="form-switch">
                      <input type="checkbox" class="form-check-input" id="ha_limpiado" name="ha_limpiado" <?= $parte['ha_limpiado'] ? 'checked' : ''; ?> disabled>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Campo para reclamacion -->
            <div class="mb-3">
              <label for="reclamacion" class="form-label">Reclamación</label>
              <input type="text" class="form-control" id="reclamacion" name="reclamacion" value="<?=$parte['reclamacion'];?>" disabled>
            </div>
            <div class="mb-3">
              <label for="observaciones" class="form-label">Observaciones</label>
              <textarea class="form-control" id="observaciones" name="observaciones" rows="3" disabled><?=$parte['observaciones'];?></textarea>
            </div>
            <div class="d-grid gap-2">
              <a href="<?= base_url('partes') ?>" class="btn btn-primary">Volver</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

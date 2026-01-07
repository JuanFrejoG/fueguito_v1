<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url('public/css/custom.css') ?>">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.jqueryui.min.css">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  </head>
  <body>
	  <?php
// Comprueba si la sesión 'logged_in' no está establecida y si no está en la página de inicio
if (!session()->get('logged_in') && basename($_SERVER['PHP_SELF']) != 'index.php') {
    // Redirecciona a la página de inicio
    header('Location: '.base_url());
    exit; // Asegúrate de llamar a exit después de una redirección
}
?>
	  
<?php if (session()->get('logged_in')): ?> <!-- Verificación del inicio de sesión -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url('public/images/logo.png') ?>" alt="FJParrado" class="img-fluid" style="max-height: 30px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('empleado') ?>">Empleados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('partes') ?>">Partes</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('cerrar-sesion') ?>">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>

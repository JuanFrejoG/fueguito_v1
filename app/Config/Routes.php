<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');




// Ruta para cerrar sesión.
// Suponiendo que tienes un controlador llamado 'SesionController' con un método 'index' para manejar el cierre de sesión.
$routes->get('cerrar-sesion', 'SesionController::index');

$routes->post('/login', 'Home::autenticar');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('empleado', 'Empleado::index');
$routes->get('empleado/create', 'Empleado::create');
$routes->post('empleado/store', 'Empleado::store');
$routes->get('empleado/edit/(:num)', 'Empleado::edit/$1');
$routes->post('empleado/update/(:num)', 'Empleado::update/$1');
$routes->get('empleado/delete/(:num)', 'Empleado::delete/$1');
$routes->get('partes', 'Partes::index');
$routes->get('partes/nuevo', 'Partes::nuevo'); // Para mostrar el formulario de nuevo parte
$routes->post('partes/guardar', 'Partes::guardar'); // Para procesar la creación de un nuevo parte
$routes->get('partes/mostrar/(:num)', 'Partes::mostrarParte/$1');
$routes->get('/partes/editar/(:num)', 'Partes::editarParte/$1');
$routes->post('/partes/actualizar', 'Partes::actualizarParte');
$routes->get('/partes/eliminar/(:num)', 'Partes::eliminarParte/$1');
$routes->get('empleado/kpis/(:num)', 'Empleado::kpis/$1');
$routes->get('empleado/kpisempleados', 'Empleado::listadoKPIs');
$routes->get('nuevo-usuario', 'Home::nuevoUser');



<?php

namespace App\Controllers;

class EmpleadosController extends BaseController
{
    public function index()
    {
        // Si tienes datos para enviar a las vistas
        $data = [
			"titulo"=>"Pagina de empleado"
		];

        // Cargar vistas de manera individual
        echo view('inc/header', $data);
        echo view('empleados_view', $data);
        echo view('inc/footer', $data);
    }
}



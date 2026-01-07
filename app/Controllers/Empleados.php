<?php

namespace App\Controllers;

class EmpleadosController extends BaseController
{
    public function index(): string
    {
        return view('empleados_view');
    }
	
}


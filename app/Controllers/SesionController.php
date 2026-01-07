<?php

namespace App\Controllers;

class SesionController extends BaseController
{
    public function index()
    {
        // Iniciar la biblioteca de sesión
        $session = session();

        // Destruir la sesión
        $session->destroy();

        // Redirigir al usuario a la página de inicio
        return redirect()->to(base_url());
    }
}
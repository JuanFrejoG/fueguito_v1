<?php

namespace App\Controllers;

class PartesController extends BaseController
{
    public function index()
    {
        // Variables de ejemplo para pasar a la vista
        $data = [
            'titulo' => 'Página de Partes',
            'descripcion' => 'Esta es la descripción de la página de partes.',
            // Puedes agregar más variables aquí según lo necesites
        ];

        // Cargamos las vistas de header, partes (contenido principal) y footer, 
        // y las concatenamos en ese orden.
        // También pasamos las variables a la vista 'partes'.
        $vistas = view('inc/header', $data) .
                  view('partes', $data) . // Pasando el array $data a la vista
                  view('inc/footer');
        
        return $vistas;
    }
}
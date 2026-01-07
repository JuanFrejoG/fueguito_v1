<?php
namespace App\Controllers;

use App\Models\ParteModel;
use App\Models\EmpleadoModel;
use App\Models\LocalidadModel;


use CodeIgniter\Controller;

class Partes extends Controller
{
   public function index()
{
    $parteModel = new ParteModel();
    $empleadoModel = new EmpleadoModel();

    // Define the default date range for the current month
    $fechaInicio = $this->request->getVar('fecha_inicio') ?? date('Y-m-01');
    $fechaFin = $this->request->getVar('fecha_fin') ?? date('Y-m-t');

    // Get search and professional filter queries
    $search = $this->request->getVar('search');
    $profesionalId = $this->request->getVar('professional_id');

    // Get data without pagination
    $data['partes'] = $parteModel->searchPartes($search, $profesionalId, $fechaInicio, $fechaFin);

    // Get the list of professionals for the filter
    $data['empleados'] = $empleadoModel->findAllEmpleados();

    // Pass search query and date filters back to view
    $data['search'] = $search;
    $data['fechaInicio'] = $fechaInicio;
    $data['fechaFin'] = $fechaFin;

    $header_data = [
        'titulo' => 'Listado de Partes',
        'descripcion' => 'Aquí puedes ver todos los partes registrados en el sistema.'
    ];

    echo view('inc/header', $header_data);
    echo view('partes/listado_partes', $data);
    echo view('inc/footer');
}


public function nuevo()
    {
        $empleadoModel = new EmpleadoModel();
        $localidadModel = new LocalidadModel();
        
        // Obtiene solo empleados activos
        $data['empleados'] = $empleadoModel->where('activo', 1)->findAll();
        // Obtiene todas las localidades
        $data['localidades'] = $localidadModel->findAll();

        // Cargar vistas o datos necesarios para el formulario
	
	 $header_data = [
        'titulo' => 'Listado de Partes',
        'descripcion' => 'Aquí puedes ver todos los partes registrados en el sistema.'
    ];
       
		echo view('inc/header', $header_data);
    	echo view('partes/nuevo_parte', $data);
    	echo view('inc/footer');
    }
public function guardar()
    {
        $parteModel = new ParteModel();
        $data = $this->request->getPost();
/*		echo '<pre>';
var_dump($data);
echo '</pre>';
	die();*/
        // Aquí deberías validar los datos recibidos del formulario
        // ...

        try {
            // Si la validación es exitosa, inserta el nuevo parte
            $id = $parteModel->insertarParte($data);
            return redirect()->to('/partes/')->with('mensaje', 'Parte creado correctamente.');
        } catch (\Exception $e) {
            // Si hay error, regresa al formulario con los errores
            return redirect()->back()->withInput()->with('errors', $parteModel->errors());
        }
    }
	public function mostrarParte($id)
{
    $parteModel = new ParteModel();

    // Llama al método personalizado que acabas de crear en tu modelo
    $parte = $parteModel->getParteById($id);

    if ($parte) {
        $empleadoModel = new EmpleadoModel();
        $localidadModel = new LocalidadModel();
        
        // Obtiene solo empleados activos
        $data['empleados'] = $empleadoModel->where('activo', 1)->findAll();
        // Obtiene todas las localidades
        $data['localidades'] = $localidadModel->findAll();
        $header_data = [
            'titulo' => 'Detalle de Partes',
            'descripcion' => 'Aquí puedes ver el detalle de un parte registrado en el sistema.'
        ];
		

        // Asegúrate de que estás pasando un array con la clave 'parte'
        $data['parte']= $parte;
//print_r($parte);die();
        echo view('inc/header', $header_data);
        echo view('partes/parte_vista', $data); // Aquí es donde necesitas pasar el array
        echo view('inc/footer');
       
    } else {
        // Manejo de errores si el parte no se encuentra
        return redirect()->back()->with('error', 'Parte no encontrado.');
    }
}
	 public function editarParte($id)
    {
        $parteModel = new ParteModel();
		$localidadModel = new LocalidadModel();
        $parte = $parteModel->find($id);
        if (!$parte) {
            return redirect()->back()->with('error', 'Parte no encontrado.');
        }

        
        $empleadoModel = new EmpleadoModel();
		$data['empleados'] = $empleadoModel->where('activo', 1)->findAll();
		 
        $data['localidades'] = $localidadModel->findAll();		 
        $data['parte']= $parte;
		 
		$header_data = [
            'titulo' => 'Editar Parte',
            'descripcion' => 'Aquí puedes ver el detalle de un parte y editarlo registrado en el sistema.'
        ];

        echo view('inc/header', $header_data);
        echo view('partes/edita_parte', $data);
        echo view('inc/footer');
		 
		 
    }
	
	public function actualizarParte()
{
    $parteModel = new ParteModel();

    $id = $this->request->getPost('id');
    $data = $this->request->getPost();

    if ($parteModel->updateParteById($id, $data)) {
        return redirect()->to('/partes')->with('message', 'Parte actualizado correctamente.');
    } else {
        return redirect()->back()->with('error', 'No se pudo actualizar el parte.');
    }
}
public function eliminarParte($id)
{
    $parteModel = new ParteModel();

    if ($parteModel->eliminarParte($id)) {
        // Si se actualizó correctamente, redirige a la lista de partes con un mensaje
        return redirect()->to('/partes')->with('message', 'Parte eliminado correctamente.');
    } else {
        // Si hubo un error, redirige a la página anterior con un mensaje de error
        return redirect()->back()->with('error', 'No se pudo eliminar el parte.');
    }
}
	


}

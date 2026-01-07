<?php
namespace App\Controllers;

use App\Models\EmpleadoModel;
use App\Models\ParteModel;
use CodeIgniter\I18n\Time;

class Empleado extends BaseController
{
   public function index()
{
    $model = new EmpleadoModel();
    $data['empleados'] = $model->findAll();

    $header_data = [
        'titulo' => 'Listado de Empleados',
        'descripcion' => 'Aquí puedes ver todos los empleados registrados en el sistema.'
    ];

    echo view('inc/header', $header_data);
    echo view('empleados/list', $data);
    echo view('inc/footer');
}
    public function create()
    {
        $header_data = [
            'titulo' => 'Crear Empleado',
            'descripcion' => 'Rellena el formulario para agregar un nuevo empleado.'
        ];

        echo view('inc/header', $header_data);
        echo view('empleados/create');
        echo view('inc/footer');
    }

    public function edit($id = null)
{
    $model = new EmpleadoModel();
    $data['empleado'] = $model->find($id);

    $header_data = [
        'titulo' => 'Editar Empleado',
        'descripcion' => 'Modifica los datos del empleado seleccionado.'
    ];

    echo view('inc/header', $header_data);
    echo view('empleados/edit', $data);
    echo view('inc/footer');
}

   public function delete($id)
{
    $model = new EmpleadoModel();
    $model->deleteById($id);
    
    // Aquí puedes añadir un mensaje flash para notificar al usuario que el empleado fue eliminado
     session()->setFlashdata('message', 'Empleado eliminado con éxito!');

    return redirect()->to('/empleado');
}

// ... (parte inicial del controlador)

public function store()
{
    $model = new EmpleadoModel();

    $data = [
        'nombre' => $this->request->getPost('nombre'),
        'apellido' => $this->request->getPost('apellido'),
        'email' => $this->request->getPost('email'),
        'telefono' => $this->request->getPost('telefono'),
        'departamento' => $this->request->getPost('departamento'),
        'fecha_contratacion' => $this->request->getPost('fecha_contratacion'),
		'vehiculo' => $this->request->getPost('vehiculo'),
        'activo' => $this->request->getPost('activo') ? 1 : 0,  // Aquí se verifica el campo activo
        'vacaciones' => $this->request->getPost('vacaciones') ? 1 : 0  // Aquí se verifica el campo vacaciones
    ];

    $model->insert($data);

    return redirect()->to('/empleado');  // Redirecciona al listado después de guardar
}

public function update($id)
{
    $model = new EmpleadoModel();

    $data = [
        'nombre' => $this->request->getPost('nombre'),
        'apellido' => $this->request->getPost('apellido'),
        'email' => $this->request->getPost('email'),
        'telefono' => $this->request->getPost('telefono'),
        'departamento' => $this->request->getPost('departamento'),
        'fecha_contratacion' => $this->request->getPost('fecha_contratacion'),
		'vehiculo' => $this->request->getPost('vehiculo'),
         'activo' => $this->request->getPost('activo') ? 1 : 0,  // Aquí se verifica el campo activo
        'vacaciones' => $this->request->getPost('vacaciones') ? 1 : 0  // Aquí se verifica el campo vacaciones
    ];

    $model->update($id, $data);

    return redirect()->to('/empleado');  // Redirecciona al listado después de actualizar
}
public function kpis($idEmpleado) {
    $parteModel = new ParteModel();

    // Obtén las fechas 'desde' y 'hasta' de la solicitud, si no hay, usa las fechas de la última semana
    $desde = $this->request->getVar('desde');
    $hasta = $this->request->getVar('hasta');

    // Si no se proporcionan las fechas, establece el rango de la última semana
    if (!$desde || !$hasta) {
        // 'desde' como el lunes de la semana pasada
        $desde = new Time('last monday -7 days');
        // 'hasta' como el domingo de la semana pasada
        $hasta = new Time('last sunday');
    } else {
        // Convierte las fechas a objetos Time para garantizar el formato correcto
        $desde = new Time($desde);
        $hasta = new Time($hasta);
    }

    // Asegúrate de que la fecha 'hasta' sea al final del día
    $hasta = $hasta->setHour(23)->setMinute(59)->setSecond(59);

    // Obtén la información del empleado y el total de partes asignados dentro del rango de fechas
    $kpis = $parteModel->getTotalPartesAsignados($idEmpleado, $desde, $hasta);
	$sumaImportes = $parteModel->getSumaImportes($idEmpleado, $desde, $hasta);
	
	//print_r($sumaImportes); die();
	$partesPorTipo = $parteModel->getPartesCountAndSumByType($idEmpleado, $desde, $hasta);
	$partesConFotos = $parteModel->getPartesConFotos($idEmpleado, $desde, $hasta);
	$limpiezaObligatoria = $parteModel->getPartesConLimpiezaObligatoria($idEmpleado, $desde, $hasta);
    $limpiezaRealizada = $parteModel->getPartesConLimpiezaRealizada($idEmpleado, $desde, $hasta);
    $porcentajeLimpiezaCorrecta = $limpiezaObligatoria > 0 ? ($limpiezaRealizada / $limpiezaObligatoria) * 100 : 0;
	$ofreceAsistencia = $parteModel->getOfreceAsistenciaCount($idEmpleado, $desde, $hasta);
	$reclamacion = $parteModel->getReclamacionCountAndSum($idEmpleado, $desde, $hasta);
	$felicitacion = $parteModel->getFelicitacionCount($idEmpleado, $desde, $hasta);

	
	

    // Continúa con la lógica para mostrar los KPIs...


    // Verificar si la información del empleado se obtuvo correctamente
    if (!$kpis) {
        // Manejo del error si el empleado no existe o no se pueden obtener los datos
        return redirect()->back()->with('error', 'Empleado no encontrado o error al obtener KPIs.');
    }

    $header_data = [
        'titulo' => 'KPIs Empleado',
        'descripcion' => 'Muestra los KPIs del empleado'
    ];

    // Agregar información del empleado a los datos que se pasarán a la vista
    $data = [
    'idEmpleado' => $idEmpleado, // Asegúrate de que esta línea está presente
    'nombre' => $kpis['nombre'],
    'apellido' => $kpis['apellido'],
	'activo' => $kpis['activo'],
    'totalPartesAsignados' => $kpis['totalPartesAsignados'],
	'sumaImportes'=> $sumaImportes,
		
	'desde'=> $desde,
	'hasta'=> $hasta,	
    // Agrega aquí el resto de tus KPIs
];
// Inicializa un arreglo con todos los tipos posibles y valores en cero
$data['partesPorTipo'] = $partesPorTipo;
//print_r($partesPorTipo); die();
$tiposDePartes = [
    'Siniestro' => ['cantidad' => 0, 'sumaImporte' => 0],
    'Bricolaje' => ['cantidad' => 0, 'sumaImporte' => 0],
    'Asistencia' => ['cantidad' => 0, 'sumaImporte' => 0],
    // Añade más tipos si es necesario
];

// Suponiendo que $partesPorTipo es el resultado del modelo
// Suponiendo que $partesPorTipo es el resultado del modelo y contiene los datos correctos
foreach ($partesPorTipo as $tipo => $datos) {
    // Aquí asumimos que $tipo es el número que representa el tipo de parte
    switch ($tipo) {
        case 0:
            // Configura 'Siniestro' con los datos correspondientes
            $tiposDePartes['Siniestro'] = $datos;
            break;
        case 1:
            // Configura 'Bricolaje' con los datos correspondientes
            $tiposDePartes['Bricolaje'] = $datos;
            break;
        case 2:
            // Configura 'Asistencia' con los datos correspondientes
            $tiposDePartes['Asistencia'] = $datos;
            break;
        // Añade casos adicionales si hay más tipos
    }
}


$data['partesConFotos'] = $partesConFotos;
$data['partesPorTipo'] = $tiposDePartes;
$data['limpiezaObligatoria'] = $limpiezaObligatoria;
$data['limpiezaRealizada'] = $limpiezaRealizada;
$data['porcentajeLimpiezaCorrecta'] = $porcentajeLimpiezaCorrecta;
$data['ofreceAsistencia'] = $ofreceAsistencia;
$data['reclamacion'] = $reclamacion;
$data['felicitacion'] = $felicitacion;
	
    // Renderizar la vista con los datos
    echo view('inc/header', $header_data);
    echo view('empleados/kpis', $data);
    echo view('inc/footer');
}

public function listadoKPIs() {
    $empleadoModel = new EmpleadoModel();
    $parteModel = new ParteModel();
	
	// Obtén las fechas 'desde' y 'hasta' de la solicitud, si no hay, usa las fechas de la última semana
    $desde = $this->request->getVar('desde');
    $hasta = $this->request->getVar('hasta');

    // Si no se proporcionan las fechas, establece el rango de la última semana
    if (!$desde || !$hasta) {
        // 'desde' como el lunes de la semana pasada
        $desde = new Time('last monday -7 days');
        // 'hasta' como el domingo de la semana pasada
        $hasta = new Time('last sunday');
    } else {
        // Convierte las fechas a objetos Time para garantizar el formato correcto
        $desde = new Time($desde);
        $hasta = new Time($hasta);
    }

    // Asegúrate de que la fecha 'hasta' sea al final del día
    $hasta = $hasta->setHour(23)->setMinute(59)->setSecond(59);


   

    // Recupera todos los empleados activos
    $empleados = $empleadoModel->where('activo', 1)->findAll();

    // Prepara el array para los datos de los KPIs
    $kpisPorEmpleado = [];

    // Itera sobre cada empleado para recopilar sus KPIs
    foreach ($empleados as $empleado) {
        $idEmpleado = $empleado['id'];

        // Usa los métodos del modelo para obtener los datos de los KPIs
		$partesPorTipo = $parteModel->getPartesCountAndSumByType($idEmpleado, $desde, $hasta);
        $totalPartesAsignados = $parteModel->getTotalPartesAsignados($idEmpleado, $desde, $hasta)['totalPartesAsignados'];
        $sumaImportes = $parteModel->getSumaImportes($idEmpleado, $desde, $hasta);
        $partesConFotos = $parteModel->getPartesConFotos($idEmpleado, $desde, $hasta);
        $partesConLimpiezaObligatoria = $parteModel->getPartesConLimpiezaObligatoria($idEmpleado, $desde, $hasta);
        $partesConLimpiezaRealizada = $parteModel->getPartesConLimpiezaRealizada($idEmpleado, $desde, $hasta);
        $ofreceAsistencia = $parteModel->getOfreceAsistenciaCount($idEmpleado, $desde, $hasta);
        $reclamacionesInfo = $parteModel->getReclamacionCountAndSum($idEmpleado, $desde, $hasta);
        $felicitaciones = $parteModel->getFelicitacionCount($idEmpleado, $desde, $hasta);
		
		
		
		// Inicializa un arreglo con todos los tipos posibles y valores en cero
		$data['partesPorTipo'] = $partesPorTipo;
		//print_r($partesPorTipo); die();
		$tiposDePartes = [
			'Siniestro' => ['cantidad' => 0, 'sumaImporte' => 0],
			'Bricolaje' => ['cantidad' => 0, 'sumaImporte' => 0],
			'Asistencia' => ['cantidad' => 0, 'sumaImporte' => 0],
			// Añade más tipos si es necesario
		];

		// Suponiendo que $partesPorTipo es el resultado del modelo
		// Suponiendo que $partesPorTipo es el resultado del modelo y contiene los datos correctos
		foreach ($partesPorTipo as $tipo => $datos) {
			// Aquí asumimos que $tipo es el número que representa el tipo de parte
			switch ($tipo) {
				case 0:
					// Configura 'Siniestro' con los datos correspondientes
					$tiposDePartes['Siniestro'] = $datos;
					break;
				case 1:
					// Configura 'Bricolaje' con los datos correspondientes
					$tiposDePartes['Bricolaje'] = $datos;
					break;
				case 2:
					// Configura 'Asistencia' con los datos correspondientes
					$tiposDePartes['Asistencia'] = $datos;
					break;
				// Añade casos adicionales si hay más tipos
			}
		}

		

        // Compila los KPIs en un array asociativo
        $kpisPorEmpleado['empleado'][$idEmpleado] = [
            'nombreCompleto' => $empleado['nombre'] . ' ' . $empleado['apellido'],
            'totalPartesAsignados' => $totalPartesAsignados,
            'sumaImportes' => $sumaImportes,
            'partesConFotos' => $partesConFotos,
            'partesConLimpiezaObligatoria' => $partesConLimpiezaObligatoria,
            'partesConLimpiezaRealizada' => $partesConLimpiezaRealizada,
            'ofreceAsistencia' => $ofreceAsistencia,
            'conteoReclamaciones' => $reclamacionesInfo['conteoReclamaciones'],
            'sumaReclamaciones' => $reclamacionesInfo['sumaReclamaciones'],
            'felicitaciones' => $felicitaciones,
			'activo'=> $empleado['activo'],
			'partesPorTipo' => $tiposDePartes
        ];
		
		
		
    }
	$kpisPorEmpleado['desde'] =  $desde;
	$kpisPorEmpleado['hasta'] =  $hasta;
	$header_data = [
            'titulo' => 'Listado de KPIs de usuarios',
            'descripcion' => ''
        ];
    // Carga las vistas con los datos de los KPIs
    echo view('inc/header', $header_data);
    echo view('empleados/listado_kpis', ['kpisPorEmpleado' => $kpisPorEmpleado]);
    echo view('inc/footer');
}



}

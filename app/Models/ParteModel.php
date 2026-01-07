<?php
namespace App\Models;

use CodeIgniter\Model;

class ParteModel extends Model
{
    protected $table      = 'partes';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

   protected $allowedFields = [
        'numero_de_expediente', 'nombre', 'telefono', 'direccion', 'localidad', 'cp',
        'id_profesional', 'id_profesional2', 'id_profesional3', 'id_profesional4', 'id_profesional5',
        'tipo', 'empleado_comision', 'estado', 'descripcion_del_trabajo', 'codigos',
        'importe', 'interviene_taller', 'ha_realizado_fotos', 'hay_que_limpiar', 'ha_limpiado',
        'abre_nueva_asistencia', 'ofrece_asistencia', 'reclamacion', 'felicitacion', 'observaciones','fecha_ultima_modificacion','fecha_parte','activo'
       
    ];

    public function getPartesWithDetails()
    {
         return $this->select('partes.*, e1.nombre AS empleado_nombre, e1.apellido AS empleado_apellido, 
                      e2.nombre AS empleado2_nombre, e2.apellido AS empleado2_apellido, 
                      e3.nombre AS empleado3_nombre, e3.apellido AS empleado3_apellido,
                      e4.nombre AS empleado4_nombre, e4.apellido AS empleado4_apellido, 
                      e5.nombre AS empleado5_nombre, e5.apellido AS empleado5_apellido, 
                      localidades.nombre AS localidad_nombre')
            ->join('empleados as e1', 'partes.id_profesional = e1.id', 'left')
            ->join('empleados as e2', 'partes.id_profesional2 = e2.id', 'left')
            ->join('empleados as e3', 'partes.id_profesional3 = e3.id', 'left')
            ->join('empleados as e4', 'partes.id_profesional4 = e4.id', 'left')
            ->join('empleados as e5', 'partes.id_profesional5 = e5.id', 'left')
            ->join('localidades', 'partes.localidad = localidades.id', 'left')
            ->where('partes.activo', 1) // Añade esta línea para filtrar solo los activos
            ->orderBy('partes.id', 'ASC') 
            ->findAll();

    }

	
public function getPaginatedPartes()
    {
        // Setup the select query with proper joins
         return $this->select('partes.*, e1.nombre AS empleado_nombre, e1.apellido AS empleado_apellido, 
                                      e2.nombre AS empleado2_nombre, e2.apellido AS empleado2_apellido, 
                                      e3.nombre AS empleado3_nombre, e3.apellido AS empleado3_apellido,
                                      e4.nombre AS empleado4_nombre, e4.apellido AS empleado4_apellido, 
                                      e5.nombre AS empleado5_nombre, e5.apellido AS empleado5_apellido, 
                                      localidades.nombre AS localidad_nombre')
                    ->join('empleados as e1', 'partes.id_profesional = e1.id', 'left')
                    ->join('empleados as e2', 'partes.id_profesional2 = e2.id', 'left')
                    ->join('empleados as e3', 'partes.id_profesional3 = e3.id', 'left')
                    ->join('empleados as e4', 'partes.id_profesional4 = e4.id', 'left')
                    ->join('empleados as e5', 'partes.id_profesional5 = e5.id', 'left')
                    ->join('localidades', 'partes.localidad = localidades.id', 'left')
			 		->where('partes.activo', 1)
			 		->orderBy('partes.id', 'DESC') 
                    ->paginate(10);
    }

public function getPager()
{
    return $this->pager;
}
	
    public function searchPartes($search, $profesionalId = null, $fechaInicio = null, $fechaFin = null)
    {
        if ($search) {
            $this->groupStart(); 
            $this->like('partes.numero_de_expediente', $search);
            $this->orLike('partes.telefono', $search);
            $this->orLike('partes.direccion', $search);
            $this->groupEnd(); 
        }

        if ($profesionalId) {
            $this->groupStart(); 
            $this->where('partes.id_profesional', $profesionalId);
            $this->orWhere('partes.id_profesional2', $profesionalId);
            $this->orWhere('partes.id_profesional3', $profesionalId);
            $this->orWhere('partes.id_profesional4', $profesionalId);
            $this->orWhere('partes.id_profesional5', $profesionalId);
            $this->groupEnd();
        }

        if ($fechaInicio && $fechaFin) {
            $this->where('fecha_parte >=', $fechaInicio);
            $this->where('fecha_parte <=', $fechaFin);
        }

        return $this->select('partes.*, e1.nombre AS empleado_nombre, e1.apellido AS empleado_apellido, 
                                  e2.nombre AS empleado2_nombre, e2.apellido AS empleado2_apellido, 
                                  e3.nombre AS empleado3_nombre, e3.apellido AS empleado3_apellido,
                                  e4.nombre AS empleado4_nombre, e4.apellido AS empleado4_apellido, 
                                  e5.nombre AS empleado5_nombre, e5.apellido AS empleado5_apellido, 
                                  localidades.nombre AS localidad_nombre')
                ->join('empleados as e1', 'partes.id_profesional = e1.id', 'left')
                ->join('empleados as e2', 'partes.id_profesional2 = e2.id', 'left')
                ->join('empleados as e3', 'partes.id_profesional3 = e3.id', 'left')
                ->join('empleados as e4', 'partes.id_profesional4 = e4.id', 'left')
                ->join('empleados as e5', 'partes.id_profesional5 = e5.id', 'left')
                ->join('localidades', 'partes.localidad = localidades.id', 'left')
                ->where('partes.activo', 1)
                ->orderBy('partes.id', 'DESC')
                ->findAll();
    }


public function getPaginatedPartesForProfessional($professionalId, $perPage = 10)
{
    return $this->select('partes.*, e1.nombre AS empleado_nombre, e1.apellido AS empleado_apellido, 
                                      e2.nombre AS empleado2_nombre, e2.apellido AS empleado2_apellido, 
                                      e3.nombre AS empleado3_nombre, e3.apellido AS empleado3_apellido,
                                      e4.nombre AS empleado4_nombre, e4.apellido AS empleado4_apellido, 
                                      e5.nombre AS empleado5_nombre, e5.apellido AS empleado5_apellido, 
                                      localidades.nombre AS localidad_nombre')
                    ->join('empleados as e1', 'partes.id_profesional = e1.id', 'left')
                    ->join('empleados as e2', 'partes.id_profesional2 = e2.id', 'left')
                    ->join('empleados as e3', 'partes.id_profesional3 = e3.id', 'left')
                    ->join('empleados as e4', 'partes.id_profesional4 = e4.id', 'left')
                    ->join('empleados as e5', 'partes.id_profesional5 = e5.id', 'left')
                    ->join('localidades', 'partes.localidad = localidades.id', 'left')
                ->where('partes.id_profesional', $professionalId)
				 ->where('partes.activo', 1) 
				->orderBy('partes.id', 'DESC') 
                ->paginate($perPage);
}

public function insertarParte($data)
{
//	print_r($data);die();
    // Comprueba si todos los campos necesarios están presentes en el array $data
    $camposRequeridos = [
        'numero_de_expediente',   'direccion','id_profesional', 'tipo','estado', 'importe', 'fecha_parte'
        // 'fecha_ultima_modificacion' no es necesario en $camposRequeridos porque siempre se establecerá a la fecha actual
    ];
	$interviene_taller = isset($data['interviene_taller']) ? 1 : 0;
	$data['interviene_taller']=$interviene_taller;
	
	$ofrece_asistencia = isset($data['ofrece_asistencia']) ? 1 : 0;
	$data['ofrece_asistencia']=$ofrece_asistencia;
	
	$felicitacion = isset($data['felicitacion']) ? 1 : 0;
	$data['felicitacion']=$felicitacion;
	
	$ha_realizado_fotos = isset($data['ha_realizado_fotos']) ? 1 : 0;
	$data['ha_realizado_fotos']=$ha_realizado_fotos;
	
	$hay_que_limpiar = isset($data['hay_que_limpiar']) ? 1 : 0;
	$data['hay_que_limpiar']=$hay_que_limpiar;
	
	$ha_limpiado = isset($data['ha_limpiado']) ? 1 : 0;
	$data['ha_limpiado']=$ha_limpiado;
    // Verifica que todos los campos requeridos están en el array $data
    foreach ($camposRequeridos as $campo) {
        if (!array_key_exists($campo, $data)) {
            // Manejar el error como prefieras, lanzar una excepción, devolver un error, etc.
            throw new \Exception("El campo {$campo} es requerido.");
        }
    }
$fechaOriginal = $data['fecha_parte']; // "2023-11-22"

$dateTimeObject = \DateTime::createFromFormat('Y-m-d', $fechaOriginal);

if ($dateTimeObject === false) {
    // Manejar el error aquí, la fecha no es válida o no coincide con el formato esperado
    throw new \Exception("La fecha proporcionada no es válida o no tiene el formato esperado.");
}

$fechaFormateada = $dateTimeObject->format('Y-m-d');
$data['fecha_parte'] = $fechaFormateada;
$data['activo']=1;

    // Establece 'fecha_ultima_modificacion' a la fecha actual
    $data['fecha_ultima_modificacion'] = date('Y-m-d');

    if ($this->insert($data)) {
		
    return $this->insertID();
		
} else {
    return $this->errors();
}
}

 // Método para buscar un parte por su ID
    public function getParteById($id)
{
    // Configura la consulta con los joins apropiados
    return $this->select('partes.*, e1.nombre AS empleado_nombre, e1.apellido AS empleado_apellido, 
                                  e2.nombre AS empleado2_nombre, e2.apellido AS empleado2_apellido, 
                                  e3.nombre AS empleado3_nombre, e3.apellido AS empleado3_apellido,
                                  e4.nombre AS empleado4_nombre, e4.apellido AS empleado4_apellido, 
                                  e5.nombre AS empleado5_nombre, e5.apellido AS empleado5_apellido, 
                                  localidades.nombre AS localidad_nombre')
                ->join('empleados as e1', 'partes.id_profesional = e1.id', 'left')
                ->join('empleados as e2', 'partes.id_profesional2 = e2.id', 'left')
                ->join('empleados as e3', 'partes.id_profesional3 = e3.id', 'left')
                ->join('empleados as e4', 'partes.id_profesional4 = e4.id', 'left')
                ->join('empleados as e5', 'partes.id_profesional5 = e5.id', 'left')
                ->join('localidades', 'partes.localidad = localidades.id', 'left')
                ->where('partes.id', $id)
				 ->where('partes.activo', 1) 
                ->first(); // Ejecuta la consulta y obtiene el primer resultado
}
	


    public function updateParteById($id, $data)
    {
		 $camposRequeridos = [
        'numero_de_expediente',   'direccion','id_profesional', 'tipo','estado', 'importe', 'fecha_parte'
        // 'fecha_ultima_modificacion' no es necesario en $camposRequeridos porque siempre se establecerá a la fecha actual
    ];
	$interviene_taller = isset($data['interviene_taller']) ? 1 : 0;
	$data['interviene_taller']=$interviene_taller;
	
	$ofrece_asistencia = isset($data['ofrece_asistencia']) ? 1 : 0;
	$data['ofrece_asistencia']=$ofrece_asistencia;
	
	$felicitacion = isset($data['felicitacion']) ? 1 : 0;
	$data['felicitacion']=$felicitacion;
	
	$ha_realizado_fotos = isset($data['ha_realizado_fotos']) ? 1 : 0;
	$data['ha_realizado_fotos']=$ha_realizado_fotos;
	
	$hay_que_limpiar = isset($data['hay_que_limpiar']) ? 1 : 0;
	$data['hay_que_limpiar']=$hay_que_limpiar;
	
	$ha_limpiado = isset($data['ha_limpiado']) ? 1 : 0;
	$data['ha_limpiado']=$ha_limpiado;
    // Verifica que todos los campos requeridos están en el array $data
    foreach ($camposRequeridos as $campo) {
        if (!array_key_exists($campo, $data)) {
            // Manejar el error como prefieras, lanzar una excepción, devolver un error, etc.
            throw new \Exception("El campo {$campo} es requerido.");
        }
    }
        return $this->update($id, $data);
    }

 public function eliminarParte($id)
    {
        $data = ['activo' => 0]; // Establecemos 'activo' a 0 para marcar como inactivo
        return $this->update($id, $data);
    }
	
public function getTotalPartesAsignados($idEmpleado, $desde, $hasta) {
    // Primero, obtenemos el nombre y apellido del empleado.
    $empleado = $this->db->table('empleados')
                         ->select('nombre, apellido,activo')
                         ->where('id', $idEmpleado)
                         ->get()
                         ->getRowArray();

    if (!$empleado) {
        // Si el empleado no se encuentra, puedes decidir cómo manejar este caso.
        return null;
    }

    // Luego, realizamos el conteo de partes asignados al empleado.
    // Contamos las filas donde el empleado aparece en cualquiera de los campos de profesional.
    $totalPartes = $this->db->table('partes')
                ->select('id')
                ->where('activo', 1)
                ->where('fecha_parte >=', $desde->toDateString())
                ->where('fecha_parte <=', $hasta->toDateString())
                ->groupStart()
                    ->where('id_profesional', $idEmpleado)
                    ->orWhere('id_profesional2', $idEmpleado)
                    ->orWhere('id_profesional3', $idEmpleado)
                    ->orWhere('id_profesional4', $idEmpleado)
                    ->orWhere('id_profesional5', $idEmpleado)
                ->groupEnd()
                ->countAllResults();

    return [
        'nombre' => $empleado['nombre'],
        'apellido' => $empleado['apellido'],
		'activo' => $empleado['activo'],
        'totalPartesAsignados' => $totalPartes
    ];
}

public function getSumaImportes($idEmpleado, $desde, $hasta) {
    $partes = $this->select('importe, id_profesional, id_profesional2, id_profesional3, id_profesional4, id_profesional5')
                    ->where('fecha_parte >=', $desde->format('Y-m-d'))
                    ->where('fecha_parte <=', $hasta->format('Y-m-d'))
                    ->where('activo', 1)
                    ->findAll();
    
    $importeProporcional = 0;

    foreach ($partes as $parte) {
        // Contar cuántos profesionales están asignados a este parte
        $numProfesionales = 1; // Iniciamos en 1 para contar el id_profesional
        for ($i = 2; $i <= 5; $i++) { // Comenzamos en 2 porque ya contamos id_profesional
            if (!empty($parte["id_profesional$i"])) {
                $numProfesionales++;
            }
        }

        // Verificar si el empleado participó en el parte
        $empleadosParte = [$parte['id_profesional'], $parte['id_profesional2'], $parte['id_profesional3'], $parte['id_profesional4'], $parte['id_profesional5']];
        if (in_array($idEmpleado, $empleadosParte, true)) {
            // Solo suma si el empleado participó
            $importeProporcional += $parte['importe'] / max($numProfesionales, 1); // Evita la división por cero
        }
    }

    return $importeProporcional;
}

public function getPartesCountAndSumByType($idEmpleado, $desde, $hasta) {
    // Obtén los partes junto con los IDs de todos los profesionales involucrados
    $this->select('tipo, importe, id_profesional, id_profesional2, id_profesional3, id_profesional4, id_profesional5');
    $this->where('fecha_parte >=', $desde->format('Y-m-d'));
    $this->where('fecha_parte <=', $hasta->format('Y-m-d'));
    $this->where('activo', 1);
    
    $partes = $this->findAll();

    // Crea un arreglo para almacenar los resultados ajustados
    $resultadosAjustados = [];

    foreach ($partes as $parte) {
        // Inicializa el contador de profesionales
        $numProfesionales = !empty($parte['id_profesional']) ? 1 : 0;
        $participoEmpleado = $parte['id_profesional'] == $idEmpleado;

        // Verificar la participación del empleado y contar los profesionales involucrados
        for ($i = 2; $i <= 5; $i++) {
            if (!empty($parte["id_profesional$i"])) {
                $numProfesionales++;
                if ($parte["id_profesional$i"] == $idEmpleado) {
                    $participoEmpleado = true;
                }
            }
        }

        // Continuar solo si el empleado participó en este parte
        if ($participoEmpleado) {
            $importeAsignado = $numProfesionales > 0 ? $parte['importe'] / $numProfesionales : $parte['importe'];

            // Inicializar el tipo de parte si aún no existe en el arreglo
            if (!isset($resultadosAjustados[$parte['tipo']])) {
                $resultadosAjustados[$parte['tipo']] = ['cantidad' => 0, 'sumaImporte' => 0];
            }

            // Sumar la cantidad y el importe proporcional al tipo de parte correspondiente
            $resultadosAjustados[$parte['tipo']]['cantidad']++;
            $resultadosAjustados[$parte['tipo']]['sumaImporte'] += $importeAsignado;
        }
    }

    return $resultadosAjustados;
}






public function getPartesConFotos($idEmpleado, $desde, $hasta) {
    // Usamos countAllResults() en una consulta con condiciones agrupadas para los diferentes campos de id_profesional.
    return $this->where('ha_realizado_fotos', 1)
                ->where('fecha_parte >=', $desde->format('Y-m-d H:i:s'))
                ->where('fecha_parte <=', $hasta->format('Y-m-d H:i:s'))
                ->where('activo', 1)
                ->groupStart()
                    ->where('id_profesional', $idEmpleado)
                    ->orWhere('id_profesional2', $idEmpleado)
                    ->orWhere('id_profesional3', $idEmpleado)
                    ->orWhere('id_profesional4', $idEmpleado)
                    ->orWhere('id_profesional5', $idEmpleado)
                ->groupEnd()
                ->countAllResults();
}

// Método para contar las veces que la limpieza era obligatoria
public function getPartesConLimpiezaObligatoria($idEmpleado, $desde, $hasta) {
    return $this->where('hay_que_limpiar', 1)
                ->where('fecha_parte >=', $desde->format('Y-m-d H:i:s'))
                ->where('fecha_parte <=', $hasta->format('Y-m-d H:i:s'))
                ->where('activo', 1)
                ->groupStart()
                    ->where('id_profesional', $idEmpleado)
                    ->orWhere('id_profesional2', $idEmpleado)
                    ->orWhere('id_profesional3', $idEmpleado)
                    ->orWhere('id_profesional4', $idEmpleado)
                    ->orWhere('id_profesional5', $idEmpleado)
                ->groupEnd()
                ->countAllResults();
}

public function getPartesConLimpiezaRealizada($idEmpleado, $desde, $hasta) {
    return $this->where('hay_que_limpiar', 1)
                ->where('ha_limpiado', 1)
                ->where('fecha_parte >=', $desde->format('Y-m-d H:i:s'))
                ->where('fecha_parte <=', $hasta->format('Y-m-d H:i:s'))
                ->where('activo', 1)
                ->groupStart()
                    ->where('id_profesional', $idEmpleado)
                    ->orWhere('id_profesional2', $idEmpleado)
                    ->orWhere('id_profesional3', $idEmpleado)
                    ->orWhere('id_profesional4', $idEmpleado)
                    ->orWhere('id_profesional5', $idEmpleado)
                ->groupEnd()
                ->countAllResults();
}


public function getOfreceAsistenciaCount($idEmpleado, $desde, $hasta) {
    // Comenzamos seleccionando todos los campos necesarios para el conteo
    $partes = $this->select('id_profesional, id_profesional2, id_profesional3, id_profesional4, id_profesional5')
                    ->where('activo', 1)
                    ->where('ofrece_asistencia', 1)
                    ->where('fecha_parte >=', $desde->format('Y-m-d'))
                    ->where('fecha_parte <=', $hasta->format('Y-m-d'))
                    ->findAll();
    
    $conteoAsistencia = 0;

    // Iteramos sobre cada parte para verificar la participación del empleado
    foreach ($partes as $parte) {
        if (in_array($idEmpleado, [$parte['id_profesional'], $parte['id_profesional2'], $parte['id_profesional3'], $parte['id_profesional4'], $parte['id_profesional5']], true)) {
            // Si el empleado está en alguno de los campos, incrementamos el contador
            $conteoAsistencia++;
        }
    }

    return $conteoAsistencia;
}

public function getReclamacionCountAndSum($idEmpleado, $desde, $hasta) {
    $partes = $this->select('reclamacion, id_profesional, id_profesional2, id_profesional3, id_profesional4, id_profesional5')
                    ->where('activo', 1)
                    ->where('reclamacion >', 0) // Suponiendo que una reclamación válida es mayor a 0
                    ->where('fecha_parte >=', $desde->format('Y-m-d'))
                    ->where('fecha_parte <=', $hasta->format('Y-m-d'))
                    ->findAll();
    
    $sumaReclamaciones = 0;
    $conteoReclamaciones = 0;

    foreach ($partes as $parte) {
        // Verificar si el empleado participó en el parte
        if (in_array($idEmpleado, [
            $parte['id_profesional'], 
            $parte['id_profesional2'], 
            $parte['id_profesional3'], 
            $parte['id_profesional4'], 
            $parte['id_profesional5']
        ], true)) {
            $conteoReclamaciones++; // Incrementar el contador de reclamaciones
            // Contar cuántos profesionales están asignados a este parte
            $numProfesionales = 1; // Inicia en 1 para el id_profesional principal
            for ($i = 2; $i <= 5; $i++) { // Comienza en 2 ya que id_profesional está contado
                if (!empty($parte["id_profesional$i"])) {
                    $numProfesionales++;
                }
            }
            $sumaReclamaciones += ($parte['reclamacion'] / $numProfesionales); // Sumar proporcionalmente
        }
    }

    return [
        'conteoReclamaciones' => $conteoReclamaciones,
        'sumaReclamaciones' => $sumaReclamaciones
    ];
}





   public function getFelicitacionCount($idEmpleado, $desde, $hasta) {
    // Seleccionamos todas las partes activas dentro del rango de fechas
    $partes = $this->select('felicitacion, id_profesional, id_profesional2, id_profesional3, id_profesional4, id_profesional5')
                    ->where('activo', 1)
                    ->where('fecha_parte >=', $desde->format('Y-m-d'))
                    ->where('fecha_parte <=', $hasta->format('Y-m-d'))
                    ->findAll();

    $conteoFelicitaciones = 0;

    // Iteramos sobre cada parte
    foreach ($partes as $parte) {
        // Verificamos si el empleado está en alguno de los campos de profesionales
        if (in_array($idEmpleado, [
            $parte['id_profesional'], 
            $parte['id_profesional2'], 
            $parte['id_profesional3'], 
            $parte['id_profesional4'], 
            $parte['id_profesional5']
        ], true) && $parte['felicitacion'] == 1) { // Asumiendo que 'felicitacion' es un campo booleano
            $conteoFelicitaciones++; // Incrementamos el contador de felicitaciones
        }
    }

    return $conteoFelicitaciones;
}


}

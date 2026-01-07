<?php
namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $table      = 'empleados';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'telefono', 'departamento', 'fecha_contratacion', 'activo', 'vacaciones', 'vehiculo'];

    public function deleteById($id)
    {
        return $this->delete($id);
    }

    public function insertEmpleado($data)
    {
        return $this->insert($data);
    }

    // Método para obtener todos los empleados
    public function findAllEmpleados()
    {
        return $this->findAll();
    }
}

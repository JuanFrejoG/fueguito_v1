<?php
namespace App\Models;

use CodeIgniter\Model;

class LocalidadModel extends Model
{
    protected $table = 'localidades';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = ['nombre'];

    // Método para obtener todas las localidades
    public function findAllLocalidades()
    {
        return $this->findAll();
    }

    // Método para obtener una localidad por su ID
    public function findLocalidadById($id)
    {
        return $this->asArray()
                    ->where(['id' => $id])
                    ->first();
    }
}

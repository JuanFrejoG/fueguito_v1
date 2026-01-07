<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
     protected $allowedFields = ['email', 'password', 'Rol', 'name']; // Campos que se permiten inserta

    // Para buscar usuario por email
    public function getByEmail($email)
    {
        return $this->asArray()
                    ->where(['email' => $email])
                    ->first();
    }
	 public function insertUser($data) {
        return $this->insert($data);
    }
}

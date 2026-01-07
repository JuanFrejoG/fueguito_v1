<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
class Home extends BaseController
{
    public function index(): string
    {
        

		$data = [
            'titulo' => 'Página de acceso',
            'descripcion' => 'Esta es la descripción de la página de acceso.',
            // Puedes agregar más variables aquí según lo necesites
        ];
		$vistas = view('inc/header', $data) .
                  view('welcome_message', $data) . // Pasando el array $data a la vista
                  view('inc/footer');
		 return $vistas;
    }
	
public function nuevoUser() {
        $email = "taller@fjparrado.com";
        $name = "Javi";
        $rol = "2";
        $passwordPlano = "Mapfre13513"; // Esta es la contraseña en texto plano
        $passwordHasheada = password_hash($passwordPlano, PASSWORD_DEFAULT); // Aquí hasheas la contraseña

        // Preparar el arreglo de datos para insertar
        $data = [
            'email' => $email,
            'password' => $passwordHasheada, 
            'Rol' => $rol,
            'name' => $name
        ];

        // Cargar el modelo UsuarioModel
        $usuarioModel = new UsuarioModel();

        // Insertar los datos en la base de datos
        if ($usuarioModel->insertUser($data)) {
            echo "Usuario insertado con éxito.";
        } else {
            echo "Error al insertar el usuario.";
        }
    }

public function autenticar()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UsuarioModel();

        $user = $model->getByEmail($email);

        // Verifica si el usuario existe y si la contraseña es correcta
        if ($user && password_verify($password, $user['password'])) {
            // Establece los datos de la sesión
            $sessionData = [
                'user_id' => $user['id'],
                'user_email' => $user['email'],
                'logged_in' => TRUE
            ];
			//print_r($sessionData); die();
            session()->set($sessionData);

            return redirect()->to(base_url('dashboard'));

        }

        // Si la autenticación falla, regresa al formulario de login con un mensaje de error
        return redirect()->back()->with('error', 'Credenciales incorrectas');
    }
	
	public function dashboard()
{
    // Verificar si el usuario está logueado
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    // Obtener el nombre del usuario desde la base de datos (Asumiendo que tienes una columna 'name' en tu tabla 'usuarios')
    $model = new UsuarioModel();
    $user = $model->find(session()->get('id'));
	//print_r($user); die();	

    // Cargar la vista de dashboard y pasarle los datos del usuario
		
		 $data = [
			'name' => $user[0]['name'],
            'titulo' => 'Dashboard',
            'descripcion' => 'Esta es la descripción de la página de dashboard.',
            // Puedes agregar más variables aquí según lo necesites
        ];
		$vistas = view('inc/header', $data) .
                  view('dashboard', $data) . // Pasando el array $data a la vista
                  view('inc/footer');
		 return $vistas;

}

}


<?php
require_once '../config/template.php';  

require_once(__DIR__ . '/../models/UsuarioModel.php');   
class LoginController extends Template
{
     
    public function index()
    {  
        if (isset($_COOKIE["usuario"])){ 
            header('Location:'.URL. 'home');
        }   
        echo $this->view('login');   
    }
    public function register()
    {   
        echo $this->view('register');   
    }

    public function iniciarsesion()
    {
        $email = $_POST['email'];
        $password = $_POST['contrasenia'];  
        $user = (new UsuarioModel())->getByUser($email);    
        if ($user) { 
            if ($email === $user['email'] &&  password_verify($password,  $user['contrasenia'])) {  
                $cadenaEncriptada = openssl_encrypt(serialize($user), 'AES-256-CBC', 'clave_secreta'); 
                setcookie("usuario", $cadenaEncriptada, time() + 7200, "/");   
                header('Location:'.URL. 'home');
                exit;
            } else {  
                back()->with('mensaje', 'usuario y contraseña no coinciden')->redirect(); 
            }
        } else { 
            back()->with('mensaje', 'usuario no existe')->redirect();
        }
    }
    public function registrar()
    {  
        $email=$_POST['email'] ; 
        $dni=$_POST['dni'];
        $nombres=$_POST['nombres'] ;
        $apellidos=$_POST['apellidos'] ; 
        $telefono=$_POST['telefono'] ;
        $genero=$_POST['genero'];
        $contrasenia=  password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);
        (new UsuarioModel())->create('Paciente', $email, $contrasenia,$dni, $nombres, $apellidos,   $telefono, $genero);   
        header('Location:'.URL. 'login');
    }

    public function cerrarsesion()
    {  
        setcookie("usuario", "", time() - 3600, "/");    
        header('Location:'.URL. 'login');
    }
}
   
 
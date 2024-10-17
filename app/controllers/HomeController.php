<?php 
require_once '../config/template.php';  

require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/CitaModel.php');  
require_once(__DIR__ . '/../models/EspecialistaModel.php');   
require_once(__DIR__ . '/../models/UsuarioModel.php');   
 
class HomeController  extends Template 
{    
    public function __construct()
    {   
        if (!isset($_COOKIE["usuario"])){ 
            $loginController = new LoginController();
            $loginController->index();
            exit(); 
        }   
        $cadenaDesencriptada = openssl_decrypt($_COOKIE["usuario"], 'AES-256-CBC', 'clave_secreta'); 
        $usuario = unserialize($cadenaDesencriptada); 
        if ($usuario["rol"]=='Paciente') {
            header('Location:'.URL. 'miscitas');
        }
    }
    function index()
    {
       $citas= count((new CitaModel())->getAll());   
       $especialistas= count((new EspecialistaModel())->getAll());   
       $pacientes= count((new UsuarioModel())->getByRol('Paciente'));   
       $data=(new UsuarioModel())->getByRolLimit('Paciente') ;   
       echo $this->render('inicio', ['citas' => $citas, 'especialistas' => $especialistas,'pacientes' => $pacientes,'data' => $data]);  
           
    }  
    
}
 
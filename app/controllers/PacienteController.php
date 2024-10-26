<?php   
require_once '../config/template.php';  
require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/UsuarioModel.php');  
class PacienteController  extends Template
{    
    public function __construct()
    {   
        if (!isset($_COOKIE["usuario"])){ 
            $loginController = new LoginController();
            $loginController->index();
            exit(); 
        }   
    } 
    

    function index()
    {  
        $user = (new UsuarioModel())->getByRolDESC('Paciente');    
        return $this->render('administrador/paciente/index', ['data' =>$user]); 
    } 

    function store()
    {     
        if (isset($_POST['id'])&& $_POST['id']>0) {  
            $id=$_POST['id'] ; 
            $usuario=$_POST['usuario'] ;
            $email=$_POST['email'] ;  
            $dni=$_POST['dni'];
            $nombres=$_POST['nombres'] ;
            $apellidos=$_POST['apellidos'] ;
            $crecer=$_POST['crecer'] ;
            $telefono=$_POST['telefono'] ;
            $genero=$_POST['genero'];
            ($_POST['contrasenia'] == null) ?  $contrasenia= null : $contrasenia=  password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);
            (new UsuarioModel())->update($id,$usuario, $email, $contrasenia,$dni, $nombres, $apellidos, $crecer, $telefono, $genero,$fdn);   
          
            back()->with('mensaje', 'datos actualizados correctamente')->redirect(); 
        }else{    
            $usuario=$_POST['usuario'] ;
            $email=$_POST['email'] ; 
            $dni=$_POST['dni'];
            $nombres=$_POST['nombres'] ;
            $apellidos=$_POST['apellidos'] ;
            $crecer=$_POST['crecer'] ;
            $telefono=$_POST['telefono'] ;
            $genero=$_POST['genero'];
            $fdn=$_POST['fdn'];
            $contrasenia=  password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);
            (new UsuarioModel())->create('Paciente', $usuario, $email, $contrasenia,$dni, $nombres, $apellidos, $crecer, $telefono, $genero,$fdn);   
            back()->with('mensaje', 'se guardo correctamente')->redirect(); 
        }
    } 

    function destroy()
    {  
        (new UsuarioModel())->destroy($_GET['id']);      
        return back()->redirect();
    } 
}
 
<?php    
require_once '../config/template.php';    
require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/UsuarioModel.php');  
class UsuarioController  extends Template
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
        $user = (new UsuarioModel())->getByRol('Administrador'); 
        return $this->render('administrador/usuario/index', ['data' => $user]);  
    } 
    function store()
    {    
        if (isset($_POST['id']) && $_POST['id']>0) {
            $id=$_POST['id'] ;
            $nombres=$_POST['nombres'] ;
            $apellidos=$_POST['apellidos'] ;
            $email=$_POST['email'] ;  
            ($_POST['contrasenia'] == null) ?  $contrasenia= null : $contrasenia=  password_hash($_POST['contrasenia'], PASSWORD_DEFAULT); 
            (new UsuarioModel())->update($id, $email, $contrasenia, 0,  $nombres, $apellidos);    
            return back()->redirect();
        }else{
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $email=$_POST['email'] ;  
            $contrasenia=  password_hash($_POST['contrasenia'], PASSWORD_DEFAULT); 
            (new UsuarioModel())->create('Administrador', $email, $contrasenia,0,  $nombres, $apellidos);   
            return back()->redirect();
        }
    } 
    function destroy()
    {  
        (new UsuarioModel())->destroy($_GET['id']);      
        return back()->redirect();
    } 
}
 



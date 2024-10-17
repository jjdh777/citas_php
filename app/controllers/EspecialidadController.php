<?php   
require_once '../config/template.php';  
require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/EspecialidadModel.php'); 
 
class EspecialidadController extends Template
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
        $user = (new EspecialidadModel())->getAll();    
        $this->render('administrador/especialidad/index', ['data' => $user]); 
    } 
    function store()
    {     
        if (isset($_POST['id'])&& $_POST['id']>0) {  
            $id=$_POST['id'] ; 
            $nombre=$_POST['nombre'] ;
            (new EspecialidadModel())->update($id,$nombre);   
            return back()->redirect();
        }else{    
            $nombre=$_POST['nombre'] ;
            (new EspecialidadModel())->create( $nombre);   
            return back()->redirect();
        }
    } 

    function destroy()
    {  
        (new EspecialidadModel())->destroy($_GET['id']);      
        return back()->redirect();
    } 
}
 
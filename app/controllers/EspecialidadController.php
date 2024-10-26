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
        echo("<script>console.log('PHP: " . $user . "');</script>");
        $this->render('administrador/especialidad/index', ['data' => $user]); 
        
    } 
    function store()
    {     
        if (isset($_POST['id'])&& $_POST['id']>0) {  
            $id=$_POST['id'] ; 
            $nombre=$_POST['nombre'] ;
            $nombre2=$_POST['nombre2'] ;
            $notas=$_POST['notas'] ;
            $f_alta=$_POST['f_alta'] ;
            (new EspecialidadModel())->update($id,$nombre,$nombre2,$notas,$f_alta);   
            return back()->redirect();
        }else{    
            $nombre=$_POST['nombre'] ;
            $nombre2=$_POST['nombre2'] ;
            $notas=$_POST['notas'] ;
            $f_alta=$_POST['f_alta'] ;
            (new EspecialidadModel())->create( $nombre,$nombre2,$notas,$f_alta);   
            return back()->redirect();
        }
    } 

    function destroy()
    {  
        (new EspecialidadModel())->destroy($_GET['id']);      
        return back()->redirect();
    } 
}
 
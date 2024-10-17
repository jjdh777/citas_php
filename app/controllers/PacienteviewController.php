<?php 
require_once '../config/template.php';    
require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/CitaModel.php');   
require_once(__DIR__ . '/../models/UsuarioModel.php');  
require_once(__DIR__ . '/../models/EspecialidadModel.php');  
class PacienteviewController  extends Template 
{    
    private $usuario;
    public function __construct()
    {   
        if (!isset($_COOKIE["usuario"])){ 
            $loginController = new LoginController();
            $loginController->index();
            exit(); 
        }   
        $cadenaDesencriptada = openssl_decrypt($_COOKIE["usuario"], 'AES-256-CBC', 'clave_secreta'); 
        $this->usuario = unserialize($cadenaDesencriptada); 
        if ($this->usuario["rol"]=='Administrador') {
            header('Location:'.URL. 'inicio');
        }
    } 
    function index()
    {   
       $citas=  (new CitaModel())->getIdPaciente($this->usuario["id"]) ;   
       $this->render('paciente/miscitas', ['citas' => $citas,]);   
    } 
    
    function citas()
    {
        $data = (new CitaModel())->getIdPaciente($this->usuario["id"]);     
        $especialidad = (new EspecialidadModel())->getAll();    
        $pacientes = (new UsuarioModel())->getByRol('Paciente');       
        $this->render('paciente/cita',
         ['data' => $data,'especialidad'=>$especialidad,'pacientes'=>$pacientes ]
        );  
    } 
    function crearcitas()
    { 
        $descripcion=$_POST['descripcion'];  
        $id_paciente=$_POST['id_paciente'];  
        $id_especialidad=$_POST['id_especialidad'];  
        $id_especialista=$_POST['id_especialista'];   
        $fecha_cita=$_POST['fecha_cita'];  
        $hora_cita=$_POST['hora_cita'];      
        (new CitaModel())->create($descripcion, $id_paciente, $id_especialidad, $id_especialista,  $fecha_cita, $hora_cita );   
        return back()->redirect(); 
    } 
}
 
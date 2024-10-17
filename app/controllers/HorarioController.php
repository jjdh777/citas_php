<?php   
require_once '../config/template.php';  
require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/EspecialistaModel.php');  
require_once(__DIR__ . '/../models/HorarioModel.php');  
class HorarioController  extends Template
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
        $id_especialista= isset($_GET["code"])?$_GET["code"]:0;
        if ($id_especialista > 0) { 
            $data = (new HorarioModel())->getAllEspecialista($id_especialista);    
            $especialista = (new EspecialistaModel())->getAll();    
        }else{
            $data = [];
            $especialista = (new EspecialistaModel())->getAll();     
        }
        $this->render('administrador/horario/index', ['data' => $data,'id_especialista'=>$id_especialista, 'especialista' => $especialista]); 
    } 
    function getDias(){
        $id_especialista= isset($_POST["id_especialista"])?$_POST["id_especialista"]:0;
        $data = (new HorarioModel())->getAllEspecialista($id_especialista);   
        echo  json_encode($data);
    } 
    function store()
    {      
        $id_especialista= $_POST["id_especialista"];  
        $nombre=$_POST['nombre'] ;
        $hora_inicio_m=$_POST['hora_inicio_m'] ;
        $hora_fin_m=$_POST['hora_fin_m'] ;
        $hora_inicio_t=$_POST['hora_inicio_t'] ;
        $hora_fin_t=$_POST['hora_fin_t'] ; 
        if (isset($_POST['estado'])&& $_POST['estado']=='on') {
            $estado= 1;
        }else{
            $estado= 0; 
        } 
        $dias=(new HorarioModel())->getByNombre($id_especialista, $nombre);
        if($dias){
            back()->with('mensaje', 'El dia ya existe en tu horario')->redirect(); 
        }else{ 
            (new HorarioModel())->create($id_especialista, $nombre, $hora_inicio_m, $hora_fin_m, $hora_inicio_t, $hora_fin_t, $estado);   
            return back()->redirect(); 
        } 
    } 
    function update()
    {      
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $es = $_POST['estado'];
            $horas_inicio_m = $_POST['hora_inicio_m'];
            $horas_fin_m = $_POST['hora_fin_m'];
            $horas_inicio_t = $_POST['hora_inicio_t'];
            $horas_fin_t = $_POST['hora_fin_t'];
            $ids = $_POST['id']; 
            $estados = array_values($es); 
            (new HorarioModel())->update($estados, $horas_inicio_m, $horas_fin_m, $horas_inicio_t, $horas_fin_t, $ids);   
            echo 1;  
        }   
    } 

    function destroy()
    {  
        (new EspecialidadModel())->destroy($_GET['id']);      
        return back()->redirect();
    } 
}
 
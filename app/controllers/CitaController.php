<?php
require_once '../config/template.php';  
require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/CitaModel.php');  
require_once(__DIR__ . '/../models/HorarioModel.php');  
require_once(__DIR__ . '/../models/EspecialidadModel.php');  
require_once(__DIR__ . '/../models/UsuarioModel.php');    
class CitaController extends Template
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
        // header('Content-Type: application/json');  
        $data = (new CitaModel())->getAll();     
        $especialidad = (new EspecialidadModel())->getAll();    
        $pacientes = (new UsuarioModel())->getByRol('Paciente');
       
        $this->render('administrador/cita/index',
         ['data' => $data,'especialidad'=>$especialidad,'pacientes'=>$pacientes ]
        ); 
    }  
    function validarHoras() {
        $fecha = $_POST["fecha"];
        $id_especialista = $_POST["id_especialista"]; 
        $dias= ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']; 
        $numero_dia = date('w', strtotime($fecha));
        $dia=$dias[$numero_dia];
        $dia_laboral = (new HorarioModel())->getDia($id_especialista,$dia,1); 
        if ($dia_laboral) {  
            $data = (new CitaModel())->horas($id_especialista,$fecha); 
            $horasocupadas =[];   
            foreach ($data as &$row) {  
                array_push($horasocupadas,  $row['hora_cita']);
            }  
            $turnomañana= $this->crearHoras($horasocupadas,$dia_laboral['hora_inicio_m'],$dia_laboral['hora_fin_m']);
            $turnotarde= $this->crearHoras($horasocupadas,$dia_laboral['hora_inicio_t'],$dia_laboral['hora_fin_t']);
            $resultado = array_merge($turnomañana, $turnotarde); 
            echo json_encode($resultado);
        } else{
            echo true;
        } 
    }
    function crearHoras($horasocupadas,$inicio,$fin){
        $hora_inicio = strtotime($inicio);
        $hora_fin = strtotime($fin);
        $rangos_horas = array(); 
        for ($i = $hora_inicio; $i < $hora_fin; $i += 3600) {
            $hora_actual = date('H:i', $i);
            $hora_siguiente = date('H:i', $i + 3600); 
            if (in_array($hora_actual, $horasocupadas)) {
                continue;
            } 
            $rango_horas = "$hora_actual-$hora_siguiente";
            $rangos_horas[] = $rango_horas;
        } 
        return $rangos_horas;
    }
    function store()
    {     
        if (isset($_POST['id'])&& $_POST['id']>0) {  
            $id=$_POST['id'] ; 
            $nombre=$_POST['nombre'] ;
            (new CitaModel())->update($id,$nombre);   
            return back()->redirect();
        }else{     
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

    function actualizarEstado()
    {  
        (new CitaModel())->updatestado($_GET['id'],$_GET['estado']);      
        return back()->redirect();
    } 
    function destroy()
    {  
        (new CitaModel())->destroy($_GET['id']);      
        return back()->redirect();
    } 
} 
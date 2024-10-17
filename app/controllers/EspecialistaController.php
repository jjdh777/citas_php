<?php 
require_once '../config/template.php';   
require_once(__DIR__ . '/LoginController.php'); 
require_once(__DIR__ . '/../models/EspecialistaModel.php');  
require_once(__DIR__ . '/../models/EspecialidadModel.php');  
class EspecialistaController  extends Template
{
     
    public function __construct()
    {
        if (!isset($_COOKIE["usuario"])) {
            $loginController = new LoginController();
            $loginController->index();
            exit();
        }
    }
    function index()
    {
        $user = (new EspecialistaModel())->getAll();
        $especialidad = (new EspecialidadModel())->getAll();
        $this->render('administrador/especialista/index', ['data' => $user, 'especialidad' => $especialidad]);
    }
    function store()
    { 
        if (isset($_POST['id']) && $_POST['id'] > 0) {
            $id = $_POST['id'];
            $dni = $_POST['dni'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $id_especialidad = $_POST['id_especialidad'];
            $genero = $_POST['genero'];
            $telefono = $_POST['telefono'];
            $nacimiento = $_POST['nacimiento'];
            $correo = $_POST['correo'];
            $nacionalidad = $_POST['nacionalidad'];
            (new EspecialistaModel())->update($id, $dni, $nombres, $apellidos, $id_especialidad, $genero, $telefono, $nacimiento, $correo, $nacionalidad); 
            back()->with('mensaje', 'datos actualizados correctamente')->redirect(); 
        } else { 
            $dni = $_POST['dni'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $id_especialidad = $_POST['id_especialidad'];
            $genero = $_POST['genero'];
            $telefono = $_POST['telefono'];
            $nacimiento = $_POST['nacimiento'];
            $correo = $_POST['correo'];
            $nacionalidad = $_POST['nacionalidad'];
            (new EspecialistaModel())->create($dni, $nombres, $apellidos, $id_especialidad, $genero, $telefono, $nacimiento, $correo, $nacionalidad);
            return back()->redirect();
            back()->with('mensaje', 'se guardo correctamente')->redirect(); 
        }
    }
    function getByEspecialidad()  {
        $id_Especialista= isset($_POST["id_especialidad"])?$_POST["id_especialidad"]:0;
        $data=(new EspecialistaModel())->getByEsp($id_Especialista);
        echo json_encode($data);
    }
    function destroy()
    {
        (new EspecialistaModel())->destroy($_GET['id']);
        return back()->redirect();
    }
}

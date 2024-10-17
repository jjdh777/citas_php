<?php
require_once  '../config/bd.php'; 

class CitaModel extends BD
{ 
    public function __construct()
    {  
         
    }

    public function getAll()
    {
        $query = $this->conexion()->query("SELECT c.*, u.nombres AS nombre_paciente,u.apellidos AS apellidos_paciente, e.nombre AS nombre_especialidad, ps.nombres AS nombre_especialista, ps.apellidos AS apellidos_especialista
                                            FROM citas as c
                                            INNER JOIN usuarios as u ON c.id_paciente = u.id
                                            INNER JOIN especialidades as e ON c.id_especialidad = e.id
                                            INNER JOIN especialista as ps ON c.id_especialista = ps.id ORDER BY c.id DESC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

 
    public function getIdPaciente($id)
    {  
        $query = $this->conexion()->query("SELECT c.*, u.nombres AS nombre_paciente, u.apellidos AS apellidos_paciente, e.nombre AS nombre_especialidad, ps.nombres AS nombre_especialista, ps.apellidos AS apellidos_especialista
                                FROM citas as c
                                INNER JOIN usuarios as u ON c.id_paciente = u.id
                                INNER JOIN especialidades as e ON c.id_especialidad = e.id
                                INNER JOIN especialista as ps ON c.id_especialista = ps.id
                                WHERE c.id_paciente = '$id'
                                ORDER BY c.id DESC"); 
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function horas($id,$fecha)
    {
        $query = $this->conexion()->prepare("SELECT * FROM citas WHERE id_especialista = ? AND fecha_cita =?");
        $query->execute([$id,$fecha]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id)
    {
        $query = $this->conexion()->prepare("SELECT * FROM citas WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
   
    public function create($descripcion,$id_paciente,$id_especialidad, $id_especialista, $fecha_cita,$hora_cita,$estado='pendiente')
    {     
        $created_at = date('Y-m-d'); 
        $query = $this->conexion()->prepare("INSERT INTO citas (descripcion, id_paciente, id_especialidad, id_especialista,   fecha_cita, hora_cita, estado, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$descripcion, $id_paciente, $id_especialidad, $id_especialista,   $fecha_cita, $hora_cita, $estado, $created_at]);
        return $this->conexion()->lastInsertId();
        

    }
 
    public function update($id, $nombre)
    {  
        $query = $this->conexion()->prepare("UPDATE citas SET  nombre=? WHERE id=?");
        $query->execute([$nombre ,$id]);
        return $query->rowCount();    
    } 
    public function updatestado($id, $estado)
    {  
        $query = $this->conexion()->prepare("UPDATE citas SET  estado=? WHERE id=?");
        $query->execute([$estado ,$id]);
        return $query->rowCount();    
    } 
    public function destroy($id)
    {
        $query = $this->conexion()->prepare("DELETE FROM citas WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}

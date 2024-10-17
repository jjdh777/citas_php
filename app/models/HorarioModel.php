<?php
require_once  '../config/bd.php'; 
class HorarioModel extends BD
{ 
    public function __construct()
    {  
         
    }

    public function getAllEspecialista($id_especialista)
    {   
        $query = $this->conexion()->prepare("SELECT * FROM horarios WHERE id_especialista = ?");
        $query->execute([$id_especialista]);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getByNombre($id_especialista,$nombre )
    {   
        $query = $this->conexion()->prepare("SELECT * FROM horarios WHERE id_especialista = ? and nombre =?  ");
        $query->execute([$id_especialista,$nombre]);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getDia($id_especialista,$nombre,$estado)
    {   
        $query = $this->conexion()->prepare("SELECT * FROM horarios WHERE id_especialista = ? and nombre =? and estado=?");
        $query->execute([$id_especialista,$nombre,$estado]);
        return $query->fetch(PDO::FETCH_ASSOC); 
    }
 
    public function getById($id)
    {
        $query = $this->conexion()->prepare("SELECT * FROM horarios WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
   
    public function create($id_especialista, $nombre, $hora_inicio_m, $hora_fin_m, $hora_inicio_t, $hora_fin_t, $estado)
    {   
        $query = $this->conexion()->prepare("INSERT INTO horarios (id_especialista, nombre, hora_inicio_m, hora_fin_m, hora_inicio_t, hora_fin_t, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$id_especialista, $nombre, $hora_inicio_m, $hora_fin_m, $hora_inicio_t, $hora_fin_t, $estado]); 
        return $this->conexion()->lastInsertId();
    }
    public function update($estados, $horas_inicio_m, $horas_fin_m, $horas_inicio_t, $horas_fin_t, $ids)
    {
        $pdo = $this->conexion();  
        $stmt = $pdo->prepare("UPDATE horarios SET estado = ?, hora_inicio_m = ?, hora_fin_m = ?, hora_inicio_t = ?, hora_fin_t = ? WHERE id = ?"); 
        for ($i = 0; $i < count($estados); $i++) {
            $stmt->execute([$estados[$i], $horas_inicio_m[$i], $horas_fin_m[$i], $horas_inicio_t[$i], $horas_fin_t[$i], $ids[$i]]);
        }
    }
  
    public function destroy($id)
    {
        $query = $this->conexion()->prepare("DELETE FROM horarios WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}

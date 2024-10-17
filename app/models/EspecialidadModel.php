<?php
require_once  '../config/bd.php'; 
class EspecialidadModel extends BD
{ 
    public function __construct()
    {  
         
    }

    public function getAll()
    {   
        $query = $this->conexion()->query("SELECT * FROM especialidades");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function getById($id)
    {
        $query = $this->conexion()->prepare("SELECT * FROM especialidades WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
   
    public function create($nombre )
    {   
        $query = $this->conexion()->prepare("INSERT INTO especialidades (nombre ) VALUES (?)");
        $query->execute([$nombre]);
        return $this->conexion()->lastInsertId();
    }
 
    public function update($id, $nombre)
    {  
        $query = $this->conexion()->prepare("UPDATE especialidades SET  nombre=? WHERE id=?");
        $query->execute([$nombre ,$id]);
        return $query->rowCount();    
    } 
    public function destroy($id)
    {
        $query = $this->conexion()->prepare("DELETE FROM especialidades WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}

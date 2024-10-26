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
   
    public function create($nombre,$nombre2,$notas, $f_alta )
    {   
        $query = $this->conexion()->prepare("INSERT INTO especialidades (nombre,nombre2,notas, f_alta ) VALUES (?,?,?,?)");
        $query->execute([$nombre,$nombre2,$notas,$f_alta]);
        return $this->conexion()->lastInsertId();
    }
 
    public function update($id, $nombre,$nombre2,$notas,$f_alta)
    {  
        $query = $this->conexion()->prepare("UPDATE especialidades SET  nombre=?, nombre2=?,notas=?,f_alta=? WHERE id=?");
        $query->execute([$nombre,$nombre2,$notas,$f_alta ,$id]);
        return $query->rowCount();    
    } 
    public function destroy($id)
    {
        $query = $this->conexion()->prepare("DELETE FROM especialidades WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}

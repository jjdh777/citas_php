<?php
require_once  '../config/bd.php';
class EspecialistaModel extends BD
{
    public function __construct()
    {
    }

    public function getAll()
    {
        $query = $this->conexion()->query("SELECT p.*, e.nombre  AS especialidad  
                                        FROM especialista as p
                                        INNER JOIN especialidades as e ON p.id_especialidad = e.id ");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->conexion()->prepare("SELECT * FROM especialista WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getByEsp($id)
    {
        $query = $this->conexion()->prepare("SELECT * FROM especialista WHERE id_especialidad = :id_especialidad");
        $query->execute(['id_especialidad' => $id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($dni, $nombres, $apellidos, $id_especialidad, $genero, $telefono, $nacimiento, $correo, $nacionalidad)
    {
        $query = $this->conexion()->prepare("INSERT INTO especialista (dni, nombres, apellidos, id_especialidad, genero, telefono, nacimiento, correo, nacionalidad) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute([$dni, $nombres, $apellidos, $id_especialidad, $genero, $telefono, $nacimiento, $correo, $nacionalidad]);
        return $this->conexion()->lastInsertId();
    }

    public function update($id, $dni, $nombres, $apellidos, $id_especialidad, $genero, $telefono, $nacimiento, $correo, $nacionalidad)
    {
        $query = $this->conexion()->prepare("UPDATE especialista SET dni=?, nombres=?, apellidos=?, id_especialidad=?, genero=?, telefono=?, nacimiento=?, correo=?, nacionalidad=? WHERE id=?");
        $query->execute([$dni, $nombres, $apellidos, $id_especialidad, $genero, $telefono, $nacimiento, $correo, $nacionalidad, $id]);
        return $query->rowCount();
    }

    public function destroy($id)
    {
        $query = $this->conexion()->prepare("DELETE FROM especialista WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}

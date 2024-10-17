<?php
require_once  '../config/bd.php'; 
class UsuarioModel extends BD
{ 
    public function __construct()
    {  
         
    }

    public function getAll()
    {
        $query = $this->conexion()->query("SELECT * FROM usuarios");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByRolDESC($rol)
    { 
        $query = $this->conexion()->prepare("SELECT * FROM usuarios WHERE rol = ? ORDER BY id DESC");
        $query->execute([$rol]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByRol($rol)
    { 
        $query = $this->conexion()->prepare("SELECT * FROM usuarios WHERE rol = ? ORDER BY nombres ASC");
        $query->execute([$rol]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByRolLimit($rol)
    { 
        $query = $this->conexion()->prepare("SELECT * FROM usuarios WHERE rol = ? ORDER BY id DESC LIMIT 5");
        $query->execute([$rol]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->conexion()->prepare("SELECT * FROM usuarios WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getByUser($email)
    {
        $query = $this->conexion()->prepare("SELECT * FROM usuarios WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function create($rol, $email, $contrasenia,$dni=0, $nombres='', $apellidos='',  $telefono='', $genero='')
    {   
        $created_at = date('Y-m-d'); 
        $query = $this->conexion()->prepare("INSERT INTO usuarios (rol, email, contrasenia,dni, nombres, apellidos, telefono, genero,created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$rol,   $email, $contrasenia,$dni, $nombres, $apellidos,  $telefono, $genero,$created_at ]);
        return $this->conexion()->lastInsertId();
    }
 
    public function update($id,  $email, $contrasenia, $dni= 0, $nombres = '', $apellidos = '',   $telefono = '', $genero = '')
    { 
        if ($contrasenia==''){ 
            $query = $this->conexion()->prepare("UPDATE usuarios SET   email=?,   dni=?, nombres=?, apellidos=?,  telefono=?, genero=? WHERE id=?");
            $query->execute([$email, $dni,$nombres, $apellidos,  $telefono, $genero, $id]);
            return $query->rowCount();    
        }else{
            $query = $this->conexion()->prepare("UPDATE usuarios SET   email=?, contrasenia=?, dni=?, nombres=?, apellidos=?,  telefono=?, genero=? WHERE id=?");
            $query->execute([ $email,  $contrasenia, $dni,$nombres, $apellidos,  $telefono, $genero,$id]);
            return $query->rowCount();    
        }
    } 
    public function destroy($id)
    {
        $query = $this->conexion()->prepare("DELETE FROM usuarios WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}

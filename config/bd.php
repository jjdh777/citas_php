<?php
class BD
{
    function conexion()
    {
        try {
            $pdo = new PDO(
                "mysql:host=localhost;
                dbname=php_citas",
                'root',
                ''
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }
}

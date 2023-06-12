<?php

class Database{
    private $host = 'localhost';
    private $db_name = 'ventas';
    private $username = 'root';
    private $password = 'pass';
    private $conn;

    public function getConnection(){
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(array(
                'error' => 'Error de conexión a la base de datos: ' . $e->getMessage()
            ));
            exit();
        }

        return $this->conn;
    }

}
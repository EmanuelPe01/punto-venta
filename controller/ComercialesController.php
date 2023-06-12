<?php

require_once 'config/database.php';

class ComercialesController{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllComerciales(){
        try{
            $query = 'SELECT * FROM comercial';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $comerciales = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($comerciales){
                $response = array(
                    'status' => 'ok',
                    'data' => $comerciales
                );
            } else {
                $response = array(
                    'status' => 'ok',
                    'data' => array()
                );
            }

            echo json_encode($response);
        } catch (PDOException $ex){
            echo json_encode(array(
                'Error' => 'Error en la base de datos: ' . $ex->getMessage()
            ));
        }
    }

    public function saveComercial(){
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if($data === null){
            http_response_code(400);
            echo json_encode(['error' => 'Datos inválidos']);
            return;
        }

        $name = $data['nombre'];
        $apellidoP = $data['apellidoP'];
        $apellidoM = $data['apellidoM'];
        $comision = doubleval($data['comision']);

        try{
            $query = 'CALL saveComercial(:name, :apellidoP, :apellidoM, :comision);';
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':apellidoP', $apellidoP);
            $stmt->bindValue(':apellidoM', $apellidoM);
            $stmt->bindValue(':comision', $comision);

            $stmt -> execute();

            $response = [
                'status' => 'ok'
            ];

            echo json_encode($response);

        } catch (PDOException $ex){
            echo json_encode(['Error' => "Error en la base de datos" . $ex->getMessage()]);
        }

    }
}
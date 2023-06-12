<?php
require_once './config/database.php';

class ClientesController{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllClientes(){
        try{
            $query = 'SELECT * FROM cliente';  
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($clientes){
                $response = array (
                    'status' => 'ok',
                    'data' => $clientes
                );
            } else {
                $response = array (
                    'status' => 'ok',
                    'data' => array()
                );
            }
            echo json_encode($response);          

        } catch (PDOException $ex){
            echo json_encode( array(
                'Error' => "Error en la base de datos" . $ex->getMessage()
            ));
        }
    }

    public function createCliente(){
        $json = file_get_contents('php://input');
        $data = json_decode ($json, true);

        if($data === null){
            http_response_code(400);
            echo json_encode(['error'=> 'Datos inválidos']);
            return;
        }

        $name = $data['nombre'];
        $apellidoP = $data['apellidoP'];
        $apellidoM = $data['apellidoM'];
        $Ciudad = $data['ciudad'];
        $Categoria = intval($data['categoria']);

        try {
            $query = "CALL saveClient(:nombre, :apellidoP, :apellidoM, :ciudad, :categoria);";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':nombre', $name);
            $stmt->bindValue(':apellidoP', $apellidoP);
            $stmt->bindValue(':apellidoM', $apellidoM);
            $stmt->bindValue('ciudad', $Ciudad);
            $stmt->bindValue('categoria', $Categoria);

            $stmt->execute();

            $response = [
                'message' => 'Usuario creado correctamente',
                'status' => 'ok'
            ];

            echo json_encode($response);
        } catch (PDOException $ex){
            echo json_encode( array(
                'Error' => "Error en la base de datos" . $ex->getMessage()
            ));
        }
    }
}
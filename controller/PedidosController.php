<?php
require_once 'config/database.php';

class PedidosController {
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    
    public function getAll(){        
        try {
            $query = 'CALL getClienteComercial();';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($pedidos){
                $response = array('data' => $pedidos);
            } else {
                $response = array('data' => array());
            }

            echo json_encode($response);
        } catch (PDOException $ex){
            echo json_encode( array(
                'Error' => "Error en la base de datos" . $ex->getMessage()
            ));
        }
    }

    public function getFechas(){
        try {
            $query = 'select distinct year(fecha) as anio from pedido order by fecha desc;';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $fechas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($fechas){
                $response = array('data' => $fechas);
            } else {
                $response = array('data' => array());
            }

            echo json_encode($response);
        } catch (PDOException $ex){
            echo json_encode( array(
                'Error' => "Error en la base de datos" . $ex->getMessage()
            ));
        }
    }

    public function savePedido(){
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if($data === null){
            http_response_code(404);
            echo json_encode(["Error" => "No se encontraron datos"]);
            return;
        }

        $total = doubleval($data['total']);
        $fecha = $data['fecha'];
        $id_cliente = intval($data['id_cliente']);
        $id_comercial = intval($data['id_comercial']);

        try {
            $query = "CALL savePedido(:total, :fecha, :id_cliente, :id_comercial);";
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':total', $total);
            $stmt->bindValue(':fecha', $fecha);
            $stmt->bindValue(':id_cliente', $id_cliente);
            $stmt->bindValue(':id_comercial', $id_comercial);

            $stmt->execute();

            $response = array(
                'Status' => 'ok'
            );

            echo json_encode($response);
        } catch (PDOException $ex){
            echo json_encode(['Error' => 'Error de base de datos: '.$ex->getMessage()]);
        }
    }
}
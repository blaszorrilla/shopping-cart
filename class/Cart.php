<?php

include("DBConnection.php");
class Cart {
    protected $db;
    private $_sku;

    public function setSKU($sku) {
        $this->_sku = $sku;
    }

    public function __construct() {
        try {
            $this->db = new DBConnection();
            $this->db = $this->db->returnConnection();
        } catch (Exception $e) {
            // Registra o maneja la excepción
            throw new Exception("Error al crear la conexión a la BD: " . $e->getMessage());
        }
    }

    // Obtener todos los productos
    public function getAllProduct() {
        try {
            $sql = "SELECT * FROM products";
            $stmt = $this->db->prepare($sql);

            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            // Registra o lanza la excepción para un mejor manejo de errores
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    // Obtener producto
    public function getProduct() {
        try{
            $sql = "SELECT * FROM products WHERE sku=:sku";
            $stmt = $this->db->prepare($sql);
            $data = [
                'sku' => $this->_sku
            ];
            $stmt->execute($data);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;

        }catch(Exception $e){
            //registra errores
            throw new Exception("Error en la consulta: ".$e->getMessage());

        }
    }
}
?>
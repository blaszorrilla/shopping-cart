<?php
class DBConnection {
    private $_dbHostname = "localhost";
    private $_dbName = "demo_db";
    private $_dbUsername = "root";
    private $_dbPassword = ""; //agrega contraseña de tu bd
    private $_con;

    public function __construct() {
        try {
            $this->_con = new PDO("mysql:host=$this->_dbHostname;dbname=$this->_dbName", $this->_dbUsername, $this->_dbPassword);
            $this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Registra o lanza la excepción para un mejor manejo de errores
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    // Devuelve la conexión
    public function returnConnection() {
        return $this->_con;
    }
}
?>
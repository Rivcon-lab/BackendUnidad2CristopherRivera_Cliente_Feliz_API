<?php
class Database {
    // Configuración de la base de datos
    private $host = "localhost";
    private $db_name = "cliente_feliz";
    private $username = "root";  // Cambiar según tu configuración
    private $password = "";      // Cambiar según tu configuración
    public $conn;

    // Método para obtener la conexión
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
}   
?>




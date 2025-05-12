<?php
class OfertaLaboral {
    private $conn;
    private $table_name = "OfertaLaboral";

    public $id;
    public $titulo;
    public $descripcion;
    public $ubicacion;
    public $salario;
    public $tipo_contrato;
    public $fecha_publicacion;
    public $fecha_cierre;
    public $estado;
    public $reclutador_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodas() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error al obtener ofertas: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPorId($id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener oferta por ID: " . $e->getMessage());
            return false;
        }
    }

    public function crear($data) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (titulo, descripcion, ubicacion, salario, tipo_contrato, fecha_cierre, estado, reclutador_id)
                      VALUES (:titulo, :descripcion, :ubicacion, :salario, :tipo_contrato, :fecha_cierre, :estado, :reclutador_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':salario', $data['salario']);
            $stmt->bindParam(':tipo_contrato', $data['tipo_contrato']);
            $stmt->bindParam(':fecha_cierre', $data['fecha_cierre']);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':reclutador_id', $data['reclutador_id']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear oferta: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($id, $data) {
        try {
            $query = "UPDATE " . $this->table_name . " SET titulo = :titulo, descripcion = :descripcion, ubicacion = :ubicacion, salario = :salario, tipo_contrato = :tipo_contrato, fecha_cierre = :fecha_cierre, estado = :estado WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':titulo', $data['titulo']);
            $stmt->bindParam(':descripcion', $data['descripcion']);
            $stmt->bindParam(':ubicacion', $data['ubicacion']);
            $stmt->bindParam(':salario', $data['salario']);
            $stmt->bindParam(':tipo_contrato', $data['tipo_contrato']);
            $stmt->bindParam(':fecha_cierre', $data['fecha_cierre']);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar oferta: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $query = "UPDATE " . $this->table_name . " SET estado = 'Cerrada' WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al cerrar oferta: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerVigentes() {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE estado = 'Vigente'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error al obtener ofertas vigentes: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPorReclutador($reclutador_id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE reclutador_id = :reclutador_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':reclutador_id', $reclutador_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error al obtener ofertas por reclutador: " . $e->getMessage());
            return false;
        }
    }
} 
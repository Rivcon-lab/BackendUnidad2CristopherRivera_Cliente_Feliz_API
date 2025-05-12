<?php
class AntecedenteLaboral {
    private $conn;
    private $table_name = "AntecedenteLaboral";

    public $id;
    public $candidato_id;
    public $empresa;
    public $cargo;
    public $funciones;
    public $fecha_inicio;
    public $fecha_termino;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($data) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (candidato_id, empresa, cargo, funciones, fecha_inicio, fecha_termino)
                      VALUES (:candidato_id, :empresa, :cargo, :funciones, :fecha_inicio, :fecha_termino)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':candidato_id', $data['candidato_id']);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':cargo', $data['cargo']);
            $stmt->bindParam(':funciones', $data['funciones']);
            $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
            $stmt->bindParam(':fecha_termino', $data['fecha_termino']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear antecedente laboral: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($id, $data) {
        try {
            $query = "UPDATE " . $this->table_name . " SET empresa = :empresa, cargo = :cargo, funciones = :funciones, fecha_inicio = :fecha_inicio, fecha_termino = :fecha_termino WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':empresa', $data['empresa']);
            $stmt->bindParam(':cargo', $data['cargo']);
            $stmt->bindParam(':funciones', $data['funciones']);
            $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
            $stmt->bindParam(':fecha_termino', $data['fecha_termino']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar antecedente laboral: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar antecedente laboral: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPorCandidato($candidato_id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE candidato_id = :candidato_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':candidato_id', $candidato_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error al obtener antecedentes laborales: " . $e->getMessage());
            return false;
        }
    }
} 
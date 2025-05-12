<?php
class Postulacion {
    private $conn;
    private $table_name = "Postulacion";

    public $id;
    public $candidato_id;
    public $oferta_laboral_id;
    public $estado_postulacion;
    public $comentario;
    public $fecha_postulacion;
    public $fecha_actualizacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($data) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (candidato_id, oferta_laboral_id, estado_postulacion, comentario)
                      VALUES (:candidato_id, :oferta_laboral_id, :estado_postulacion, :comentario)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':candidato_id', $data['candidato_id']);
            $stmt->bindParam(':oferta_laboral_id', $data['oferta_laboral_id']);
            $stmt->bindParam(':estado_postulacion', $data['estado_postulacion']);
            $stmt->bindParam(':comentario', $data['comentario']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear postulación: " . $e->getMessage());
            throw $e;
        }
    }

    public function actualizar($id, $data) {
        try {
            $query = "UPDATE " . $this->table_name . " SET estado_postulacion = :estado_postulacion, comentario = :comentario WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':estado_postulacion', $data['estado_postulacion']);
            $stmt->bindParam(':comentario', $data['comentario']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar postulación: " . $e->getMessage());
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
            error_log("Error al obtener postulaciones por candidato: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerPorOferta($oferta_laboral_id) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE oferta_laboral_id = :oferta_laboral_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':oferta_laboral_id', $oferta_laboral_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error al obtener postulaciones por oferta: " . $e->getMessage());
            return false;
        }
    }
} 
<?php
class AntecedenteAcademico {
    private $conn;
    private $table_name = "AntecedenteAcademico";

    public $id;
    public $candidato_id;
    public $institucion;
    public $titulo_obtenido;
    public $anio_ingreso;
    public $anio_egreso;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($data) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (candidato_id, institucion, titulo_obtenido, anio_ingreso, anio_egreso)
                      VALUES (:candidato_id, :institucion, :titulo_obtenido, :anio_ingreso, :anio_egreso)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':candidato_id', $data['candidato_id']);
            $stmt->bindParam(':institucion', $data['institucion']);
            $stmt->bindParam(':titulo_obtenido', $data['titulo_obtenido']);
            $stmt->bindParam(':anio_ingreso', $data['anio_ingreso']);
            $stmt->bindParam(':anio_egreso', $data['anio_egreso']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al crear antecedente académico: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($id, $data) {
        try {
            $query = "UPDATE " . $this->table_name . " SET institucion = :institucion, titulo_obtenido = :titulo_obtenido, anio_ingreso = :anio_ingreso, anio_egreso = :anio_egreso WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':institucion', $data['institucion']);
            $stmt->bindParam(':titulo_obtenido', $data['titulo_obtenido']);
            $stmt->bindParam(':anio_ingreso', $data['anio_ingreso']);
            $stmt->bindParam(':anio_egreso', $data['anio_egreso']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar antecedente académico: " . $e->getMessage());
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
            error_log("Error al eliminar antecedente académico: " . $e->getMessage());
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
            error_log("Error al obtener antecedentes académicos: " . $e->getMessage());
            return false;
        }
    }
} 
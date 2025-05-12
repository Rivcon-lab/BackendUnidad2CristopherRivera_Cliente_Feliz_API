<?php
class AntecedenteAcademicoController {
    private $antecedente;

    public function __construct($db) {
        $this->antecedente = new AntecedenteAcademico($db);
    }

    public function crearAntecedente($data) {
        if ($this->antecedente->crear($data)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Antecedente académico creado correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo crear el antecedente académico."]);
        }
    }

    public function actualizarAntecedente($id, $data) {
        if ($this->antecedente->actualizar($id, $data)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Antecedente académico actualizado correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo actualizar el antecedente académico."]);
        }
    }

    public function eliminarAntecedente($id) {
        if ($this->antecedente->eliminar($id)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Antecedente académico eliminado correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo eliminar el antecedente académico."]);
        }
    }

    public function obtenerPorCandidato($candidato_id) {
        $stmt = $this->antecedente->obtenerPorCandidato($candidato_id);
        if ($stmt && $stmt->rowCount() > 0) {
            $antecedentes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $antecedentes[] = $row;
            }
            http_response_code(200);
            echo json_encode($antecedentes);
        } else if ($stmt) {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se encontraron antecedentes académicos para este candidato."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al obtener antecedentes académicos."]);
        }
    }
} 
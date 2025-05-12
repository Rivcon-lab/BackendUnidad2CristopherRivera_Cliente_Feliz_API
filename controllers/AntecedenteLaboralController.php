<?php
class AntecedenteLaboralController {
    private $antecedente;

    public function __construct($db) {
        $this->antecedente = new AntecedenteLaboral($db);
    }

    public function crearExperiencia($data) {
        if ($this->antecedente->crear($data)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Experiencia laboral creada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo crear la experiencia laboral."]);
        }
    }

    public function actualizarExperiencia($id, $data) {
        if ($this->antecedente->actualizar($id, $data)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Experiencia laboral actualizada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo actualizar la experiencia laboral."]);
        }
    }

    public function eliminarExperiencia($id) {
        if ($this->antecedente->eliminar($id)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Experiencia laboral eliminada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo eliminar la experiencia laboral."]);
        }
    }

    public function obtenerPorCandidato($candidato_id) {
        $stmt = $this->antecedente->obtenerPorCandidato($candidato_id);
        if ($stmt && $stmt->rowCount() > 0) {
            $experiencias = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $experiencias[] = $row;
            }
            http_response_code(200);
            echo json_encode($experiencias);
        } else if ($stmt) {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se encontró experiencia laboral para este candidato."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al obtener experiencia laboral."]);
        }
    }
} 
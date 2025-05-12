<?php
class PostulacionController {
    private $postulacion;

    public function __construct($db) {
        $this->postulacion = new Postulacion($db);
    }

    public function crearPostulacion($data) {
        if ($this->postulacion->crear($data)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Postulación creada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo crear la postulación."]);
        }
    }

    public function actualizarPostulacion($id, $data) {
        if ($this->postulacion->actualizar($id, $data)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Postulación actualizada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo actualizar la postulación."]);
        }
    }

    public function obtenerPorCandidato($candidato_id) {
        $stmt = $this->postulacion->obtenerPorCandidato($candidato_id);
        if ($stmt && $stmt->rowCount() > 0) {
            $postulaciones = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $postulaciones[] = $row;
            }
            http_response_code(200);
            echo json_encode($postulaciones);
        } else if ($stmt) {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se encontraron postulaciones para este candidato."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al obtener postulaciones por candidato."]);
        }
    }

    public function obtenerPorOferta($oferta_laboral_id) {
        $stmt = $this->postulacion->obtenerPorOferta($oferta_laboral_id);
        if ($stmt && $stmt->rowCount() > 0) {
            $postulaciones = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $postulaciones[] = $row;
            }
            http_response_code(200);
            echo json_encode($postulaciones);
        } else if ($stmt) {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se encontraron postulaciones para esta oferta."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al obtener postulaciones por oferta."]);
        }
    }
} 
<?php
class OfertaLaboralController {
    private $ofertaLaboral;

    public function __construct($db) {
        $this->ofertaLaboral = new OfertaLaboral($db);
    }

    public function obtenerOfertas() {
        $stmt = $this->ofertaLaboral->obtenerTodas();
        if ($stmt && $stmt->rowCount() > 0) {
            $ofertas = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ofertas[] = $row;
            }
            http_response_code(200);
            echo json_encode($ofertas);
        } else if ($stmt) {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se encontraron ofertas."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al obtener ofertas."]);
        }
    }

    public function obtenerOferta($id) {
        $oferta = $this->ofertaLaboral->obtenerPorId($id);
        if ($oferta) {
            http_response_code(200);
            echo json_encode($oferta);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "Oferta no encontrada."]);
        }
    }

    public function crearOferta($data) {
        if ($this->ofertaLaboral->crear($data)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Oferta creada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo crear la oferta."]);
        }
    }

    public function actualizarOferta($id, $data) {
        if ($this->ofertaLaboral->actualizar($id, $data)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Oferta actualizada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo actualizar la oferta."]);
        }
    }

    public function eliminarOferta($id) {
        if ($this->ofertaLaboral->eliminar($id)) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Oferta cerrada correctamente."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo cerrar la oferta."]);
        }
    }

    public function obtenerOfertasVigentes() {
        $stmt = $this->ofertaLaboral->obtenerVigentes();
        if ($stmt && $stmt->rowCount() > 0) {
            $ofertas = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ofertas[] = $row;
            }
            http_response_code(200);
            echo json_encode($ofertas);
        } else if ($stmt) {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se encontraron ofertas vigentes."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al obtener ofertas vigentes."]);
        }
    }

    public function obtenerOfertasPorReclutador($reclutador_id) {
        $stmt = $this->ofertaLaboral->obtenerPorReclutador($reclutador_id);
        if ($stmt && $stmt->rowCount() > 0) {
            $ofertas = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ofertas[] = $row;
            }
            http_response_code(200);
            echo json_encode($ofertas);
        } else if ($stmt) {
            http_response_code(404);
            echo json_encode(["mensaje" => "No se encontraron ofertas para este reclutador."]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al obtener ofertas por reclutador."]);
        }
    }
} 
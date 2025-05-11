<?php
class UsuarioController {
    private $db;
    private $usuario;

    public function __construct($db) {
        $this->db = $db;
        $this->usuario = new Usuario($db);
    }

    // Obtener todos los usuarios
    public function obtenerUsuarios() {
        $stmt = $this->usuario->obtenerTodos();
        $num = $stmt->rowCount();

        if($num > 0) {
            $usuarios_arr = array();
            $usuarios_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $usuario_item = array(
                    "id" => $id,
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "email" => $email,
                    "rol" => $rol,
                    "estado" => $estado
                );
                array_push($usuarios_arr["records"], $usuario_item);
            }

            http_response_code(200);
            echo json_encode($usuarios_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("mensaje" => "No se encontraron usuarios."));
        }
    }

    // Obtener un usuario específico
    public function obtenerUsuario($id) {
        $this->usuario->id = $id;
        $stmt = $this->usuario->obtenerUno();
        $num = $stmt->rowCount();

        if($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);

            $usuario_item = array(
                "id" => $id,
                "nombre" => $nombre,
                "apellido" => $apellido,
                "email" => $email,
                "rol" => $rol,
                "estado" => $estado
            );

            http_response_code(200);
            echo json_encode($usuario_item);
        } else {
            http_response_code(404);
            echo json_encode(array("mensaje" => "Usuario no encontrado."));
        }
    }

    // Crear nuevo usuario
    public function crearUsuario($data) {
        if(
            !empty($data['nombre']) &&
            !empty($data['apellido']) &&
            !empty($data['email']) &&
            !empty($data['contraseña']) &&
            !empty($data['rol'])
        ) {
            $this->usuario->nombre = $data['nombre'];
            $this->usuario->apellido = $data['apellido'];
            $this->usuario->email = $data['email'];
            $this->usuario->contraseña = $data['contraseña'];
            $this->usuario->fecha_nacimiento = $data['fecha_nacimiento'] ?? null;
            $this->usuario->telefono = $data['telefono'] ?? null;
            $this->usuario->direccion = $data['direccion'] ?? null;
            $this->usuario->rol = $data['rol'];

            if($this->usuario->crear()) {
                http_response_code(201);
                echo json_encode(array("mensaje" => "Usuario creado exitosamente."));
            } else {
                http_response_code(503);
                echo json_encode(array("mensaje" => "No se pudo crear el usuario."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("mensaje" => "No se pudo crear el usuario. Datos incompletos."));
        }
    }

    // Actualizar usuario
    public function actualizarUsuario($id, $data) {
        $this->usuario->id = $id;
        $this->usuario->nombre = $data['nombre'] ?? null;
        $this->usuario->apellido = $data['apellido'] ?? null;
        $this->usuario->email = $data['email'] ?? null;
        $this->usuario->telefono = $data['telefono'] ?? null;
        $this->usuario->direccion = $data['direccion'] ?? null;
        $this->usuario->estado = $data['estado'] ?? null;

        if($this->usuario->actualizar()) {
            http_response_code(200);
            echo json_encode(array("mensaje" => "Usuario actualizado exitosamente."));
        } else {
            http_response_code(503);
            echo json_encode(array("mensaje" => "No se pudo actualizar el usuario."));
        }
    }

    // Eliminar usuario
    public function eliminarUsuario($id) {
        $this->usuario->id = $id;

        if($this->usuario->eliminar()) {
            http_response_code(200);
            echo json_encode(array("mensaje" => "Usuario eliminado exitosamente."));
        } else {
            http_response_code(503);
            echo json_encode(array("mensaje" => "No se pudo eliminar el usuario."));
        }
    }
} 
<?php
class Usuario {
    // Conexión a la base de datos
    private $conn;
    private $table_name = "Usuario";

    // Propiedades del objeto
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $clave;
    public $fecha_nacimiento;
    public $telefono;
    public $direccion;
    public $rol;
    public $estado;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los usuarios
    public function obtenerTodos() {
        $query = "SELECT id, nombre, apellido, email, rol, estado 
                 FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Obtener un usuario específico
    public function obtenerUno() {
        $query = "SELECT id, nombre, apellido, email, rol, estado 
                 FROM " . $this->table_name . "
                 WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;
    }

    // Crear nuevo usuario
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . "
                (nombre, apellido, email, clave, fecha_nacimiento, 
                 telefono, direccion, rol)
                VALUES
                (:nombre, :apellido, :email, :clave, :fecha_nacimiento,
                 :telefono, :direccion, :rol)";

        $stmt = $this->conn->prepare($query);

        // Sanitizar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->clave = password_hash($this->clave, PASSWORD_DEFAULT);
        $this->rol = htmlspecialchars(strip_tags($this->rol));

        // Vincular todos los valores con bindValue
        $stmt->bindValue(":nombre", $this->nombre);
        $stmt->bindValue(":apellido", $this->apellido);
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":clave", $this->clave);
        $stmt->bindValue(":rol", $this->rol);
        $stmt->bindValue(":fecha_nacimiento", $this->fecha_nacimiento !== null ? $this->fecha_nacimiento : null, PDO::PARAM_NULL);
        $stmt->bindValue(":telefono", $this->telefono !== null ? $this->telefono : null, PDO::PARAM_NULL);
        $stmt->bindValue(":direccion", $this->direccion !== null ? $this->direccion : null, PDO::PARAM_NULL);

        try {
            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error al crear usuario: " . $e->getMessage());
            throw $e;
        }
    }

    // Actualizar usuario
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . "
                SET nombre = :nombre,
                    apellido = :apellido,
                    email = :email,
                    telefono = :telefono,
                    direccion = :direccion,
                    estado = :estado
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitizar datos solo si no son null
        $this->nombre = $this->nombre !== null ? htmlspecialchars(strip_tags($this->nombre)) : null;
        $this->apellido = $this->apellido !== null ? htmlspecialchars(strip_tags($this->apellido)) : null;
        $this->email = $this->email !== null ? htmlspecialchars(strip_tags($this->email)) : null;
        $this->telefono = $this->telefono !== null ? htmlspecialchars(strip_tags($this->telefono)) : null;
        $this->direccion = $this->direccion !== null ? htmlspecialchars(strip_tags($this->direccion)) : null;
        $this->estado = $this->estado !== null ? htmlspecialchars(strip_tags($this->estado)) : null;
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar usuario
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
} 
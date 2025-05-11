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
    public $contraseña;
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
                (nombre, apellido, email, contraseña, fecha_nacimiento, 
                 telefono, direccion, rol)
                VALUES
                (:nombre, :apellido, :email, :contraseña, :fecha_nacimiento,
                 :telefono, :direccion, :rol)";

        $stmt = $this->conn->prepare($query);

        // Sanitizar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->contraseña = password_hash($this->contraseña, PASSWORD_DEFAULT);
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->rol = htmlspecialchars(strip_tags($this->rol));

        // Vincular valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contraseña", $this->contraseña);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":rol", $this->rol);

        if($stmt->execute()) {
            return true;
        }
        return false;
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

        // Sanitizar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
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

    // Insertar un nuevo usuario
    public function insertarUsuario($nombre, $apellido, $email, $contrasena, $fecha_nacimiento, $telefono, $direccion, $rol) {
        try {
            $query = "INSERT INTO Usuario (nombre, apellido, email, contraseña, fecha_nacimiento, telefono, direccion, rol) 
                      VALUES (:nombre, :apellido, :email, :contrasena, :fecha_nacimiento, :telefono, :direccion, :rol)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':rol', $rol);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al insertar usuario: " . $e->getMessage());
            return false;
        }
    }
} 
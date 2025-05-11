<?php
// Configuración de headers para CORS y tipo de contenido
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Manejo de peticiones OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Configuración de manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclusión de archivos necesarios
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/UsuarioController.php';
require_once __DIR__ . '/models/Usuario.php';

// Inicialización de la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Inicialización del controlador de usuarios
$usuarioController = new UsuarioController($db);

// Obtención del método HTTP de la petición
$method = $_SERVER['REQUEST_METHOD'];

// Procesamiento de la URL y obtención del ID si existe
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $path);

// Verificar si la ruta comienza con 'cliente-feliz-api'
if (isset($segments[0]) && $segments[0] === 'cliente-feliz-api') {
    array_shift($segments); // Eliminar 'cliente-feliz-api' del array
}

$id = null;
$endpoint = $segments[0] ?? '';

// Verificación del ID en la URL
if (isset($segments[1]) && is_numeric($segments[1])) {  
    $id = (int) $segments[1];
}

// Verificación del ID en parámetros GET
if (!$id && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
}

// Manejo de las diferentes peticiones HTTP
if ($endpoint === 'usuarios') {
    switch ($method) {
        case 'GET':
            if ($id) {
                $usuarioController->obtenerUsuario($id);  
            } else {
                $usuarioController->obtenerUsuarios();
            }
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $usuarioController->crearUsuario($data);
            break;

        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $usuarioController->actualizarUsuario($id, $data);
            break;

        case 'DELETE':
            if (!empty($id)) {
                $usuarioController->eliminarUsuario($id);
            } else {
                http_response_code(400);
                echo json_encode(["mensaje" => "Falta el parámetro 'id' para eliminar."]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["mensaje" => "Método $method no permitido"]);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
} 
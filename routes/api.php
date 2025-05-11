<?php
// Get the request URI and method
$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// Remove base path from URI
$base_path = '/cliente-feliz-api';
$path = str_replace($base_path, '', $request_uri);

// Remove query string
$path = parse_url($path, PHP_URL_PATH);

// Basic routing
switch ($path) {
    case '/':
        echo json_encode(['message' => 'Welcome to Cliente Feliz API']);
        break;
        
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
        break;
} 
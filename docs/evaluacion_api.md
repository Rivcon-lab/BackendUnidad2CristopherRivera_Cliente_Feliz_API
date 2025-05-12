# Documentación de Evaluación API - Cliente Feliz

## 1. Construcción de Rutas y Endpoints (CE2)

### 1.1 Disponibilidad y Funcionamiento (IL 1.3)
La API está construida siguiendo los principios REST y está disponible en:
```
Base URL: http://localhost/cliente-feliz-api
```

#### Endpoints Implementados:
1. **Usuarios**
   - GET `/usuarios` - Listar usuarios
   - GET `/usuarios/{id}` - Obtener usuario específico
   - POST `/usuarios` - Crear usuario
   - PUT `/usuarios/{id}` - Actualizar usuario completo
   - PATCH `/usuarios/{id}` - Actualizar usuario parcialmente
   - DELETE `/usuarios/{id}` - Eliminar usuario

2. **Ofertas Laborales**
   - GET `/ofertas` - Listar ofertas
   - GET `/ofertas/{id}` - Obtener oferta específica
   - POST `/ofertas` - Crear oferta
   - PUT `/ofertas/{id}` - Actualizar oferta completa
   - PATCH `/ofertas/{id}` - Actualizar oferta parcialmente
   - DELETE `/ofertas/{id}` - Eliminar oferta

3. **Postulaciones**
   - GET `/postulaciones` - Listar postulaciones
   - GET `/postulaciones?candidato_id={id}` - Filtrar por candidato
   - GET `/postulaciones?oferta_laboral_id={id}` - Filtrar por oferta
   - POST `/postulaciones` - Crear postulación
   - PUT `/postulaciones/{id}` - Actualizar postulación completa
   - PATCH `/postulaciones/{id}` - Actualizar postulación parcialmente

4. **Antecedentes Académicos**
   - GET `/academicos?candidato_id={id}` - Listar por candidato
   - POST `/academicos` - Crear antecedente
   - PUT `/academicos/{id}` - Actualizar antecedente completo
   - PATCH `/academicos/{id}` - Actualizar antecedente parcialmente
   - DELETE `/academicos/{id}` - Eliminar antecedente

5. **Antecedentes Laborales**
   - GET `/laborales?candidato_id={id}` - Listar por candidato
   - POST `/laborales` - Crear antecedente
   - PUT `/laborales/{id}` - Actualizar antecedente completo
   - PATCH `/laborales/{id}` - Actualizar antecedente parcialmente
   - DELETE `/laborales/{id}` - Eliminar antecedente

### 1.2 Controladores y Validación (CE3)
Cada controlador implementa:
- Validación de entradas JSON
- Manejo de errores
- Respuestas HTTP apropiadas
- Transacciones para mantener consistencia

#### Ejemplo de Validación:
```php
public function create(Request $request) {
    try {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:6',
            'tipo' => 'required|in:candidato,empresa'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        // Procesamiento de la solicitud
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error interno del servidor'
        ], 500);
    }
}
```

### 1.3 Request y Response (CE4)
Todos los endpoints devuelven respuestas JSON con la siguiente estructura:

#### Respuesta Exitosa:
```json
{
    "status": "success",
    "data": {
        // Datos específicos del recurso
    }
}
```

#### Respuesta de Error:
```json
{
    "status": "error",
    "message": "Descripción del error",
    "errors": {
        // Detalles de errores de validación
    }
}
```

## 2. Pruebas y Documentación

### 2.1 Pruebas Automatizadas (CE8)
Se han implementado pruebas unitarias y de integración:

1. **Script de Pruebas**: `tests/api_test_report.php`
   - Prueba todos los endpoints
   - Valida respuestas HTTP
   - Verifica estructura JSON
   - Genera reporte de evidencia

2. **Ejecución de Pruebas**:
```bash
php tests/api_test_report.php
```

3. **Reporte Generado**:
- Ubicación: `tests/reports/YYYY-MM-DD_HH-mm-ss/`
- Incluye:
  - Estado de cada prueba
  - Respuestas HTTP
  - Datos enviados/recibidos
  - Evidencia de funcionamiento

### 2.2 Colección Postman (CE6)
Se ha creado una colección completa en Postman:
- Ubicación: `tests/api_test_evaluacion.json`
- Incluye todos los endpoints
- Ejemplos de request/response
- Variables de entorno configurables

### 2.3 Gestión de Datos (CE7)
Implementación de operaciones CRUD:

1. **Crear (Create)**
   - Validación de datos
   - Transacciones para consistencia
   - Respuestas con códigos 201

2. **Leer (Read)**
   - Filtrado por ID
   - Filtrado por parámetros
   - Paginación cuando aplica

3. **Actualizar (Update)**
   - Validación de cambios
   - Transacciones
   - Respuestas con códigos 200

4. **Eliminar (Delete)**
   - Verificación de existencia
   - Eliminación segura
   - Respuestas con códigos 204

### 2.4 Evidencia de Funcionamiento (CE5)
Para demostrar el funcionamiento de la API:

1. **Reporte HTML**
   - Generado automáticamente
   - Incluye todas las pruebas
   - Muestra request/response

2. **Colección Postman**
   - Lista para importar
   - Incluye ejemplos
   - Fácil de ejecutar


## 3. Seguridad y Validación

### 3.1 Validación de Entradas
- Validación de tipos de datos
- Sanitización de inputs
- Prevención de inyección SQL

### 3.2 Manejo de Errores
- Códigos HTTP apropiados
- Mensajes descriptivos
- Logging de errores

### 3.3 Transacciones
- Uso de transacciones DB
- Rollback en errores
- Consistencia de datos 
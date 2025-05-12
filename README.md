# Cliente Feliz API

API RESTful para la gestión de usuarios, ofertas laborales, postulaciones y antecedentes académicos/laborales en una plataforma de empleos.

## Descripción

Esta API permite a empresas y candidatos interactuar con una plataforma de empleos, gestionando usuarios, ofertas, postulaciones y antecedentes. Está desarrollada en PHP y MySQL siguiendo buenas prácticas REST.

## Características principales
- CRUD completo para usuarios, ofertas, postulaciones y antecedentes
- Validación y sanitización de datos
- Respuestas JSON estandarizadas
- Pruebas automatizadas y colección Postman

## Requisitos
- PHP >= 8.0
- MySQL >= 5.7
- Composer (opcional, si usas dependencias externas)
- Servidor web (Apache, Nginx, Laragon, XAMPP, etc.)

## Instalación
1. Clona el repositorio:
   ```bash
   git clone https://github.com/Rivcon-lab/BackendUnidad2CristopherRivera_Cliente_Feliz_API.git
   cd BackendUnidad2CristopherRivera_Cliente_Feliz_API
   ```
2. Configura la base de datos MySQL y actualiza los datos de conexión en `config/database.php` o el archivo correspondiente.
3. Importa el esquema de la base de datos (consulta el archivo SQL si está disponible).
4. Inicia el servidor web apuntando a la carpeta del proyecto.

## Uso básico

### Endpoints principales

#### Usuarios
- `GET    /usuarios`           - Listar usuarios
- `GET    /usuarios/{id}`      - Obtener usuario por ID
- `POST   /usuarios`           - Crear usuario
- `PUT    /usuarios/{id}`      - Actualizar usuario
- `DELETE /usuarios/{id}`      - Eliminar usuario

#### Ofertas Laborales
- `GET    /ofertas`
- `GET    /ofertas/{id}`
- `POST   /ofertas`
- `PUT    /ofertas/{id}`
- `DELETE /ofertas/{id}`

#### Postulaciones
- `GET    /postulaciones?candidato_id={id}`
- `GET    /postulaciones?oferta_laboral_id={id}`
- `POST   /postulaciones`
- `PUT    /postulaciones/{id}`

#### Antecedentes Académicos
- `GET    /academicos?candidato_id={id}`
- `POST   /academicos`
- `PUT    /academicos/{id}`
- `DELETE /academicos/{id}`

#### Antecedentes Laborales
- `GET    /laborales?candidato_id={id}`
- `POST   /laborales`
- `PUT    /laborales/{id}`
- `DELETE /laborales/{id}`

### Ejemplo de request para crear usuario
```json
{
  "nombre": "Juan",
  "apellido": "Pérez",
  "email": "juan@ejemplo.com",
  "clave": "password123",
  "rol": "Candidato",
  "telefono": "+56912345678",
  "direccion": "Calle Principal 123, Santiago",
  "fecha_nacimiento": "1990-05-15"
}
```

### Ejemplo de respuesta exitosa
```json
{
  "mensaje": "Usuario creado exitosamente."
}
```

## Pruebas y colección Postman
- Pruebas automáticas: revisa la carpeta `tests/` para scripts de prueba.
- Colección Postman: `tests/api_test_evaluacion.json` lista para importar y probar todos los endpoints.

## Estructura del proyecto
- `controllers/`   - Lógica de endpoints y validación
- `models/`        - Acceso a datos y lógica de negocio
- `tests/`         - Scripts de prueba y colección Postman
- `docs/`          - Documentación adicional

## Contribuciones
¡Contribuciones y sugerencias son bienvenidas! Abre un issue o pull request.

## Licencia
Este proyecto es de uso académico y libre para fines educativos. 
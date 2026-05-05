# Monolitico - Gestor de Historias de Usuario

Aplicación web monolítica en PHP (MVC), orientada a objetos con encapsulación y abstracción, para gestionar sprints e historias de usuario.

## Requisitos
- XAMPP (Apache + MySQL)
- PHP 8+

## Instalación
1. Copia la carpeta `monolitico` en `htdocs`.
2. Importa `config/schema.sql` en phpMyAdmin.
3. Accede a: `http://localhost/monolitico/public/index.php`

## Arquitectura
- `config/`: conexión PDO y script SQL.
- `models/`: entidades con herencia desde `BaseModel`.
- `controllers/`: controladores con abstracción desde `AbstractController`.
- `views/`: vistas del sistema.
- `public/`: punto de entrada y estilos.

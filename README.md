## Seguridad Web: Actividad 2
# Creación de una aplicación con autentificación

## Requisitos

- PHP (Con las extensiones de SQLite y fileinfo activadas)
- Composer

## Instalación

1. Clonar el repo:

> git clone https://github.com/Jaime02/Seguridad-Web-Actividad-2

2. Copiar el archivo `.env.example` para crear un archivo `.env`

3. Instalar dependencias:

> composer install

4. (Opcional, muy recomendable) Seedear la base de datos:

> php artisan db:seed

Usuarios creados por el seeding:
| Email            | Contrasena | Tipo  |
|------------------|------------|-------|
| admin@admin.com  | admin      | admin |
| pepe@hotmail.com | pepepepe   | guest |

5. Ejecutar el servidor web:

> composer run dev

Listo! La web debería estar funcionando en `127.0.0.1:8000`


## Acceso mediante Laravel Sanctum (Tokens de la API)
Es recomendable usar la coleccion de Postman (`Autenticacion.postman_collection.json`) o CURL si te gusta lo duro

Version CURL:
1. Hacer login. Enviar una peticion POST a http://127.0.0.1:8000/api/login
Incluir el email y contraseña en el body
Incluir el header:
```
Accept: application/json
```

Deberías recibir una respuesta 200 y el siguiente JSON:

```jsonc
{
    "token": "<token>",
    "user": {
        "id": 1,
        "name": "Pedro Sanxes",
        // ... otros datos ...
    }
}
```

2. Usar el token recibido para acceder a rutas protegidas
Enviar peticion GET a http://127.0.0.1:8000/api/checktoken
Incluir los siguientes headers:
```
Authorization: Bearer <PEGAR EL TOKEN AQUÍ>
Accept: application/json
```

Deberías recibir una respuesta 200 y el siguiente JSON:
```jsonc
{
    "message": "Token is valid",
    "user": {
        "id": 1,
        "name": "Pedro Sanxes",
        // ... otros datos ...
    }
}
```
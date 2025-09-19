<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Visit Route

Aplicación web para la gestión de visitas, que integra un BackEnd en Laravel y un FrontEnd en Vue. Permite registrar, visualizar y administrar visitas directamente sobre un mapa interactivo.

# Technologias

- Larave 12
- Vue3.js (Composition Api)
- leaflet
- Toast.js
- Bootstrap 5

# BD

Se usa una Base de Datos Postgres con la cual se realiza la consulta y persistencia de datos. ports - 5437:5432

# Arquitectura BackEnd

- La aplicación está desarrollada bajo una arquitectura en capas, implementando los patrones Service y Repository. Esto permite desacoplar la lógica de negocio del acceso a datos mediante el uso de interfaces, logrando un sistema más mantenible y escalable.
- Para facilitar la configuración del entorno, asegurar la portabilidad, se utilizó Docker como herramienta de virtualización ligera.

```plaintext
visit-route/
│
├── app/
│   ├── Dto/                     # Objetos de transferencia de datos (Data Transfer Objects)
│   ├── Entities/                # Entidades del dominio
│   ├── Exceptions/              # Excepciones personalizadas
│   ├── Http/
│   │   └── Controllers/         # Controladores HTTP
│   ├── Interfaces/
│   │   ├── Repositories/        # Interfaces para los Repositorios
│   │   └── Services/            # Interfaces para los Servicios
│   ├── Mappers/                 # Mapeadores de datos (DTO)
│   ├── Repository/              # Implementaciones de Repositorios
│   └── Services/                # Implementaciones de Servicios
│
├── routes/
│    ├── App/                    # Rutas de la aplicacion
├── test/
│    ├── Feature/                # Pruebas enfocadas en las rutas y casos de uso de la aplicación
│    ├── Integration/            # Pruebas que validan la interacción entre múltiples capas del sistema
│    │   ├── Repositories/       # Pruebas de las interfaces de Repositorios (acceso a datos)
│    │   └── Services/           # Pruebas de las interfaces de Servicios (lógica de negocio)

```
# FrontEnd
- La carpeta resources/views contiene todas las vistas Blade de la aplicación. Dentro de ella se organiza la estructura en layouts, donde se define la plantilla base (master.blade), y en subcarpetas como visit, que agrupan las vistas específicas del módulo de visitas.
- puerto para acceder a la web, despues de realizar los pasos para levantar el contendor docker http://localhost:8083/

```plaintext
visit-route/
│
├── resources/
│   ├── views/ 
│   |   ├── layouts/
│   |       └── master.blade        # Plantilla base que define la estructura general (layout principal)
│   |   ├── visit/
│   │       └── Ofcanvas/            # Vistas parciales para offcanvas (paneles laterales)
│   │       └── index.blade            # Vista principal de gestión de visitas
```

## Migraciones
- Se agrega migracion para crear por defecto y las de la tabla visits

# Especificacion levantar entorno

## Pasos para correr el entorno Docker de Visit Route API
- Los comandos se ejecutan en orden al levantar el contenedor con 'up' este quedara corriendo, abrir una nueva pestaña linux "Ctrl + Shift + t" y correr el comando para instalar el composer y correr las migraciones
- Despues podra acceder a la url de la vista 

Crear la red de Docker
```plaintext
sudo docker network create visit-route-network
 ```

 Levantar los contenedores del entorno (modo desarrollo)
```plaintext
sudo docker compose -f .devops/docker/develop/docker-compose.yml -f .devops/docker/develop/docker-compose.override.yml up
```
Instalar dependencias de PHP con Composer
```plaintext
sudo docker exec -it visit-route composer install
 ```

Ejecutar migraciones de base de datos
```plaintext
sudo docker exec -it visit-route php artisan migrate
```

Se desarrolló el backend siguiendo un enfoque guiado por pruebas (TDD). Los tests permiten validar el correcto funcionamiento de toda la aplicación. Para su ejecución se utilizó el trait RefreshDatabase, evitando la necesidad de contar con una base de datos dedicada para las pruebas.
```plaintext
sudo docker exec -it visit-route php artisan test
```

Comando para realizar el insert de las visitas se deja 3 para pruebas, sin embargo esto tambien se puede hacer en la vista del mapa, y gestionar cada visita, para ver, editar, eliminar
```plaintext
sudo docker exec -it visit-route php artisan visita:create -- "Nombre Prueba 1" "prueba1@ejemplo.com" 4.5981 -74.0760
sudo docker exec -it visit-route php artisan visita:create -- "Nombre Prueba 2" "prueba2@ejemplo.com" 4.6584 -74.0930
sudo docker exec -it visit-route php artisan visita:create -- "Nombre Prueba 3" "prueba3@ejemplo.com" 4.7016 -74.1469
```
Acceder a la aplicación en el navegador
- 📍 URL: http://localhost:8083/

Detener contenedor visit-route
```plaintext
sudo docker compose -f .devops/docker/develop/docker-compose.yml -f .devops/docker/develop/docker-compose.override.yml down
```
# Documentación
- Se enviara el .env dentro del .zip
- Se entrega archivo Swagger Documentando las rutas implementadas.
- Imagenes de evidencia del desarrollo, test, documentacion rutas.

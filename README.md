## Hotel manager
Primero configurar el archivo .env (copiar del example)
````bash
cp .env.example .env
````

Levantar el contenedor
````bash
docker-compose up -d
````

Composer
````bash
docker-compose exec app composer install
````

Genearar key
````bash
docker-compose exec app php artisan key:generate
````

Ejecutar migraciones y seeders
````bash
docker-compose exec app php artisan migrate:fresh --seed
````

localhost:8888


## API
Para obtener el token hacer una peticion POST a:
http://localhost:8888/api/login

Con un usuario creado en Body (Ejemplo):
{
    "email":"hotel@manager.com",
    "password":"hotelmanager123"
}

Copiar el token de la respuesta 

Peticion GET a:
http://localhost:8888/api/rooms/1?status=1 (Ejemplo)
En Postman: Authorization -> Bearer Token 
Introducimos el token generado anteriormente.


TODO:
- Instalar un dashboard potente y configurarlo 
- Darle mas formato y estilo
- Revisar algunas reglas de validacion

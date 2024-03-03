StoreApi

StoreAPI is a RESTful API designed specifically for stores, offering a comprehensive set of endpoints for efficient management of products and sales transactions.

- Installation
Start the Docker containers:
```sh
docker-compose up -d
```

Access the Docker container's shell:
```sh
docker-compose exec app bash
```

Copy and Paste .env.example as .env
```sh
Copy the contents of .env.example and create a new file named .env. Then, paste the copied contents into .env. Ensure to adjust the variables according to your environment.
```

Install dependencies using Composer:
```sh
composer install
```

Run database migrations:
```sh
php artisan migrate
```

Seed the database with sample data:
```sh
php artisan db:seed
```

Run tests to ensure everything is set up correctly:
```sh
./vendor/bin/phpunit
```

- Swagger Documentation
```sh
http://localhost:8080/rest/documentation/
```

- Contact
For any inquiries or support, please feel free to contact:
```sh
Pablo Fabrício - fabriciopablo2000@gmail.com
```

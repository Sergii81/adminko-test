- laravel 10.10
- php 8.1
## Installation

- git clone https://github.com/Sergii81/adminko-test
- composer install
- set db credentials in .env
    - DB_CONNECTION=mysql
    - DB_HOST=host.docker.internal
    - DB_PORT=3306
    - DB_DATABASE=db_base_name
    - DB_USERNAME=db_user_name
    - DB_PASSWORD=db_password
- docker-compose up -d
- docker-compose exec app sh
    - php artisan migrate
- api url http://localhost:8989/api/v1/

## How to use

1. GET http://localhost:8989/api/v1/companies
2. GET http://localhost:8989/api/v1/search=companyName

3. Command

            php artisan app:parse-companies


<p align="center"><a href="https://github.com/mjpakzad/delay_system" target="_blank"><img src="public/assets/images/snappfood-logo.png" width="400" alt="Laravel Logo"></a></p>

## About Delay System

Delay system is a simple delay management system for an ecommerce project.

## Installation

### Prerequisites:

- Docker
- Docker composer

### Clone the project
`git clone https://github.com/mjpakzad/delay-system`

### Go to project directory
`cd delay-system`

### Copy .env from .env.example
`cp .env.example .env`

### Modify database connection
Go to the database section and change the following variables:
```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Build containers
`docker compose up -d`

### Open app container shell
`docker exec -it delay-system-app bash`

#### Generate App key
`php artisan key:generate`




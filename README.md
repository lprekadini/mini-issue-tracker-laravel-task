# Mini Issue Tracker (Laravel 10)

## Requirements
- PHP ≥ 8.1 (with `pdo_mysql`)
- MySQL running locally
- Composer

## Installation
```bash
composer install

cp .env.example .env

php artisan key:generate

php artisan migrate:fresh --seed

php artisan serve

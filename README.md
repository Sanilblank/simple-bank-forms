# Simple Bank Forms Project Setup

This project was built using the following technologies:

- **PHP**: 8.2
- **Laravel**: 11
- **PostgreSQL**: 17.2
- **Node.js**: v23.7.0

## Installation Guide

Follow these steps to set up and run the project on your local machine:

### 1. Clone the Repository
```sh
git clone https://github.com/Sanilblank/simple-bank-forms.git
cd simple-bank-forms
```

### 2. Copy Environment File
```sh
cp .env.example .env
```

### 3. Install Dependencies
```sh
composer install
npm install
```

### 4. Set Application Key
```sh
php artisan key:generate
```

### 5. Create and Configure Database
Ensure PostgreSQL is running and create a database.
Update `.env` file with the correct database credentials:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations and Seed Database
```sh
php artisan migrate:fresh --seed
```

### 7. Clear and Optimize Cache
```sh
php artisan optimize:clear
```

### 8. Start Development Server
```sh
php artisan serve
```

### 9. Run Vite for Frontend Assets
```sh
npm run dev
```

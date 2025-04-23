# Laravel Form Management System

A dynamic form management system built with Laravel, Vue.js, Inertia.js, and TypeScript.

## Features

- Dynamic form builder with drag-and-drop functionality
- JSON configuration support for form fields
- Form field validation
- Responsive design
- Form management dashboard

## Requirements

- PHP 8.1 or higher
- Node.js 16 or higher
- MySQL 5.7 or higher
- Composer
- npm

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd laravel-form-b
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create a copy of the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations:
```bash
php artisan migrate
```

8. Start the development server:
```bash
php artisan serve
```

9. In a separate terminal, start the Vite development server:
```bash
npm run dev
```

## Usage

1. Access the application at `http://localhost:8000`
2. Log in to the admin portal
3. Create new forms using the form builder
4. Configure form fields and validation rules
5. Preview and test your forms

## Project Structure

- `app/Models/` - Laravel models
- `app/Http/Controllers/` - Laravel controllers
- `database/migrations/` - Database migrations
- `resources/js/Pages/` - Vue.js components
- `resources/js/types/` - TypeScript interfaces

## Development

### Running Tests

```bash
php artisan test
```

### Building for Production

```bash
npm run build
```

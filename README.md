<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This is a Library Management System built with Laravel 10, featuring a modern web interface using Livewire for dynamic components and TailwindCSS for styling. The application allows administrators to manage books, authors, publishers, categories, shelves, and borrowings, while users can browse and borrow books.

Key features include:
- User authentication and authorization
- Admin panel for managing library resources
- User dashboard for borrowing and returning books
- Real-time updates with Livewire
- Responsive design with TailwindCSS
- Database migrations and seeders for sample data

## Quick Start

Follow these steps to set up the project after cloning the repository.

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js and npm
- A database (MySQL, PostgreSQL, SQLite, etc.)

### Installation

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd <project-directory>
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

4. **Environment Setup:**
   - Copy the environment file:
     ```bash
     cp .env.example .env
     ```
   - Edit `.env` to configure your database connection and other settings (e.g., APP_NAME, DB_CONNECTION, DB_HOST, etc.).

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

### Database Setup

6. **Run Migrations:**
   ```bash
   php artisan migrate
   ```
   This will create the necessary tables: users, shelves, publishers, categories, authors, books, borrowings, and borrowing_details.

7. **Seed the Database (Optional):**
   ```bash
   php artisan db:seed
   ```
   This will populate the database with sample data including 5 shelves, 10 publishers, 5 categories, 15 authors, 10 users, 30 books, and 20 borrowings with details.

### Build Assets

8. **Compile Frontend Assets:**
   - For development:
     ```bash
     npm run dev
     ```
   - For production:
     ```bash
     npm run build
     ```

### Run the Application

9. **Start the Development Server:**
   ```bash
   php artisan serve
   ```
   The application will be available at `http://localhost:8000`.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to this project! Please follow Laravel's contribution guidelines found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 🚀 Med PHP Framework

A lightweight, high-performance PHP MVC framework designed for rapid development. This boilerplate provides a robust core with a built-in CLI for scaffolding, a powerful Blade-like template engine, and a clean directory structure with Zero Dependencies.

---

## 🛠 Features

* **Built-in CLI (`med`)**: Scaffold controllers, models, and entire modules instantly.
* **Modular Architecture**: Build scalable apps by isolating features (e.g., E-commerce, Blog) into independent modules.
* **MVC & Core Patterns**: Clear separation of concerns with Service Container and Dependency Injection.
* **Blade-like Engine**: Native support for `@extends`, `@section`, and custom `@CSRF` directives.
* **Modern Routing**: Regex-based routing with parameter support `user/{id}`.
* **Middleware Pipeline**: robust request filtering with global and route-specific middleware.
* **Security**: Built-in CSRF protection and Session management.
* **Dependency Injection**: PSR-11 inspired container for managing application services.

---

## 📂 Project Structure

* **`src/Modules/`**: Independent, self-contained features (Controllers, Routes, Models).
* **`src/Application/`**: Global Controllers, Routes, and Middleware.
* **`src/Domain/`**: Business logic and Global Models (Entities).
* **`src/Infrastructure/`**: Database connections and low-level implementations.
* **`src/Core/`**: The framework's engine (Router, Bootstrap, Container).
* **`public/`**: Web entry point (`index.php`) and assets.
* **`views/`**: Global template files (`.med.php`).

---

## 🚀 Getting Started

### 1. Installation

Create a new project using Composer:

```bash
composer create-project mohammed/php-boilerplate:dev-main my-app
cd my-app
```

### 2. Environment Setup

Copy the example environment file and configure your database settings:

```bash
cp .env.example .env
# Edit .env with your database credentials
```

### 3. Run Server

```bash
php med serve
# Or manually: php -S localhost:8000 -t public
```

### 💻 CLI Commands

The framework comes with a powerful CLI tool:

| Command | Description |
|---------|-------------|
| `php med key:generate` | Generate the application security key |
| `php med make:module Shop` | Creates a new self-contained module |
| `php med make:controller User` | Creates `UserController.php` |
| `php med make:model User` | Creates `User.php` Domain Model |
| `php med make:service User` | Creates `UserService.php` |
| `php med make:repository User` | Creates `UserRepository.php` |
| `php med make:migration create_users_table` | Creates a new migration file |
| `php med migrate` | Runs pending migrations |
| `php med serve` | Start the development server |
` |
| `php med make:model User` | Creates `User.php` Domain Model |
| `php med make:service User` | Creates `UserService.php` |
| `php med make:repository User` | Creates `UserRepository.php` |
| `php med make:migration create_users_table` | Creates a new migration file |
| `php med migrate` | Runs pending migrations |
| `php med serve` | Start the development server |

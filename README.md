# 🚀 Med PHP Framework

A lightweight, high-performance PHP MVC framework designed for rapid development. This boilerplate provides a robust core with a built-in CLI for scaffolding, a powerful Blade-like template engine, and a clean directory structure with Zero Dependencies.

---

## 🛠 Features

* **Built-in CLI (`med`)**: Scaffold controllers and models instantly using custom commands.
* **MVC Architecture**: Clear separation between Application logic, Domain models, and Infrastructure.
* **Blade-like Engine**: Native support for `@extends`, `@section`, and custom `@CSRF` directives.
* **Modern Routing**: Regex-based routing with parameter support `user/{id}`.
* **Security**: Built-in CSRF protection and Session management.

---

## 📂 Project Structure

* **`src/Application/`**: Controllers, Routes, and Middleware.
* **`src/Domain/`**: Business logic and Models (Entities).
* **`src/Infrastructure/`**: Database connections and low-level implementations.
* **`src/Core/`**: The framework's engine (Router, Bootstrap, View Engine).
* **`public/`**: Web entry point (`index.php`) and assets.
* **`views/`**: Template files (`.med.php`).

---

## 🚀 Getting Started

### 1. Installation

Create a new project using Composer:

```bash
composer create-project mohammed/php-boilerplate my-app
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
| `php med make:controller User` | Creates `UserController.php` |
| `php med make:model User` | Creates `User.php` Domain Model |
| `php med make:migration create_users_table` | Creates a new migration file |
| `php med migrate` | Runs pending migrations |

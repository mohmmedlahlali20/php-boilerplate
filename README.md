# 🚀 Mohammed PHP Framework (Core)

  

A lightweight, high-performance PHP MVC framework designed for rapid development. This boilerplate provides a robust core with a built-in CLI for scaffolding, a powerful Blade-like template engine, and a clean directory structure.

  

---

  

## 🛠 Features

  

*  **Built-in CLI (`med`)**: Scaffold controllers and models instantly using custom commands.

*  **MVC Architecture**: Clear separation between Application logic, Domain models, and Infrastructure.

*  **Blade-like Engine**: Native support for `@extends`, `@section`, and custom `@flash` directives.

*  **Base Classes**: Standardized `Controller` and `Model` inheritance for clean and maintainable code.

*  **Dependency Management**: Fully integrated with Composer for easy package management.

  

---

  

## 📂 Project Structure

  

*  **`app/`**: User-defined application logic, providers, and middleware.

*  **`public/`**: Web entry point (`index.php`) and static assets like CSS and JS.

*  **`resources/views/`**: Template files using the `.med.php` extension.

*  **`routes/`**: Centralized web and API route definitions.

*  **`src/Core/`**: The framework's engine, including Router, Bootstrap, and BladeEngine.

  

---

  

## 🚀 Getting Started

  

### 1. Installation

Create a new project using Composer:

```bash

run : composer  create-project  mohammed/php-boilerplate  my-app
```


### 2. Environment  Setup

Copy  the  example  environment  file  and  configure  your  database  settings:
```bash
		cp  .env.example  .env
```

### 3. Run Server
```bash
run : php -S localhost:8000 -t public
```

### 💻 CLI Commands
**Command**

**Result**

`php med make:controller User` Creates `UserController.php`

`php med make:model User` Creates `User.php` Model
		





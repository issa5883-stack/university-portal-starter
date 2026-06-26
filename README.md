# University Portal — Academic Management System

A full-stack web application built with **Laravel 11** that allows university staff to manage departments, students, courses, professors, and enrollments through a clean, component-driven UI.

---

## Team & Responsibilities

| Member | Role | Modules Implemented |
|--------|------|---------------------|
| **Issa** | Team Lead · UI Architecture | Core Layout, Blade Components, Departments, Professors, Enrollments |
| **Saja** | Backend + Frontend Developer | Student Management (CRUD) |
| **Asmaa** | Backend + Frontend Developer | Course Management (CRUD) |

---

## Modules

| Module | Create | Read | Update | Delete |
|--------|:------:|:----:|:------:|:------:|
| Departments | ✅ | ✅ | ✅ | ✅ |
| Students | ✅ | ✅ | ✅ | ✅ |
| Courses | ✅ | ✅ | ✅ | ✅ |
| Professors | ✅ | ✅ | ✅ | ✅ |
| Enrollments | ✅ | ✅ | ✅ | ✅ |

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 11 |
| Templating | Blade (Layouts + Components) |
| Database | MySQL / SQLite |
| Frontend | Bootstrap 5.3 · Bootstrap Icons |
| Auth | Laravel Session Auth |
| Language | PHP 8.2+ |

---

## Architecture

The project follows a clean **Controller → Service → DTO** pattern:

```
HTTP Request
    └── Controller        receives input, calls service, returns view
         └── Service      business logic, database queries
              └── DTO     read-only data object passed to the Blade view
```

This keeps views free of business logic and controllers thin.

---

## Reusable Blade Components

Built by **Issa** and shared across every module (W14):

| Component | Tag | Purpose |
|-----------|-----|---------|
| Card | `<x-card title="...">` | Wraps every page section in a styled panel |
| Button | `<x-button href="..." color="...">` | Link or submit button (primary / secondary / danger) |
| Form Input | `<x-form name="..." label="...">` | Labeled input with validation error display |
| Save | `<x-save />` | Pre-styled submit button |
| Create Button | `<x-create-button :href="...">` | "Add New" action link |
| Edit Button | `<x-edit-button :href="...">` | "Edit" action link |
| Delete Button | `<x-delete-button :action="...">` | Self-contained delete form with confirmation |

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php
│   ├── DepartmentController.php    ← Issa
│   ├── StudentController.php       ← Saja
│   ├── CourseController.php        ← Asmaa
│   ├── ProfessorController.php     ← Issa
│   └── EnrollmentController.php    ← Issa
├── Services/
│   ├── DepartmentService.php
│   ├── StudentService.php
│   ├── CourseService.php
│   ├── ProfessorService.php
│   └── EnrollmentService.php
└── DTOs/
    ├── DepartmentDTO.php
    ├── StudentDTO.php
    ├── CourseDTO.php
    ├── ProfessorDTO.php
    └── EnrollmentDTO.php

resources/views/
├── layouts/
│   └── app.blade.php               ← Issa (shared master layout)
├── components/                     ← Issa (shared UI components)
│   ├── button.blade.php
│   ├── card.blade.php
│   ├── form.blade.php
│   ├── save.blade.php
│   ├── create-button.blade.php
│   ├── edit-button.blade.php
│   └── delete-button.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── departments/                    ← Issa
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── students/                       ← Saja
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── courses/                        ← Asmaa
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── professors/                     ← Issa
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── enrollments/                    ← Issa
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php
```

---

## Setup & Installation

### Requirements

- PHP >= 8.2
- Composer
- MySQL or SQLite
- Laravel 11

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/issa5883-stack/University-Portal-Starter.git
cd University-Portal-Starter

# 2. Install PHP dependencies
composer install

# 3. Copy the environment file
cp .env.example .env

# 4. Generate the application key
php artisan key:generate

# 5. Create the SQLite database file (or configure MySQL in .env)
touch database/database.sqlite

# 6. Run migrations and seed sample data
php artisan migrate:fresh --seed

# 7. Start the development server
php artisan serve
```

Open **http://127.0.0.1:8000** in your browser.

### Default Login

After seeding the database, log in with:

```
Email:    admin@university.edu
Password: password
```

> You can also register a new account from the **Register** page.

---

## Data Reference

Views receive DTO objects. Read data using getter methods:

| DTO | Available Getters |
|-----|-------------------|
| `DepartmentDTO` | `getId()` `getName()` |
| `StudentDTO` | `getId()` `getName()` `getEmail()` `getStudentNumber()` `getDepartmentId()` `getDepartmentName()` |
| `CourseDTO` | `getId()` `getTitle()` `getCourseCode()` `getCreditHours()` `getDepartmentId()` `getDepartmentName()` |
| `ProfessorDTO` | `getId()` `getName()` `getEmail()` `getDepartmentId()` `getDepartmentName()` |
| `EnrollmentDTO` | `getId()` `getStudentId()` `getCourseId()` `getGrade()` `getStudentName()` `getCourseTitle()` `getCourseCode()` |

---

## ILOs Covered

| Week | Concept | Where Applied |
|------|---------|---------------|
| W10 | Blade `@foreach`, form data processing | All `index` / `create` / `edit` views |
| W11 | OOP — Service & DTO classes | `app/Services/` · `app/DTOs/` |
| W12 | Laravel MVC & Artisan | All controllers, `routes/web.php` |
| W13 | Blade layouts & `@extends` | `layouts/app.blade.php` extended by every view |
| W14 | Blade reusable components | `resources/views/components/` |

---

## License

Built as a university course project — PHP Web Development.  
© 2025 Issa · Saja · Asmaa. All rights reserved.

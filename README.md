Warehouse/Inventory Management System

A modern Warehouse Inventory Management System built with Laravel 12 (REST API) and Vue 3 (SPA).
Designed to manage warehouses, users, and inventory efficiently with scalable architecture and clean code practices.

Tech Stack

Backend
1. Laravel 12
2. MySQL
3. RESTful APIs
4. Laravel Sanctum (Auth)
5. Spatie Permission (Roles & Permissions)

Frontend
1. Vue 3
2. Vite
3. Vue Router
4. Axios
5. Bootstrap 5


Features
📊 Dashboard
Centralized statistics overview

🏢 Warehouses
Create, update & delete warehouses
Search & pagination
Clean API responses

👥 Users
User CRUD operations
Role assignment
Secure API endpoints
Pagination & searching

📦 Inventory
Product-wise stock management
Warehouse-wise inventory
Supplier & category mapping
Search by product & supplier
Optimized database relations

Installed Packages
Backend Packages
| Package                     | Purpose                      |
| --------------------------- | ---------------------------- |
| `laravel/sanctum`           | API Authentication           |
| `spatie/laravel-permission` | Role & Permission Management |
| `fakerphp/faker`            | Dummy Data Generation        |

Frontend Packages

| Package       | Purpose            |
| ------------- | ------------------ |
| `vue@3`       | Frontend framework |
| `vue-router`  | SPA routing        |
| `axios`       | API communication  |
| `bootstrap@5` | UI styling         |


Installation Guide
1. git clone [https://github.com/USERNAME/REPO_NAME.git](https://github.com/Piyushborana111/warehouse-inventory.git)
cd REPO_NAME

2. Backend Setup
   a. cd REPO_NAME
   b. composer install
   c. cp .env.example .env
   d. php artisan key:generate
4. Update .env
    a. DB_DATABASE=database_name
    b. DB_USERNAME=root
    c. DB_PASSWORD=

5. Run below commands inside terminal
    a. php artisan migrate --seed
    b. php artisan serve

6. Frontend Setup (Vue 3)
    a. npm install
    b. npm run dev

you will get a local url in terminal open it the project will open.
   


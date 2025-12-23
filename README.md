A modern Warehouse Inventory Management System built with Laravel 12 (REST API) and Vue 3 (SPA).
Designed to manage warehouses, users, and inventory efficiently with scalable architecture and clean code practices.

✨ Key Highlights

Full-stack Laravel + Vue architecture

Role-based access control

Modular & scalable codebase

API-driven frontend

Pagination & advanced searching

Production-ready project structure

🧰 Tech Stack
Backend

Laravel 12

MySQL

RESTful APIs

Laravel Sanctum (Auth)

Spatie Permission (Roles & Permissions)

Frontend

Vue 3

Vite

Vue Router

Axios

Bootstrap 5

📦 Features
📊 Dashboard

Centralized statistics overview

API-based dynamic data loading

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

📚 Installed Packages
Backend Packages
Package	Purpose
laravel/sanctum	API Authentication
spatie/laravel-permission	Role & Permission Management
fakerphp/faker	Dummy Data Generation
Frontend Packages
Package	Purpose
vue@3	Frontend framework
vue-router	SPA routing
axios	API communication
bootstrap@5	UI styling
🗂️ Project Structure
warehouse-inventory/
├── backend/
│   ├── app/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── routes/
│   │   └── api.php
│   └── controllers/
│
├── frontend/
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── router/
│   │   └── services/
│   └── vite.config.js

⚙️ Installation Guide
1️⃣ Clone Repository
git clone https://github.com/USERNAME/REPO_NAME.git
cd REPO_NAME

2️⃣ Backend Setup (Laravel)
cd backend
composer install
cp .env.example .env
php artisan key:generate


Update .env:

DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=


Run migrations & seeders:

php artisan migrate --seed
php artisan serve

3️⃣ Frontend Setup (Vue 3)
cd frontend
npm install
npm run dev

🔐 Authentication & Authorization

API authentication powered by Laravel Sanctum

Role & permission handling using Spatie Laravel Permission

Protected routes & middleware-based access control

📈 Module Status
Module	Status
Dashboard	✅ Completed
Warehouses	✅ Completed
Users	✅ Completed
Inventory	✅ Completed
Categories	⏳ Upcoming
Suppliers	⏳ Upcoming
Reports	⏳ Planned
🧪 Development Standards

REST API best practices

Request validation

Service-based architecture

Proper error handling

Clean & maintainable code

🚧 Future Enhancements

Reports & analytics

Export (CSV / Excel / PDF)

Audit logs

Notification system

Multi-warehouse role hierarchy

👨‍💻 Author

Piyush Borana
Laravel & Vue Developer

📄 License

This project is licensed under the MIT License.

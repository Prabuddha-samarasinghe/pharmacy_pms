Pharmacy Management System API

This is a RESTful API for managing pharmacy operations such as medication inventory and customer records.

Setup Instructions

Clone the Repository:
git clone https://github.com/yourusername/pharmacy_pms.git

Navigate to the Project Directory:
cd pharmacy_pms

Install Dependencies:
composer install

Copy Environment File:
cp .env.example .env

Generate Application Key:
php artisan key:generate

Configure Database:

Update the .env file with your database credentials:

DB_CONNECTION=sqlite
DB_HOST=
DB_PORT=
DB_DATABASE=C:/xampp/htdocs/pharmacy_pms/database/pharmacy_pms.sqlite
DB_USERNAME=
DB_PASSWORD=

Run Database Migrations:
php artisan migrate

Start the Development Server:
php artisan serve
The API server will start running at http://localhost:8000

**Endpoints**
Authentication
Register User:
POST /register
Login User:
POST /login
Get User Profile:
GET /profile
Logout User:
GET /logout
Medication Management
Get All Medications:
GET /medication
Get Medication by ID:
GET /medication/{id}
Update Medication:
PATCH /medication/{id}
Delete Medication:
DELETE /medication/{id}
Customer Management
Get All Customers:
GET /customers
Get Customer by ID:
GET /customers/{id}
Update Customer:
PATCH /customers/{id}
Delete Customer:
DELETE /customers/{id}

**Dependencies**
PHP >= 7.4
Laravel Framework
Sqlite Database
Composer (for PHP package management)

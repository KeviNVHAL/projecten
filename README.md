# portofolio website
Talen: HTML, CSS, JS

### Installation
Clone the Repository

# twotter

Talen: HTML, CSS, PHP, SQL
Tools: XAMPP / MAMP

### Installation
Clone the Repository to XAMPP's / MAMP'S htdocs Folder
inject the sql file to phpMyAdmin

# laravel project

Talen: HTML, CSS, JS?, PHP, SQL
Tools: XAMPP / MAMP

### Installation
Clone the Repository to XAMPP's htdocs Folder: Open your terminal and navigate to the htdocs folder inside your XAMPP directory (typically C:/xampp/htdocs on Windows). Clone the repository directly into this folder:

cd /path/to/xampp/htdocs
git clone

Install Dependencies: Inside your project folder, use Composer to install the required PHP dependencies:
composer install

Copy Environment File: Copy the .env.example file to .env to set up environment variables.
cp .env.example .env

Generate Application Key: Generate a unique application key, which Laravel uses for encryption.
php artisan key:generate

Open .env and set the database connection details to match your XAMPP setup.

Run Migrations: Initialize the database tables:
php artisan migrate

If the project has seeded data, you can also run:
php artisan db:seed

# 🎬 Symfony Cinema Platform

A cinema reservation and management platform developed with Symfony, PHP and MySQL. The application provides a complete environment for managing movies, reservations, seats, users and cinema-related operations through both Front Office and Back Office interfaces.

## Features

### 🎥 Movie Management

* Add, edit and delete movies
* Manage movie categories
* Display movie details
* Search movies

### 🎟 Reservation System

* Seat reservation management
* Booking creation and tracking
* Reservation administration

### 👥 User Management

* User authentication
* Role-based access control
* User profiles

### 🛒 E-Commerce Features

* Shopping cart management
* Order processing
* Promotional codes

### 📊 Dashboard & Analytics

* Statistics and reporting
* Administrative dashboard
* Front Office & Back Office interfaces

## Technologies Used

* PHP
* Symfony Framework
* MySQL
* Doctrine ORM
* Twig Template Engine
* Bootstrap
* JavaScript
* HTML5
* CSS3

## Project Structure

```text
src/
templates/
public/
config/
migrations/
tests/
translations/
```

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/amirbargougui/symfony-cinema-platform.git
cd symfony-cinema-platform
```

### 2. Install dependencies

```bash
composer install
```

### 3. Configure environment

Edit the `.env` file and configure your MySQL database connection.

### 4. Run database migrations

```bash
php bin/console doctrine:migrations:migrate
```

### 5. Start the application

```bash
symfony server:start
```

or

```bash
php -S localhost:8000 -t public
```

## Main Modules

* Movies Management
* Categories Management
* Reservations Management
* Seats Management
* User Management
* Shopping Cart
* Orders
* Promo Codes
* Statistics Dashboard

## Academic Project

This project was developed as part of an engineering curriculum to demonstrate skills in:

* Object-Oriented Programming
* MVC Architecture
* Database Design
* Full-Stack Web Development
* Software Engineering Practices

## Author

**Amir Bargougui**

AI & Data Engineering Student

GitHub: https://github.com/amirbargougui

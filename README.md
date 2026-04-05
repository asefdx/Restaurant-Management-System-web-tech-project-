# Restaurant Management System (PHP + MySQL)

A role-based restaurant management web application built with core PHP, MySQL, HTML, CSS, and JavaScript.

## Overview

This project supports two main user roles:

- Admin: Manage users, menu items, and view sales information.
- Employee: Browse menu, add items to cart, place orders, and view today's orders.

The application uses session-based authentication and a simple MVC-like folder split in both Admin and Employee modules.

## Main Features

### Authentication

- Login from the root page.
- Signup flow for creating users.
- Role-based redirect after login:
  - admin -> Admin dashboard
  - employee -> Employee dashboard

### Admin Module

- Dashboard with summary stats.
- User management:
  - Add user
  - Edit user
  - Delete user
  - List users
- Food/menu management:
  - Add food
  - Edit food
  - Delete food
  - List foods
- Sales list view from orders table.

### Employee Module

- Dashboard page.
- Menu listing with search.
- Cart operations.
- Order placement and invoice display.
- Today's orders listing.

## Project Structure

- Index.php: Entry point (login page).
- Admin/
  - Controller/: PHP handlers + JS validation/search scripts
  - Model/: DB logic
  - View/: HTML/PHP views + CSS/assets
- Employee/
  - Controller/: PHP handlers + JS scripts
  - Model/: DB logic
  - View/: HTML/PHP views + CSS/assets

## Prerequisites

Install these before running locally:

- PHP 8.x (or 7.4+)
- MySQL 8.x (or compatible MariaDB)
- Web server (Apache recommended)
- XAMPP/WAMP/Laragon (easy all-in-one option on Windows)

## Local Setup (Windows + XAMPP example)

1. Clone or copy this project into your web root.
   - Example path: C:/xampp/htdocs/Restaurant-Management-System-web-tech-project--main
2. Start Apache and MySQL from XAMPP Control Panel.
3. Create database named:
   - restaurant_management
4. Create required tables using SQL below.
5. Confirm DB credentials in both files:
   - Admin/Model/mydb.php
   - Employee/Model/mydb.php
     Default credentials currently used:
   - host: localhost
   - user: root
   - password: (empty)
   - database: restaurant_management
6. Open in browser:
   - http://localhost/Restaurant-Management-System-web-tech-project--main/Index.php

## Minimum Database Schema

Run this SQL in phpMyAdmin or MySQL client:

sql
CREATE DATABASE IF NOT EXISTS restaurant_management;
USE restaurant_management;

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','employee') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS menu (
    menu_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(150) NOT NULL,
    category VARCHAR(80) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    status VARCHAR(30) DEFAULT 'Available',
    quantity INT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    menu_id INT NOT NULL,
    employee_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (menu_id) REFERENCES menu(menu_id)
);


## Optional: Seed Initial Data

sql
INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@example.com', 'admin123', 'admin');

INSERT INTO menu (item_name, category, price, status, quantity)
VALUES
('Burger', 'Fast Food', 180.00, 'Available', 30),
('Pizza', 'Fast Food', 350.00, 'Available', 20),
('Coffee', 'Beverage', 90.00, 'Available', 50);


## How To Use

1. Open the login page.
2. Login with an existing account (or create one from signup page).
3. Use admin features for management tasks.
4. Use employee features for menu/cart/order flow.

## Notes

- Passwords are currently stored in plain text in this version.
- Input queries are written in a straightforward style and can be improved with prepared statements.
- For production, add stronger validation, error handling, and security hardening.

## Troubleshooting

- Blank page or redirect loop:
  - Ensure Apache and MySQL are running.
  - Ensure session is enabled in PHP.
- Database connection error:
  - Verify host/user/password/database values in both mydb.php files.
- Login fails for valid user:
  - Check that role values are exactly admin or employee.
  - Confirm user row exists in users table.

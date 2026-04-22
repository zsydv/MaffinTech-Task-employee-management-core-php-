# Employee Management System (Core PHP)

## 📌 Overview

This project is a simple **Employee Management System** built using **Core PHP and MySQL (PDO)** without any frameworks.

The goal of this project is to demonstrate:

* Clean code structure (MVC-like architecture)
* CRUD operations
* Security best practices
* Basic frontend interaction (AJAX)

---

## ⚙️ Features

* ➕ Add Employee
* 📋 List Employees
* ✏️ Edit Employee
* ❌ Delete Employee (with confirmation)
* 🔍 Search (AJAX + normal GET)
* 📄 Pagination (10 records per page)

---

## 🧱 Project Structure

controllers/
models/
views/
core/
public/


---

## 🔐 Security

This project includes basic security implementations:

* PDO Prepared Statements (SQL Injection protection)
* htmlspecialchars (XSS protection)
* Input validation
* Proper HTTP methods (POST for delete)

---

## 🛠 Technologies

* PHP (Core)
* MySQL (PDO)
* JavaScript (AJAX)
* Bootstrap (for UI)

---

## 🚀 Setup Instructions

1. Clone the repository:

git clone https://github.com/zsydv/MaffinTech-Task-employee-management-core-php-.git


2. Move project into your local server directory:

* XAMPP → `htdocs`
* Laragon → `www`

3. Create database:

employee_system

4. Import table:

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(50),
    position VARCHAR(255),
    salary DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


5. Configure database connection:
   Edit file:

core/Database.php

6. Run project:

http://localhost/employee-system/public/

---

## 💡 Notes

* This project follows an MVC-like structure without using any PHP framework.
* Built as a technical assessment to demonstrate backend fundamentals and clean architecture.


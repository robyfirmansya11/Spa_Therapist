# Spa Therapist Management System

Web-based Spa Therapist Management System built with Laravel.

## 📌 About Project

This application is designed to help spa operational management, including:

* Therapist transaction management
* Spa service management
* Hotel management
* Revenue tracking
* Transaction reports
* Role-based access system

The system supports multiple user roles such as:

* Admin
* Manager
* Therapist

Therapists can only view and manage their own transactions, while Admin and Manager have full access to all data.

---

## 🚀 Features

### Authentication & Security

* Login Authentication
* Role Middleware
* Session Protection
* CSRF Protection
* Laravel Validation

### Transaction Management

* Create transaction
* Edit transaction
* Delete transaction
* Filter by:

  * Date
  * Bill Number
  * Therapist
  * Hotel

### Spa Service Management

* Add spa services
* Set duration
* Set pricing

### Reporting

* Revenue report
* Export report

### User Roles

| Role      | Access                |
| --------- | --------------------- |
| Admin     | Full Access           |
| Manager   | Full Access           |
| Therapist | Only own transactions |

---

## 🛠️ Tech Stack

### Backend

* Laravel
* PHP
* PostgreSQL

### Frontend

* Blade Template
* Bootstrap
* JavaScript

### Other Tools

* Git
* GitHub
* XAMPP / Herd

---

## 📂 Project Structure

```bash
app/
resources/
routes/
database/
public/
```

---

## ⚙️ Installation

Clone repository:

```bash
git clone https://github.com/robyfirmansya11/Spa_Therapist.git
```

Go to project folder:

```bash
cd Spa_Therapist
```

Install dependency:

```bash
composer install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate app key:

```bash
php artisan key:generate
```

Setup database inside `.env`

Run migration:

```bash
php artisan migrate
```

Run server:

```bash
php artisan serve
```

---

## 🔐 Security Notes

This project implements several Laravel security best practices:

* Authentication middleware
* Role authorization
* Mass assignment protection
* Request validation
* CSRF protection
* Secure session handling

---

## 📸 Screenshots

Coming soon.

---

## 👨‍💻 Developer

Developed by Roby Firmansyah

GitHub:
https://github.com/robyfirmansya11

---

## 📄 License

This project is for learning and internal operational purposes.

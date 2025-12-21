# BICC Finland - Mosque Management System

[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com/)
[![PHP Version](https://img.shields.io/badge/PHP-8.1-777BB4?style=flat-square&logo=php)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

## 📋 Overview

BICC Finland (Bangladesh Islamic Cultural Centre) is a comprehensive mosque management system built with Laravel. It features a polished frontend for the community and a robust admin dashboard for mosque administration to manage prayer times, classes, services, donations, and more.

## ✨ Key Features

### 🕌 Frontend (Community Portal)
- **Dynamic Prayer Times**: Real-time prayer schedules with "Next Prayer" highlighting.
- **Service Management**: Detailed view of mosque services (Matrimonial, Funeral, Counseling).
- **Islamic Classes**: Registration system for adult and children's Quranic studies.
- **Donation Tracking**: Visual progress bar for fundraising goals and donor recognition.
- **Image Fallback System**: Robust handling of missing images using professional placeholders.
- **Event Popups**: Session-aware notifications for upcoming mosque events.
- **Join Community**: Easy onboarding for new community members.
- **Contact System**: Direct messaging to mosque administration.

### 🔐 Admin Dashboard
- **Branding & Settings**: Manage site logos, favicons, hero sections, and mosque metadata.
- **Prayer Time Management**: CSV import for monthly schedules and manual override for daily times.
- **Service Requests**: Manage incoming requests for mosque services.
- **Class Registrations**: Track and manage students for Islamic classes.
- **Gallery Management**: Organize mosque photos by categories.
- **Event Management**: Create and toggle active status for homepage popups.
- **Donor Management**: Track offline and online donations.
- **Contact Messages**: Centralized inbox for all community inquiries.

## 🚀 Getting Started

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js & NPM

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Sydulamin/Bicc_Finland.git
   cd Bicc_Finland
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   - Create a database and update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in your `.env` file.

5. **Migrations & Seeding**
   Initialize the database with professional dummy data:
   ```bash
   php artisan migrate --seed
   ```

6. **Serve the Application**
   ```bash
   php artisan serve
   ```

## 🛠️ Commands & Utilities

- **Seed Dummy Data**: `php artisan db:seed` (Populates settings, classes, services, and mosque content).
- **Scaffold Admin Modules**: `php artisan make:crudx` (Utility for adding new management sections).
- **Asset Compilation**: `npm run dev` or `npm run build`.

## 🤝 Admin Credentials
After seeding, you can log in at `/admin/login`:
- **Default Email**: `admin@biccfinland.org` (or check `AdminUserSeeder.php`)
- **Default Password**: Consult development team or Seeder file.

## 📄 License
This project is licensed under the MIT License.

## 📧 Contact
For technical support or inquiries, please contact the development team at [info@biccfinland.org](mailto:info@biccfinland.org).

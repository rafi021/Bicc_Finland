# CBG Admin Starter

[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com/)
[![PHP Version](https://img.shields.io/badge/PHP-8.1-777BB4?style=flat-square&logo=php)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

## 📋 Overview

This repository is a lightweight Laravel starter that showcases a fully designed admin panel experience. It keeps the polished CBG admin UI, authentication flow, demo data scaffolding, and basic CRUD utilities so you can quickly pitch ideas or bootstrap a new product backstage. All public REST APIs have been intentionally removed to keep the surface area small and focused.

## 🚀 Highlights

- ✨ Beautiful admin panel with ready-to-use CRUD screens
- 🔐 Login/logout powered by Laravel Breeze-style guards
- 🧱 Database migrations & seeders for demo content
- 🧰 Utility command (`php artisan make:crudx`) to scaffold additional admin modules
- 🧪 Opinionated validation, form layouts, and table templates

## 🛠️ Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js & NPM (for frontend assets)

## 🚀 Getting Started

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/cbg-website-backend.git
   cd cbg-website-backend
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   npm run dev
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your .env file**
   Update the database connection details and other environment variables in the `.env` file.

6. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔧 Configuration

### Environment Variables

Create a `.env` file and configure the following variables:

```env
APP_NAME=CBG_Backend
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cbg_database
DB_USERNAME=root
DB_PASSWORD=
```

8. **Log into the admin**
   - Visit `http://127.0.0.1:8000/admin/login`
   - Use the seeded admin credentials (see `database/seeders/AdminUserSeeder.php`)

## 🧪 Testing

Run the test suite with:

```bash
php artisan test
```

## 🧑‍💻 Development

### Code Style

This project follows PSR-12 coding standards. To check and fix code style:

```bash
composer check-style
composer fix-style
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📧 Contact

For any questions or feedback, please contact the development team at [your-email@example.com](mailto:your-email@example.com).

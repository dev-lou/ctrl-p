<!--
   README: Updated on 2025-11-28
   Purpose: Developer-facing quickstart, setup instructions, and references.
-->

# Ctrl+P — CICT Student Council Merchandise & Services Platform

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Laravel 11](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![PHP 8.2](https://img.shields.io/badge/PHP-8.2-8892BF?style=flat&logo=php)](https://www.php.net)
[![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?style=flat&logo=vite)](https://vitejs.dev)
[![Tailwind](https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)

An e-commerce and service management platform powering the CICT Student Council’s merchandise and printing services. Built with Laravel and modern JS tooling, it includes inventory, order processing, a responsive UI, an admin dashboard, and Gemini AI chatbot integration for support.
---

## What is Ctrl+P?

Ctrl+P is a production-ready platform that enables the CICT Student Council to sell merchandise, manage inventory, process orders, and provide AI-assisted customer support. It ships with an admin UI for manager workflows and a responsive storefront optimized for accessibility.

---

## Tech Stack

- Backend: Laravel 11 (PHP 8.2+)
- Frontend: Vite, Alpine.js, Tailwind CSS
- DB: PostgreSQL (Neon / Supabase recommended)
- Storage: Supabase S3-compatible storage (via Flysystem)
- AI: Google Gemini generative models via API
- Deploy: Docker-ready for Render or other container platforms

---

## Setup & Installation (Developer Friendly)

Prerequisites
- PHP 8.2+ (with required extensions: pdo, pdo_pgsql, mbstring, openssl, zlib)
- Composer
- Node.js 18+ and npm/yarn
- Docker (optional for local containerized testing)

Clone the repository

```bash
git clone https://github.com/your-username/ctrl-p.git
cd ctrl-p
```

Install dependencies

```bash
# PHP (Composer)
composer install

# Node.js (Vite)
npm install
```

Environment configuration

1. Copy ` .env.example` to `.env`:

```bash
cp .env.example .env
```

2. Generate an application key

```bash
php artisan key:generate
```

3. Update your `.env` with the correct database credentials and third-party API keys. See the `Environment Variables` section below for required keys and details.

Database setup

```bash
php artisan migrate
# Optional seeding
php artisan db:seed
```

Build & run (local)

```bash
# Run Vite dev server
npm run dev

# Run the PHP server (or, use Docker)
php artisan serve --host=0.0.0.0 --port=8000
```

---

## Environment Variables

The repo uses `.env` for local and deployment configuration. For onboarding and source control safety:

- Copy `.env.example` to `.env` and add your own credentials.
- **Do not** commit `.env`. The repository `.gitignore` excludes `.env` and other sensitive files.
- Keep secrets in your environment provider (Render, GitHub Actions secrets, or Secret Manager).

Key settings you’ll typically configure in `.env` (short list):
```text
APP_KEY, APP_URL, APP_ENV, APP_DEBUG
DB_* or DATABASE_URL (Neon or Supabase) and DB_NEON_ENDPOINT
AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, AWS_ENDPOINT
SUPABASE_SERVICE_ROLE_KEY, SUPABASE_ANON_KEY
GEMINI_API_KEY, GEMINI_MODEL
SESSION_DRIVER, CACHE_STORE, QUEUE_CONNECTION
```

> **Warning:** If you accidentally commit secrets (e.g., API keys or DB passwords), rotate them immediately and follow the repo history purge instructions.

---

## Developer Experience & Workflow

- Use feature branches from `main` for development and PRs for code review.
- Write tests and add regression coverage for new features.
- Keep config in `.env` and avoid committing secrets.

Common developer commands:

```bash
# Install deps
composer install
npm install

# Dev server
npm run dev    # Vite HMR
php artisan serve

# Build & Test
npm run build:production
composer test

# DB
php artisan migrate --seed

# Clean caches
php artisan cache:clear && php artisan config:clear && php artisan view:clear
```

---

## Running in Docker (Render / Local)

The repository includes a Dockerfile and Docker Compose example for local testing. For Render, use the Docker build flow and set your environment variables in the Render dashboard.

Local (Docker Compose) quickstart:
```bash
docker-compose build
docker-compose up -d
# Run migrations inside container if needed
docker exec -it <app_container> php artisan migrate --force
```

Render Deploy tips:
- Add environment variables in Render’s Dashboard Secrets section.
- Ensure `APP_KEY` is generated and `APP_DEBUG=false` for production.
- Migrations can run in a deploy hook or from a Render shell using `php artisan migrate --force`.

---


## Tests & Quality

- The project uses PHPUnit for backend tests and scripts for tooling checks.
- Run the test suite with:
```bash
composer test
```

Add CI (GitHub Actions) to run `composer test`, style checks, and a secret scanning job as part of PR checks.

---


## Contributing

We welcome contributions — please follow these steps:

1. Fork and create a feature branch.
2. Add tests for new behavior and update documentation where appropriate.
3. Format code and run tests before creating a PR.
4. A maintainer will review. Keep PRs focused and self-contained.

Please follow the GitHub `Contributing` and `Code of Conduct` guidelines in this repo if they exist.

---


---

## Additional Resources & Support

If you need help or want to report a bug, open an issue in the repo or contact the repo owner.

**Thank you for contributing to Ctrl+P!**


---

If you need any help setting up or running, open an issue or reach out to the repository owner.

**Thank you — built with care for the CICT Student Council.**
# 🛒 Ctrl+P - CICT Student Council Merchandise & Services Platform

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?style=flat&logo=vite)](https://vitejs.dev)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A modern, full-stack e-commerce platform built for the **CICT Student Council** to manage merchandise sales and printing services. Features include real-time inventory management, order tracking, AI-powered chatbot support, and comprehensive admin dashboard.

---

## ✨ Features

### 🛍️ Customer Features
- **Browse Products** - View merchandise and printing services with variant selection (size, color)
- **Shopping Cart** - Add items, adjust quantities, and manage cart with real-time price updates
- **Secure Checkout** - Enter shipping address and payment details
- **Order Tracking** - View order history with status updates (Pending → Processing → Completed)
- **User Profile** - Manage personal information and profile picture
- **Notifications** - Receive order status updates
- **AI Chatbot** - Get instant support via Gemini-powered assistant

### 🔧 Admin Features
- **Inventory Management** - Track stock levels, add/edit products, manage variants
- **Order Management** - Update order statuses, view customer details
- **Analytics Dashboard** - Sales reports, revenue tracking, low-stock alerts
- **User Management** - Manage customer accounts, assign roles (Admin/Staff/Customer)
- **Audit Logs** - Track all system changes with full audit trail

---

## 🚀 Tech Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 11.x | Backend framework (MVC, ORM, routing) |
| **PHP** | 8.2+ | Server-side language |
| **Vite** | 7.0 | Frontend build tool (HMR, minification) |
| **Tailwind CSS** | 4.0 | Utility-first CSS framework |
| **Alpine.js** | 3.x | Lightweight JavaScript framework |
| **MySQL** | 8.0+ | Relational database |
| **PostgreSQL** | 13+ | Production database (Neon) |
| **Gemini API** | 2.0 | AI chatbot integration (Google) |
| **Docker** | - | Containerized deployment |
| **Render** | - | Cloud hosting platform |

---

## 📦 Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ & npm
- MySQL 8.0+ or PostgreSQL 13+

### Step 1: Clone Repository
```bash
git clone https://github.com/your-username/ctrl-p.git
cd ctrl-p
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure `.env` File
```env
APP_NAME="Ctrl+P"
APP_ENV=local
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_igp
DB_USERNAME=root
DB_PASSWORD=

# Gemini AI Chatbot
GEMINI_API_KEY=your-gemini-api-key-here
GEMINI_MODEL=gemini-2.0-flash
```

**Get Gemini API Key:** [Google AI Studio](https://aistudio.google.com/app/apikey)

### Step 5: Database Setup
```bash
# Run migrations
php artisan migrate

# (Optional) Seed demo data
php artisan db:seed
```

### Step 6: Build Frontend Assets
```bash
# Development build with hot reload
npm run dev

# Production build (minified)
npm run build:production
```

### Step 7: Run Application
```bash
# Start Laravel development server
php artisan serve

# Application will run at: http://localhost:8000
```

---

## 🐳 Deployment to Render (Docker)

### Step 1: Push to GitHub
```bash
git add .
git commit -m "Prepare for Docker deployment"
git push origin main
```

### Step 2: Create Render Web Service
1. Go to [Render Dashboard](https://dashboard.render.com)
2. Click **New** → **Web Service**
3. Connect your GitHub repository
4. Configure:
   - **Environment**: Docker
   - **Branch**: main
   - **Instance Type**: Free or Starter

### Step 3: Configure Environment Variables
In Render dashboard (Environment → Environment Variables):

```env
APP_NAME="Ctrl+P"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_PRODUCTION_KEY
APP_URL=https://your-app.onrender.com

# Database (Neon PostgreSQL)
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://user:pass@host/db?sslmode=require

# Gemini API
GEMINI_API_KEY=your-production-gemini-key
GEMINI_MODEL=gemini-2.0-flash

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
```

### Step 4: Run Migrations
After deployment, open **Shell** in Render dashboard:
```bash
php artisan migrate --force
php artisan db:seed --force  # Optional
```

### Local Docker Testing
```bash
# Build the image
docker build -t ctrl-p .

# Run the container
docker run -p 8080:80 --env-file .env ctrl-p

# Access at http://localhost:8080
```

---

## 📂 Project Structure

```
ctrl-p/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Business logic
│   │   └── Middleware/          # Request filters
│   ├── Models/                  # Database models
│   ├── Services/                # Business logic helpers
│   └── Providers/               # Service providers
├── database/
│   ├── migrations/              # Database schema
│   └── seeders/                 # Sample data
├── resources/
│   ├── views/                   # Blade templates
│   ├── css/                     # Tailwind styles
│   └── js/                      # Alpine.js components
├── routes/
│   └── web.php                  # Application routes
├── public/
│   ├── build/                   # Compiled assets (Vite)
│   ├── images/                  # Static images
│   └── storage/                 # Symlink to storage/app/public
├── .env.example                 # Environment template
├── Dockerfile                   # Docker configuration for Render
├── .dockerignore                # Docker build exclusions
└── composer.json                # PHP dependencies
```

---

## 🎨 Key Features Walkthrough

### Shopping Flow
1. **Browse Products** → Customer views merchandise catalog
2. **Add to Cart** → Select product variants (size, color)
3. **Checkout** → Enter shipping address and payment method
4. **Order Confirmation** → Receive order number and status updates

### Admin Workflow
1. **Dashboard** → View sales analytics and low-stock alerts
2. **Inventory** → Add/edit products, manage stock levels
3. **Orders** → Update order statuses (Pending → Processing → Completed)
4. **Audit Logs** → Track all system changes

### AI Chatbot
- **Gemini 2.0 Flash** integration for customer support
- Answers questions about orders, products, and navigation
- Security-hardened system prompt (no jailbreak vulnerabilities)
- Real-time response with typing indicators

---

## 🔒 Security Features

- ✅ **CSRF Protection** - Laravel's built-in token validation
- ✅ **SQL Injection Prevention** - Eloquent ORM parameterized queries
- ✅ **XSS Protection** - Blade template escaping
- ✅ **Role-Based Access Control** - Admin/Staff/Customer permissions
- ✅ **Audit Logging** - Track all database changes
- ✅ **Password Hashing** - Bcrypt with 12 rounds
- ✅ **Session Security** - HTTP-only cookies, HTTPS enforcement

---

## 📊 Database Schema

### Core Tables
- `users` - Customer accounts with role-based access
- `products` - Merchandise and services catalog
- `product_variants` - Size/color options for products
- `orders` - Customer order records
- `order_items` - Line items for each order
- `inventory_history` - Stock movement tracking
- `audit_logs` - System change history

---

## 🛠️ Development Scripts

```bash
# Development server with hot reload
npm run dev
php artisan serve

# Production build
npm run build:production

# Run database migrations
php artisan migrate

# Seed demo data
php artisan db:seed

# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Code quality checks
composer check:route-params  # Validate route parameters
```

---

## 🐛 Troubleshooting

### Issue: Assets Not Loading
```bash
npm run build:production
php artisan cache:clear
```

### Issue: Docker Build Failed
```bash
# Rebuild without cache
docker build --no-cache -t ctrl-p .

# Check build logs for missing dependencies
```

### Issue: Database Connection Failed
```bash
# Verify database credentials in .env
php artisan tinker
>>> DB::connection()->getPdo();
```

### Issue: Render 502/504 Error
```bash
# Check logs in Render dashboard
# Ensure DATABASE_URL is set correctly
# Verify APP_KEY is generated
```

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Lou Vincent Baroro**  
CICT Student Council - Information Systems Developer

---

## 🙏 Acknowledgments

- **Laravel** - PHP framework
- **Tailwind CSS** - Utility-first CSS
- **Google Gemini** - AI chatbot integration
- **Render** - Cloud hosting platform
- **Neon** - Serverless PostgreSQL

---

## 📞 Support

For issues or questions:
- Open an issue on GitHub
- Contact CICT Student Council office
- Email: support@ctrl-p.com

---

**Built with ❤️ for the CICT Student Council**

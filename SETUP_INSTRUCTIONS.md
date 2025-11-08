# 🥖 Artisan Bakery - Complete Setup Guide

## Overview
This is a complete bakery website with:
- **3 public HTML pages** (Home, About, Order Form)
- **Laravel backend** for order management
- **Admin dashboard** to view all customer orders with full details
- **CRUD operations** (Create, Read, Update, Delete orders)
- **Authentication** using Laravel Breeze (secure admin login)
- **MariaDB/MySQL database** to store customer orders

---

## 📋 Prerequisites

Before you begin, make sure you have installed:
- **PHP 8.1+** ([Download](https://windows.php.net/download/))
- **Composer** ([Download](https://getcomposer.org/download/))
- **Node.js & NPM** ([Download](https://nodejs.org/))
- **MariaDB/MySQL** ([Download XAMPP](https://www.apachefriends.org/) or [MariaDB](https://mariadb.org/download/))

---

## 🚀 Installation Steps

### Step 1: Install Laravel Dependencies
```powershell
cd c:\Users\tommi\OneDrive\Pictures\Desktop\bakery
composer install
```

### Step 2: Create Environment File
```powershell
copy .env.example .env
```

### Step 3: Generate Application Key
```powershell
php artisan key:generate
```

### Step 4: Configure Database
1. **Start XAMPP/MariaDB** (start Apache & MySQL)
2. **Create database** using phpMyAdmin or command line:
   ```sql
   CREATE DATABASE bakery_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. **Update `.env` file** with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bakery_db
   DB_USERNAME=root
   DB_PASSWORD=your_password_here
   ```

### Step 5: Run Database Migrations
```powershell
php artisan migrate
```
This creates all necessary tables (orders, users, sessions, etc.)

### Step 6: Install Laravel Breeze (Authentication)
```powershell
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

### Step 7: Create Admin User
```powershell
php artisan tinker
```
Then run this in the tinker console:
```php
\App\Models\User::create(['name' => 'Admin User', 'email' => 'admin@artisanbakery.com', 'password' => bcrypt('password')]);
exit
```

### Step 8: (Optional) Seed Sample Customer Orders
```powershell
php artisan db:seed --class=OrderSeeder
```
This adds 8 sample customer orders so you can see how the dashboard looks.

### Step 9: Start the Development Server
```powershell
php artisan serve
```

---

## 🌐 Access the Website

### Public Pages (No Login Required)
| Page | URL | Description |
|------|-----|-------------|
| **Home** | `http://localhost:8000/` | Landing page with product gallery |
| **About** | `http://localhost:8000/about.html` | Company story and team |
| **Order Form** | `http://localhost:8000/contact.html` | Customer order submission form |

### Admin Pages (Login Required)
| Page | URL | Description |
|------|-----|-------------|
| **Login** | `http://localhost:8000/login` | Admin login page |
| **Dashboard** | `http://localhost:8000/dashboard` | **View all customer orders with details** |
| **All Orders** | `http://localhost:8000/orders` | Table view of all orders (CRUD) |
| **Create Order** | `http://localhost:8000/orders/create` | Manually add new order |
| **View Order** | `http://localhost:8000/orders/{id}` | Full customer order details |
| **Edit Order** | `http://localhost:8000/orders/{id}/edit` | Update existing order |

---

## 🔐 Login Credentials

**Admin Login:**
- **URL**: `http://localhost:8000/login`
- **Email**: `admin@artisanbakery.com`
- **Password**: `password`

**How to access admin**: Look for the small "Staff" link in the footer of the public website (it's subtle so customers don't notice it).

---

## 📊 What the Admin Dashboard Shows

When you log in and go to the **Dashboard**, you'll see:

1. **Statistics Cards**:
   - Total orders count
   - Today's new orders
   - Today's pickups
   - Newsletter subscribers

2. **Orders by Type**:
   - Pickup orders
   - Catering orders
   - Custom cakes
   - Weekly subscriptions

3. **Recent Customer Orders Table** with:
   - Order ID
   - Customer full name
   - Email address (clickable mailto link)
   - Phone number (clickable tel link)
   - Order type (pickup/catering/custom-cake/weekly)
   - Pickup date & time
   - Order details preview
   - Submission timestamp
   - "View Details" button

4. **Quick Actions**:
   - Create new order
   - View all orders
   - Visit public website

---

## 🗂️ Database Structure

### `orders` Table
Stores all customer order information:
- `id` - Unique order ID
- `first_name` - Customer first name
- `last_name` - Customer last name
- `email` - Customer email
- `phone` - Customer phone number
- `order_type` - Type: pickup, catering, custom-cake, weekly
- `pickup_date` - Preferred pickup date
- `pickup_time` - Preferred pickup time
- `products` - JSON array of selected products
- `dietary` - Dietary preferences/allergies
- `order_details` - Full order description
- `newsletter` - Newsletter subscription (boolean)
- `sms_alerts` - SMS alerts preference (boolean)
- `created_at` - Order submission timestamp
- `updated_at` - Last update timestamp

### `users` Table
Admin users who can access the dashboard

---

## 🔧 Common Commands

```powershell
# Start development server
php artisan serve

# Run migrations (create database tables)
php artisan migrate

# Seed sample data
php artisan db:seed --class=OrderSeeder

# Create new admin user
php artisan tinker
\App\Models\User::create(['name' => 'John Doe', 'email' => 'john@example.com', 'password' => bcrypt('password')]);

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# View all routes
php artisan route:list

# Check database connection
php artisan migrate:status
```

---

## 📱 How It Works - Complete Workflow

### Customer Side:
1. Customer visits `http://localhost:8000/contact.html`
2. Fills out the order form with their details
3. Clicks "Submit Order Request"
4. Form data is sent to Laravel backend (`POST /orders`)
5. Laravel validates and saves to database
6. Customer sees success message

### Admin Side:
1. Admin visits `http://localhost:8000/login` (or clicks "Staff" in footer)
2. Logs in with credentials
3. Goes to Dashboard → sees all customer orders with full details
4. Can:
   - **View** complete order information (name, email, phone, order details, preferences)
   - **Edit** orders (update dates, modify details)
   - **Delete** old/cancelled orders
   - **Create** manual orders (phone/walk-in customers)
   - **Filter** orders by type
   - **Contact** customers (click email or phone links)

---

## 🛡️ Security Features

- ✅ **Authentication required** - Only logged-in admins can access orders
- ✅ **CSRF protection** - Prevents unauthorized form submissions
- ✅ **Password hashing** - Bcrypt encryption for admin passwords
- ✅ **SQL injection protection** - Laravel Eloquent ORM
- ✅ **Validation** - Server-side validation for all form inputs
- ✅ **Hidden admin access** - No visible admin button for public users

---

## 🐛 Troubleshooting

### "Target class [OrderController] does not exist"
Make sure you've installed Composer dependencies:
```powershell
composer install
```

### "SQLSTATE[HY000] [1049] Unknown database"
Create the database first:
```sql
CREATE DATABASE bakery_db;
```

### Can't access login page
Make sure Laravel Breeze is installed:
```powershell
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

### "Route [login] not defined"
Run:
```powershell
php artisan route:clear
php artisan config:clear
```

---

## 📞 Support

For issues or questions, check:
- Laravel Documentation: https://laravel.com/docs
- Laravel Breeze: https://laravel.com/docs/starter-kits#laravel-breeze

---

## ✅ Checklist

- [ ] PHP, Composer, Node.js installed
- [ ] MariaDB/MySQL running (XAMPP started)
- [ ] `composer install` completed
- [ ] `.env` file created and configured
- [ ] `php artisan key:generate` run
- [ ] Database created (`bakery_db`)
- [ ] `php artisan migrate` completed
- [ ] Laravel Breeze installed
- [ ] Admin user created
- [ ] Sample data seeded (optional)
- [ ] `php artisan serve` running
- [ ] Can access `http://localhost:8000/login`
- [ ] Can log in and see dashboard with customer orders

---

**You're all set! 🎉**

Access your admin dashboard at: `http://localhost:8000/login`

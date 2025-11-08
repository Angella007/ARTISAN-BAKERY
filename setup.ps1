# Artisan Bakery - Quick Setup Script for Windows
# Run this script in PowerShell to set up the Laravel backend

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Artisan Bakery - Laravel Setup" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if Composer is installed
Write-Host "Checking for Composer..." -ForegroundColor Yellow
if (Get-Command composer -ErrorAction SilentlyContinue) {
    Write-Host "✓ Composer found" -ForegroundColor Green
} else {
    Write-Host "✗ Composer not found. Please install Composer first." -ForegroundColor Red
    Write-Host "Download from: https://getcomposer.org/download/" -ForegroundColor Yellow
    exit 1
}

# Check if PHP is installed
Write-Host "Checking for PHP..." -ForegroundColor Yellow
if (Get-Command php -ErrorAction SilentlyContinue) {
    $phpVersion = php -r "echo PHP_VERSION;"
    Write-Host "✓ PHP $phpVersion found" -ForegroundColor Green
} else {
    Write-Host "✗ PHP not found. Please install PHP 8.1 or higher." -ForegroundColor Red
    exit 1
}

# Check if Node.js is installed
Write-Host "Checking for Node.js..." -ForegroundColor Yellow
if (Get-Command node -ErrorAction SilentlyContinue) {
    $nodeVersion = node --version
    Write-Host "✓ Node.js $nodeVersion found" -ForegroundColor Green
} else {
    Write-Host "✗ Node.js not found. Please install Node.js 16 or higher." -ForegroundColor Red
    Write-Host "Download from: https://nodejs.org/" -ForegroundColor Yellow
    exit 1
}

Write-Host ""
Write-Host "All prerequisites found! Starting setup..." -ForegroundColor Green
Write-Host ""

# Step 1: Install PHP dependencies
Write-Host "[1/8] Installing PHP dependencies with Composer..." -ForegroundColor Cyan
composer install --no-interaction
if ($LASTEXITCODE -ne 0) {
    Write-Host "✗ Composer install failed" -ForegroundColor Red
    exit 1
}
Write-Host "✓ PHP dependencies installed" -ForegroundColor Green
Write-Host ""

# Step 2: Create .env file
Write-Host "[2/8] Creating .env file..." -ForegroundColor Cyan
if (Test-Path .env) {
    Write-Host "⚠ .env already exists, skipping..." -ForegroundColor Yellow
} else {
    Copy-Item .env.example .env
    Write-Host "✓ .env file created" -ForegroundColor Green
}
Write-Host ""

# Step 3: Generate application key
Write-Host "[3/8] Generating application key..." -ForegroundColor Cyan
php artisan key:generate --ansi
Write-Host "✓ Application key generated" -ForegroundColor Green
Write-Host ""

# Step 4: Configure database
Write-Host "[4/8] Database Configuration" -ForegroundColor Cyan
Write-Host "Please enter your MariaDB/MySQL database details:" -ForegroundColor Yellow
Write-Host ""

$dbName = Read-Host "Database name (default: bakery_db)"
if ([string]::IsNullOrWhiteSpace($dbName)) { $dbName = "bakery_db" }

$dbUser = Read-Host "Database username (default: root)"
if ([string]::IsNullOrWhiteSpace($dbUser)) { $dbUser = "root" }

$dbPass = Read-Host "Database password (leave empty if none)" -AsSecureString
$dbPassPlain = [Runtime.InteropServices.Marshal]::PtrToStringAuto(
    [Runtime.InteropServices.Marshal]::SecureStringToBSTR($dbPass)
)

# Update .env file
(Get-Content .env) | ForEach-Object {
    $_ -replace "DB_DATABASE=.*", "DB_DATABASE=$dbName" `
       -replace "DB_USERNAME=.*", "DB_USERNAME=$dbUser" `
       -replace "DB_PASSWORD=.*", "DB_PASSWORD=$dbPassPlain"
} | Set-Content .env

Write-Host "✓ Database configuration updated" -ForegroundColor Green
Write-Host ""

# Step 5: Install Laravel Breeze
Write-Host "[5/8] Installing Laravel Breeze (authentication)..." -ForegroundColor Cyan
composer require laravel/breeze --dev --no-interaction
php artisan breeze:install blade --no-interaction
Write-Host "✓ Laravel Breeze installed" -ForegroundColor Green
Write-Host ""

# Step 6: Install NPM dependencies
Write-Host "[6/8] Installing Node.js dependencies..." -ForegroundColor Cyan
npm install
if ($LASTEXITCODE -ne 0) {
    Write-Host "✗ NPM install failed" -ForegroundColor Red
    exit 1
}
Write-Host "✓ Node.js dependencies installed" -ForegroundColor Green
Write-Host ""

# Step 7: Build frontend assets
Write-Host "[7/8] Building frontend assets..." -ForegroundColor Cyan
npm run build
Write-Host "✓ Frontend assets built" -ForegroundColor Green
Write-Host ""

# Step 8: Run migrations
Write-Host "[8/8] Running database migrations..." -ForegroundColor Cyan
Write-Host "Make sure your database '$dbName' exists before continuing!" -ForegroundColor Yellow
$continue = Read-Host "Continue with migrations? (Y/N)"
if ($continue -eq "Y" -or $continue -eq "y") {
    php artisan migrate --force
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Database migrations completed" -ForegroundColor Green
    } else {
        Write-Host "✗ Migration failed. Please create the database manually:" -ForegroundColor Red
        Write-Host "  mysql -u $dbUser -p -e `"CREATE DATABASE $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`"" -ForegroundColor Yellow
    }
} else {
    Write-Host "⚠ Skipped migrations. Run 'php artisan migrate' manually later." -ForegroundColor Yellow
}
Write-Host ""

# Setup complete
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Setup Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Create an admin user:" -ForegroundColor White
Write-Host "   php artisan tinker" -ForegroundColor Yellow
Write-Host "   Then run:" -ForegroundColor White
Write-Host "   `$user = new App\Models\User();" -ForegroundColor Yellow
Write-Host "   `$user->name = 'Admin';" -ForegroundColor Yellow
Write-Host "   `$user->email = 'admin@artisanbakery.com';" -ForegroundColor Yellow
Write-Host "   `$user->password = Hash::make('password123');" -ForegroundColor Yellow
Write-Host "   `$user->save();" -ForegroundColor Yellow
Write-Host "   exit" -ForegroundColor Yellow
Write-Host ""
Write-Host "2. Start the development server:" -ForegroundColor White
Write-Host "   php artisan serve" -ForegroundColor Yellow
Write-Host ""
Write-Host "3. Access the application:" -ForegroundColor White
Write-Host "   Public Site:  http://localhost:8000/index.html" -ForegroundColor Yellow
Write-Host "   Admin Login:  http://localhost:8000/login" -ForegroundColor Yellow
Write-Host "   Orders:       http://localhost:8000/orders" -ForegroundColor Yellow
Write-Host ""
Write-Host "For detailed instructions, see README.md" -ForegroundColor Cyan
Write-Host ""

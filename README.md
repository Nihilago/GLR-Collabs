# GLR Collabs - MVC PHP Application

A modern PHP MVC application for student collaboration and project help requests.

## Features

- User registration and authentication
- Secure password hashing
- Session management
- Clean URL routing
- Responsive design with TailwindCSS
- MVC architecture
- PDO database connection

## Project Structure

```
/
├── config/
│   └── database.php          # Database configuration
├── controllers/
│   ├── BaseController.php    # Base controller class
│   ├── HomeController.php    # Home page controller
│   ├── AuthController.php    # Authentication controller
│   └── DashboardController.php # Dashboard controller
├── models/
│   └── User.php              # User model
├── views/
│   ├── layout.php            # Main layout template
│   ├── home/
│   │   └── index.php         # Home page view
│   ├── auth/
│   │   ├── login.php         # Login page view
│   │   └── register.php      # Registration page view
│   ├── dashboard/
│   │   └── index.php         # Dashboard view
│   └── 404.php               # 404 error page
├── utils/
│   ├── Router.php            # URL routing system
│   └── Session.php           # Session management
├── public/
│   ├── css/                  # Custom CSS files
│   └── js/                   # Custom JavaScript files
├── index.php                 # Application entry point
├── .htaccess                 # Apache rewrite rules
└── .env.example              # Environment variables template
```

## Setup Instructions

1. **Database Setup**: 
   - Create a MySQL database using the provided SQL script
   - Update database credentials in `config/database.php`

2. **Web Server Configuration**:
   - Place files in your web server directory
   - Ensure mod_rewrite is enabled for clean URLs
   - Point document root to the project directory

3. **Permissions**:
   - Ensure PHP has write permissions for session files
   - Set appropriate file permissions (644 for files, 755 for directories)

## Database Schema

The application requires a `users` table with the following structure:
- `id` (Primary Key, Auto Increment)
- `full_name` (VARCHAR)
- `email` (VARCHAR, Unique)
- `password` (VARCHAR, Hashed)
- `created_at` (TIMESTAMP)
- `last_login` (TIMESTAMP, Nullable)

## Routes

- `GET /` - Home page
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Registration form  
- `POST /register` - Process registration
- `GET /dashboard` - User dashboard (requires login)
- `GET /logout` - Logout user

## Security Features

- Password hashing using PHP's `password_hash()`
- Prepared statements to prevent SQL injection
- Session-based authentication
- Input validation and sanitization
- CSRF protection ready (can be extended)

## Technologies Used

- PHP 7.4+ with PDO
- MySQL/MariaDB
- TailwindCSS for styling
- Apache with mod_rewrite

## Development

For development, enable error reporting by ensuring these lines are in `index.php`:

```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## License

This project is open source and available under the [MIT License](LICENSE).

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
glr_collabs_fixed/
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
└── database_setup.sql        # Database schema

## Installation

1. Upload all files to your web server
2. Configure database settings in `config/database.php`
3. Import `database_setup.sql` into your MySQL database
4. Ensure Apache mod_rewrite is enabled
5. Access your application at: https://yourdomain.com/collabs/

## Fixed Issues
- Added missing login.php and register.php views
- Fixed routing with proper .htaccess configuration
- Ensured all navigation links use absolute paths
- Added trailing slash handling in router

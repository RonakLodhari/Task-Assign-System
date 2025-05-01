# Expense Tracker Application

A comprehensive web application for tracking daily expenses with user authentication, expense management, and data visualization features.

## Login Credentials
- Admin Email: admim@gmail.com
- Password: admin123

- User Email: ronak@gmail.com
- Password: ronak123

## Features

### User Authentication
- Secure email and password registration/login
- Session management
- Password hashing for security
- Reference: PHP Authentication Best Practices

### Expense Management
- Add, edit, and delete expenses
- Categorize expenses
- Date-based tracking
- Detailed expense history
- Reference: PHP PDO Database Operations

### Data Visualization
- Interactive charts using Chart.js
- Monthly expense trends
- Category-wise breakdown
- Daily expense patterns
- Reference: Chart.js Documentation

### Additional Features
- Export expenses to CSV
- Responsive design for mobile access
- Data filtering and sorting
- Reference: Bootstrap Grid System

## Technical Stack
- PHP 7.4+ for server-side logic
- MySQL 5.7+ for database management
- Bootstrap 5 for responsive UI
- Chart.js for data visualization
- JavaScript for client-side interactions

## Prerequisites
- Web server (Apache/Nginx)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer (PHP package manager)

## Installation

1. Clone the repository:
```bash
git clone VandanVaghamshi/Expense-Tracker-Application
cd expense-tracker
```

2. Configure database:
- Create a new MySQL database
- Import the schema from database/expense_tracker.sql
- Update database credentials in config/database.php
- Reference: MySQL Import/Export

3. Install dependencies:
```bash
composer install
```

4. Configure web server:
- Point document root to the project directory
- Ensure mod_rewrite is enabled for Apache
- Reference: Apache Configuration

5. Set permissions:
- Ensure write permissions for logs directory
- Configure file ownership appropriately

## Project Structure
```
expense-tracker/
├── assets/           # Static files (CSS, JS, images)
├── config/           # Configuration files
├── controllers/      # Application controllers
├── database/         # Database schema and migrations
├── includes/         # Common PHP includes
├── models/           # Data models
├── views/            # View templates
└── logs/             # Application logs
```

## Security Considerations
- All user inputs are sanitized and validated
- Passwords are hashed using PHP's password_hash()
- PDO prepared statements prevent SQL injection
- Session management for secure authentication
- Reference: PHP Security Guide

## Troubleshooting
- Check logs in logs/app.log for errors
- Verify database connection settings
- Ensure proper file permissions
- Reference: PHP Error Handling

## Contributing
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## Additional Resources
- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Chart.js Examples](https://www.chartjs.org/docs/latest/samples/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)
- [Stack Overflow - PHP PDO Examples](https://stackoverflow.com/questions/tagged/pdo)
- [Stack Overflow - Chart.js Solutions](https://stackoverflow.com/questions/tagged/chart.js)

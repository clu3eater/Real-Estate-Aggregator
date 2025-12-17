# Real Estate Aggregator

A web-based real estate management system built with PHP and MySQL for listing, browsing, and managing property listings.

## Features

- User registration and authentication
- Property listing management (add, edit, delete)
- Property browsing and search
- Admin dashboard for property management
- Property inquiry system
- Property purchase/booking functionality
- Image upload for properties

## Technologies Used

- PHP
- MySQL
- HTML/CSS/JavaScript
- XAMPP (Apache & MySQL)

## Setup

### Prerequisites

- XAMPP installed on your system
- Web browser
- Git (optional)

### Installation Steps

1. **Clone or download the repository**
   ```bash
   git clone https://github.com/clu3eater/Real-Estate-Aggregator.git
   ```
   Or download and extract the ZIP file.

2. **Move to XAMPP directory**
   - Copy the project folder to `C:\xampp\htdocs\` (Windows) or `/opt/lampp/htdocs/` (Linux)

3. **Start XAMPP**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

4. **Create Database**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create a new database named `realestate`
   - Import the SQL file if provided, or create tables as needed

5. **Configure Database Connection**
   - Open `includes/db.php`
   - Update database credentials if necessary:
     ```php
     $host = 'localhost';
     $dbname = 'realestate';
     $username = 'root';
     $password = '';
     ```

6. **Set Permissions**
   - Ensure the `uploads/` folder has write permissions for image uploads

## Usage

### Accessing the Application

1. Open your web browser
2. Navigate to: `http://localhost/realestate/`

### User Registration

1. Click on "Register" or navigate to `register.php`
2. Fill in the registration form
3. Submit to create your account

### Login

1. Click on "Login" or navigate to `login.php`
2. Enter your credentials
3. Access the dashboard

### Adding Properties (Admin)

1. Log in as admin
2. Navigate to Admin Dashboard
3. Click "Add Property"
4. Fill in property details and upload images
5. Submit the form

### Browsing Properties

1. Navigate to "View Properties" or `view_properties.php`
2. Browse available listings
3. Click on properties to view details
4. Submit inquiries or purchase requests

## Project Structure

```
realestate/
├── index.php              # Home page
├── login.php              # User login
├── register.php           # User registration
├── logout.php             # Logout functionality
├── admin_dashboard.php    # Admin panel
├── add_property.php       # Add new property
├── edit_property.php      # Edit existing property
├── view_properties.php    # Browse properties
├── inquiry.php            # Property inquiries
├── purchase.php           # Property purchase
├── includes/
│   ├── db.php            # Database connection
│   ├── header.php        # Header template
│   └── footer.php        # Footer template
├── css/
│   └── custom.css        # Custom styles
├── js/
│   └── scripts.js        # JavaScript functions
└── uploads/              # Property images
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is open source and available for educational purposes.

## Contact

For questions or support, please open an issue on GitHub.
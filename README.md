# Dorothea Rescue Centre - Admission Form System

A comprehensive digital system for Dorothea Rescue Centre, built with Laravel and Filament. This system replaces manual paper-based forms with a user-friendly web interface for managing child admissions, tracking information, and generating professional PDF documents.

## Project Overview

Dorothea Rescue Centre is a rescue center dedicated to providing care and support for vulnerable children. This system digitizes the entire admission process, making it easier for staff to:

- Capture comprehensive child admission information through a multi-step wizard
- View and manage all child records in an organized interface
- Generate professional PDF admission forms
- Track education, health, family, and rescue details

##  Features

###  Multi-Step Admission Form
- **6-Step Wizard Interface** for structured data entry:
  1. Child Information (personal details, place of birth)
  2. Admission Details (referral information, care placement, reasons for admission)
  3. Rescue Details (found location, case history, previous placements)
  4. Education Background (school history, current education)
  5. Family Information (parents, siblings)
  6. Health Status & Signatures

###  Data Management
- **Comprehensive Record Viewing** with organized tabs:
  - Personal Info
  - Place of Birth
  - Admission Details
  - Rescue & Case History
  - Education
  - Family
  - Health
  - Signatures

###  PDF Export
- Generate professional PDF admission forms
- Matches original form layout and design
- Includes all collected information and signatures

###  Beautiful Landing Page
- Modern, inspirational landing page
- African-inspired design elements
- Brand colors: Jungle Green, Yellow, and Maroon
- Responsive design for all devices

##  Technology Stack

- **Framework:** Laravel 12
- **Admin Panel:** Filament 4
- **Database:** MySQL
- **PDF Generation:** DomPDF (barryvdh/laravel-dompdf)
- **Frontend:** Blade Templates, Custom CSS

##  Requirements

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM (for assets)

##  Installation

1. **Clone the repository:**
   ```bash
   git clone git@github.com:Joseachiengphine/dorothea-rescue-centre.git
   cd dorothea-rescue-centre
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database in `.env`:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations:**
   ```bash
   php artisan migrate
   ```

6. **Create storage link:**
   ```bash
   php artisan storage:link
   ```

7. **Build assets:**
   ```bash
   npm run build
   ```

8. **Start the development server:**
   ```bash
   php artisan serve
   ```

9. **Access the application:**
   - Landing Page: `http://localhost:8000`
   - Admin Panel: `http://localhost:8000/admin`
   - Login with your admin credentials

##  Project Structure

```
dorothea-rescue-centre/
├── app/
│   ├── Filament/Resources/        # Filament resource definitions
│   ├── Models/                     # Eloquent models
│   └── Providers/                  # Service providers
├── database/
│   └── migrations/                 # Database migrations
├── public/
│   └── images/                     # Public images (logo, landing page images)
├── resources/
│   ├── views/
│   │   ├── landing.blade.php      # Landing page
│   │   └── pdf/
│   │       └── admission-form.blade.php  # PDF template
│   ├── css/
│   └── js/
└── routes/
    └── web.php                     # Web routes
```

##  Brand Colors

- **Primary (Maroon):** `#4E1B1B`
- **Success (Jungle Green):** `#29AB87`
- **Warning/Info (Yellow):** `#FFFF00`

##  Documentation

- **Technical Documentation:** See `PROJECT_DOCUMENTATION.md`
- **Simple Guide:** See `PROJECT_DOCUMENTATION_SIMPLE.md`
- **Database Schema:** See `CORRECTED_SCHEMA.sql`

##  Admin Access

Access the admin panel at `/admin/login`. Create your first admin user:

```bash
php artisan make:filament-user
```

##  Key Features Details

### Admission Form Wizard
- Full-width, step-by-step interface
- Conditional fields (e.g., education fields appear when toggles are enabled)
- File uploads for signatures
- Validation at each step

### Data Display
- Tabbed interface for organized viewing
- Color-coded badges for status indicators
- Icons for visual recognition
- Markdown support for long text fields

### PDF Generation
- Professional header with logo
- All form sections included
- Tables for parents, siblings, and placements
- Signature image support


##  Contributing

This is a private project for Dorothea Rescue Centre. For questions or issues, please contact the development team.

##  License

This project is proprietary software for Dorothea Rescue Centre.

##  Acknowledgments

Built with care for Dorothea Rescue Centre - "A Heart of Mercy"

---

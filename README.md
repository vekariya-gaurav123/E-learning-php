# Learning - E-Learning Management System 🎓

A comprehensive, professional, and responsive E-Learning platform built with PHP and MySQL. This system provides a seamless experience for students to browse courses, enroll, and manage their learning journey, while offering a robust dashboard for administrators.

## 🚀 Key Features

### 👨‍🎓 For Students
- **Course Discovery**: Browse and search through a dynamic catalog of courses.
- **Secure Enrollment**: Purchase and enroll in courses using Stripe payment integration.
- **Personal Dashboard**: Track progress, view enrolled courses, and manage profiles.
- **Interactive Feedback**: Leave reviews and feedback for courses.
- **Responsive UI**: Fully optimized for mobile and desktop viewing.

### 👨‍💼 For Administrators
- **Course Management**: Add, update, or delete courses and lessons.
- **User Management**: Monitor student activities and feedback.
- **Sales Overview**: Track enrollments and revenue through the admin dashboard.
- **Media Management**: Upload and manage course thumbnails and content.

## 🛠️ Technology Stack
- **Backend**: PHP 7.x/8.x
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 4
- **Payments**: Stripe API Integration
- **Icons**: Font Awesome 6
- **Animations**: Custom JS and CSS transitions

## 📁 Project Structure
```text
├── admin/               # Admin panel logic and pages
├── Student/             # Student dashboard and profile management
├── css/                 # Custom stylesheets
├── js/                  # Interaction logic and sliders
├── mainInclude/         # Common components (Header, Footer)
├── image/               # Project assets and course images
├── dbConnection.php     # MySQL database configuration
├── stripe-config.php    # Stripe API credentials
└── index.php            # Main landing page
```

## 🔧 Installation & Setup
1. **Clone the repository**:
   ```bash
   git clone https://github.com/vekariya-gaurav123/E-learning-php.git
   ```
2. **Database Setup**:
   - Create a database named `lms_db` (or as configured in `dbConnection.php`).
   - Import the provided `lmsdb555.sql` file into your MySQL server.
3. **Configuration**:
   - Update `dbConnection.php` with your database credentials.
   - Configure your Stripe API keys in `stripe-config.php`.
4. **Run the Project**:
   - Move the project folder to your local server directory (e.g., `htdocs` for XAMPP).
   - Access the site at `http://localhost/E-learning-php`.

## 💳 Testing Stripe Payments
You can use the following demo cards for testing the Stripe payment gateway:

| Card Brand | Card Number |
| :--- | :--- |
| **Visa** | `4242 4242 4242 4242` |
| **Mastercard** | `5555 5555 5555 4444` |
| **American Express** | `3782 8224 6310 005` |
| **Discover** | `6011 0009 9013 9424` |
| **JCB** | `3566 0020 2036 0505` |

*Note: Use any future expiry date and any 3-digit CVC.*

## 🤝 Contributing
Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

---
*Developed with ❤️ for educational excellence.*

# Point of Sale
This project is built using Laravel 10 and follows the Agile development methodology. It includes several key features such as user authentication, product and category management, customer management, invoice generation, and reporting.

## Requirements
- **Composer**: For managing PHP dependencies.
- **Database**: MySQL, PostgreSQL, SQLite, or SQL Server. Ensure the corresponding PHP extension is installed.
- **Web Server**: Apache or Nginx.
- **Git**: For version control.

For installation of PHP extensions on Ubuntu/Debian-based systems, use:

## Installation

1. **Clone the Repository:**
```bash
git clone https://github.com/mdabdullajobayer/point_of_sale.git
```
```bash
cd point_of_sale
```
3. **Install Dependencies**
```bash
composer install
```
5. **Set Up Environment Variables** Copy the `.env.example` file to `.env` and update the necessary environment variables.
```bash
cp .env.example .env
```
7. **Run Migrations** Run the following command to set up the database tables:
```bash
php artisan migrate
```
9. **Serve the Application** Start the Laravel development server:
```bash
php artisan serve
```

## Project Dependencies

This project is built using Laravel 10 and includes various dependencies. Here’s a summary of the main components:

- **Laravel Framework**: ^10.0
- **PHP**: ^8.1
- **barryvdh/laravel-dompdf**: ^3.0 (PDF generation)
- **firebase/php-jwt**: ^6.10 (JWT authentication)

For full details, refer to the `composer.json` file located in the project root.


## Routes with Methods and Controller Functions

### Web Routes

| HTTP Method | Route                  | Controller                    | Function            |
|-------------|------------------------|-------------------------------|---------------------|
| GET         | `/`                    | N/A                           | N/A (returns `welcome` view) |
| GET         | `/login`               | `UserController`              | `UserLogin`         |
| GET         | `/register`            | `UserController`              | `UserResgister`     |
| GET         | `/reset-password`      | `UserController`              | `ResetPass`         |
| GET         | `/send-otp`            | `UserController`              | `Sendotp`           |
| GET         | `/verify-otp`          | `UserController`              | `Verifyotp`         |
| GET         | `/dashboard`           | `DashboardController`         | `index`             |
| GET         | `/user-profile`        | `UserController`              | `UserProfileViews`  |
| POST        | `/reset-password`      | `UserController`              | `resetpassword`     |
| GET         | `/products-category`   | `ProductsCategoryController`  | `index`             |
| GET         | `/customers`           | `CustomerController`          | `index`             |
| GET         | `/products`            | `ProductController`           | `ProductsPage`      |
| GET         | `/invoices`            | `InvoiceController`           | `Invioce`           |
| GET         | `/sale-page`           | `InvoiceController`           | `SalePage`          |
| GET         | `/reports`             | `ReportController`            | `ReportView`        |
| GET         | `/reports/{fromdate}/{todate}` | `ReportController`   | `Reports`           |

### API Routes

| HTTP Method | Route                   | Controller                    | Function            |
|-------------|-------------------------|-------------------------------|---------------------|
| POST        | `/register`             | `UserController`              | `register`          |
| POST        | `/login`                | `UserController`              | `login`             |
| GET         | `/logout`               | `UserController`              | `logout`            |
| POST        | `/send-otp`             | `UserController`              | `sentotp`           |
| POST        | `/verify-otp`           | `UserController`              | `otpverify`         |
| GET         | `/summary`              | `DashboardController`         | `summary`           |
| GET         | `/userprofile`          | `UserController`              | `UserProfile`       |
| POST        | `/update-profile`       | `UserController`              | `UdateProfile`      |
| GET         | `/products-category-list`| `ProductsCategoryController`  | `list`              |
| POST        | `/products-category-create` | `ProductsCategoryController` | `create`            |
| POST        | `/products-category-update` | `ProductsCategoryController` | `update`            |
| POST        | `/products-category-delete` | `ProductsCategoryController` | `delete`            |
| POST        | `/category-by-id`       | `ProductsCategoryController`  | `categorybyid`      |
| GET         | `/customers-list`       | `CustomerController`          | `list`              |
| POST        | `/customer-create`      | `CustomerController`          | `create`            |
| POST        | `/customer-update`      | `CustomerController`          | `update`            |
| POST        | `/customer-delete`      | `CustomerController`          | `delete`            |
| POST        | `/customer-by-id`       | `CustomerController`          | `customerbyid`      |
| GET         | `/products-list`        | `ProductController`           | `ProductsList`      |
| POST        | `/products-create`      | `ProductController`           | `ProductCreate`     |
| POST        | `/products-update`      | `ProductController`           | `ProductsUpdate`    |
| POST        | `/products-delete`      | `ProductController`           | `DeleteProduct`     |
| POST        | `/products-by-id`       | `ProductController`           | `ProductsById`      |
| POST        | `/invoice-create`       | `InvoiceController`           | `InvioceCreate`     |
| POST        | `/invoice-select`       | `InvoiceController`           | `InvoiceSelect`     |
| POST        | `/invoice-details`      | `InvoiceController`           | `InvoiceDetails`    |
| POST        | `/invoice-delete`       | `InvoiceController`           | `InvoiceDelete`     |

### Development Process

This project follows the Agile development methodology, focusing on iterative development, continuous feedback, and flexibility in responding to changes. The development process is divided into sprints, each delivering a functional increment of the project.

### Sprint 1: User Authentication
-   Implemented user registration and login functionality.
-   Added JWT-based API authentication using Laravel Sanctum.

#### Sprint 2: Product Category Management
-   Developed CRUD operations for product categories and products.
-   Integrated category selection for products.

#### Sprint 3: Product Management
-   Developed CRUD operations for  products.
-   Integrated Products category selection for products.

#### Sprint 4: Customer Management
-   Created customer profiles with CRUD functionality.

#### Sprint 5: Invoice Generation
-   Developed invoice creation, listing, and detailed views.

#### Sprint 6: Dashboard
-   Developed Dashboard Summary.

#### Sprint 7: Reporting
-   Implemented Developed PDF report generation using `barryvdh/laravel-dompdf`.

### Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.
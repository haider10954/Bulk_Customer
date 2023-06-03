

<h1 align="center">
Bulk Customer Update & Assign Application
</h1>

This application allows the admin to manage customers and assign them to users in bulk. The admin can create, update, and delete users, as well as import customers from an Excel file and assign them to selected users.
I have used Hybrix Template to Design this System

## Features

 Admin User Management:
 - Create new users
 - Update existing user information
 - Delete users from the system.

Customer Management:
- Create customers.
- Assign customers to users.
- Update customer information.

Bulk Customer Import:
- Import customers from an Excel file.
- Assign customers to selected users.
- Distribute customers equally among the selected users.

Excel File Format
To import customers, the Excel file should have the following fields:

- Customer Name
- Email
- Phone

## Bulk Customer Import Process</h3>

1. Admin selects the Excel file containing customer data.
2. Admin selects one or multiple users to assign the customers to.
3. If all users are selected, the selection of other users is disabled.
4. The application reads the customer data from the Excel file.
5. Customers are assigned equally among the selected users based on the selected option.
6. Customer information is saved into the database.

## Installation and Setup

1. Clone the repository.
2. Run composer install to install the necessary dependencies.
3. Configure the database connection in the .env file.
4. Run the database migrations: php artisan migrate.
5. Start the development server: php artisan serve.

## Test Credentials

email : admin@test.com
password: Admin@123

## Loom Video
url: https://www.loom.com/share/64e2ec35d3d044a5ba7bab57a1ba49bc

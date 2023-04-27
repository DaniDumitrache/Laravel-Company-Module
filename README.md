# Company Module (laravel)

This project is a web application written in Laravel that provides an interface for managing a company, including creating and editing employees, employee projects, and company projects.

The project is built on the basis of a RESTful API architecture, which allows integration with other applications or web services. Users can access data and functionalities through a well-defined API, which offers a secure and easy-to-use programming interface.

Through this project, users can perform various operations related to company management, including creating and editing employees, employee projects, and company projects. Also, there are other additional functionalities, such as searching and filtering data or exporting data in standard formats.

The application is built using the Laravel framework, which is one of the most popular and powerful frameworks for developing web applications. In addition, the application also uses other modern technologies, such as Vue.js for the front-end part and MySQL for data storage.

In general, this project offers a complete and scalable solution for managing a company, offering an easy-to-use user interface and a secure and well-defined API for integration with other applications.

## Installation

1. Install the dependencies: `composer install` and `npm install`
2. Copy the .env.example file and rename it as .env: `cp .env.example .env`
3. Generate the security key: `php artisan key:generate`
4. Configure the .env file with the database details
5. Run database migrations: `php artisan migrate`
6. Populate the database with test data: `php artisan db:seed`

## running

- Run the PHP server: `php artisan serve`
- Run the Vite server: `npm run dev`

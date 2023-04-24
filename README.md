# TestTask

## Installation

1. Install the dependencies: `composer install` and `npm install`
2. Copy the .env.example file and rename it as .env: `cp .env.example .env`
3. Generate the security key: `php artisan key:generate`
4. Configure the .env file with the database details
5. Run database migrations: `php artisan migrate`
6. Populate the database with test data: `php artisan db:seed`

## Rolling

- Run the PHP server: `php artisan serve`
- Run the Vite server: `npm run dev`

### Install Laravel on command line, via composer:

1. Run commands:
`
composer create-project laravel/laravel:^10.0 leta
composer require laravel/breeze --dev
php artisan breeze:install
`
2. Pick options:
" Which Breeze stack would you like to install?
  Blade with Alpine ................................................................................................................ blade
"
"
  Which testing framework do you prefer? [PHPUnit]
  PHPUnit .............................................................................................................................. 0
"

3. Create a new database locally, in your DB management system.

4. Configure your .env file to connect with your DB

5. Open your Laravel project folder and run commands:
`
php artisan migrate
php artisan serve
npm install
npm run dev

php artisan migrate
php artisan db:seed
`

## Make sure you have git installed on your computer.
## Open the terminal and navigate to a folder where you want to save this project.
## Run command:
`
git clone https://github.com/solarwind559/Social-Publishing-Platform.git

`
## Navigate to the project directory and run commands:
`
composer install
npm install

`
## Duplicate .env.example file and rename it to .env.
## Create a database locally and edit the .env file to match your local database details
## Run commands:
`
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
`

Follow link from artisan serve to view the page

# Installation guide #

Navigate to your working  http folder  (e.g. xampp/htdocs)

## Clone project
git clone https://github.com/armenstepanyan/laravel-film.git

## Change directory to laravel-film
cd laravel-film

## Install composer dependencies
composer install

## Create environment file
copy .env.example .env  (If you are using Linux,  type **cp**, instead of **copy**)

## Configure your database settings in .env file
DB_DATABASE='Your db name'
DB_USERNAME=root
DB_PASSWORD=

## Set application url in .env
APP_URL=http://localhost:8000/

## Run Migrations in command prompt
php artisan migrate

## Generate key ##
php artisan key:generate

## Run server ##
php artisan serve


Navigate to *http://localhost:8000/* in your browser



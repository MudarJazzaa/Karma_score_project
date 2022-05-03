# install npm dependancies

npm install

# install composer dependancies

composer install

# update database settings in .env file

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# run migration

php artisan migrate

# fill databsae

php artisan db:seed

# run laravel project

php artisan serve

# run vuejs app

npm run watch

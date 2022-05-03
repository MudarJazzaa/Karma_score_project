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

# In this project we use laravel as Backend

# and Vue as Frontend

# there ar 2 option to perform solution

# 01- using Mysql view and Rank function to optimize the solution ( default )

# 02- fetch ids and score, then play with them ( commented code )

# run migration

php artisan migrate

# fill databsae

php artisan db:seed

# run laravel project

php artisan serve

# run vuejs app

npm run watch

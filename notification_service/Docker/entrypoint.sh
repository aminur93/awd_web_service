#!/bin/bash

#if [ ! -f "vendor/autoload.php" ]; then
#    composer install --no-progress --no-interaction --ignore-platform-reqs
#fi

composer install --no-progress --no-interaction --ignore-platform-reqs

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi


# php artisan migrate:fresh
# php artisan db:seed --class=PermissionTableSeeder
# php artisan db:seed --class=UserSeeder
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear
## For the time-being:
##php artisan jwt:secret

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"


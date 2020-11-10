mariadb -u root --execute="DROP DATABASE adminlte";
mariadb -u root --execute="CREATE DATABASE adminlte";
php artisan migrate:refresh --seed;

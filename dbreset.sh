#!/bin/zsh

mariadb -u root --execute="DROP DATABASE emissary";
mariadb -u root --execute="CREATE DATABASE emissary";
php artisan migrate:refresh --seed;

#!/usr/bin/env bash

# Go to the installation folder
cd /var/www/agora/api

echo "### Print dependency versions ###"
echo "php: `php -v`"

# Get the latest version via git
echo "### Getting the latest version via git ###"
git fetch origin
git reset origin/master --hard

# Go to the laravel installation folder
echo "### Going to the laravel installation folder ###"
cd src

# Install Back-end dependencies for laravel
echo "### Installing Back-end dependencies for laravel ###"
composer install

# migrating laravel database
echo "### Migrating laravel database ###"
php artisan migrate

# seeding laravel database
echo "### Seeding laravel database ###"
php artisan db:seed

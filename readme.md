## Getting started

* checkout `master`
* create a file called `.env.local.php` and a file called `.env.testing.php`
* run `composer install` to download all PHP packages to /vendor
* run `bower install` to download all Javascript components to /bower_components
* run `sudo npm install --no-bin-links` to install all nodejs dependencies
* run `gulp` to build all CSS and Javascript files

## Staying up to date

Use `php artisan switch-branch` to update your project. This is mostly needed when you switch to a different branch. This
command performs the following actions:

* run `composer install`, use the `--composer-update` option to perform `composer update`
* run `bower install`
* remove all tables from the database and run `php artisan migrate` and `php artisan db:seed`
* remove all tables from the testing database and run `php artisan migrate --env=testing`

## Cleaning up code

Run `php-cs-fixer fix` to automatically cleanup all code to Symphony standards. All configurations are saved in a file 
called .php_cs and documentation can be found at https://github.com/FriendsOfPHP/PHP-CS-Fixer 
[![Build Status](https://travis-ci.org/barryvanveen/barryvanveen.svg?branch=master)](https://travis-ci
.org/barryvanveen/barryvanveen)

# Barry van Veen
This is the source code of my personal blog, which can be found at [barryvanveen.nl](http://barryvanveen.nl). If you 
are interested, below are some directions that get you (and me) started after cloning this repository.

## Getting started
This code has been developed on [Laravel Homestead](http://laravel.com/docs/5.1/homestead). So I suggest you give that 
a try and then use the following steps to set everything up for further development.

* checkout `master`
* create a file called `.env` and substitute all placeholders with real values 
* run `composer install` to download all PHP packages to /vendor
* run `bower install` to download all CSS and Javascript components to /bower_components
* run `npm install` (in my case on Windows because in the Homestead VM this will cause trouble)
* run `gulp` to build all CSS and Javascript files

## Staying up to date

Use `php artisan switch-branch` to update your project. This is mostly needed when you switch to a different branch. 
This command performs the following actions:

* run `composer install`, use the `--composer-update` option to perform `composer update`
* run `bower install`
* remove all tables from the database and run `php artisan migrate` and `php artisan db:seed`
* remove all tables from the testing database and run `php artisan migrate --env=testing`

## Cleaning up code

Run `php-cs-fixer fix` to automatically cleanup all code to Symphony standards. All configurations are saved in a file 
called .php_cs and documentation can be found at [https://github
.com/FriendsOfPHP/PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer).
 
## Licence
See the [LICENSE](LICENSE.txt) file for license rights and limitations (MIT).
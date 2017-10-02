![GitHub tag](https://img.shields.io/github/tag/barryvanveen/barryvanveen.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/barryvanveen/barryvanveen/master.svg?style=flat-square)](https://travis-ci.org/barryvanveen/barryvanveen)
[![Gemnasium](https://img.shields.io/gemnasium/mathiasbynens/he.svg?style=flat-square)](https://gemnasium.com/github.com/barryvanveen/barryvanveen)
[![StyleCI](https://styleci.io/repos/52092980/shield?branch=master)](https://styleci.io/repos/52092980)
 
# Barry van Veen
This is the source code of my personal blog, which can be found at [barryvanveen.nl](http://barryvanveen.nl). If you 
are interested, below are some directions that get you (and me) started after cloning this repository.

## Getting started
This code has been developed on [Laravel Homestead](http://laravel.com/docs/5.1/homestead). So I suggest you give that 
a try and then use the following steps to set everything up for further development.

* checkout `master`
* create a file called `.env` and substitute all placeholders with real values 
* run `composer install` to download all PHP packages to /vendor
* run `yarn install [--no-bin-links]`
* run `gulp` to build all CSS and Javascript files

## Staying up to date
Use `php artisan switch-branch` to update your project. This is mostly needed when you switch to a different branch. 
This command performs the following actions:

* run `composer install`, use the `--composer-update` option to perform `composer update`
* run `yarn --no-bin-links`
* remove all tables from the database and run `php artisan migrate` and `php artisan db:seed`
* remove all tables from the testing database and run `php artisan migrate --env=testing`

## Compiling assets
Run `gulp` to compile everything once.

## Running tests
Run `vendor/bin/phpunit` to run all tests.

## Cleaning up code
Run `php-cs-fixer fix` to automatically cleanup all code to Symphony standards. All configurations are saved in a file 
called .php_cs and documentation can be found at [https://github
.com/FriendsOfPHP/PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer).
 
## Licence
See the [LICENSE](LICENSE.txt) file for license rights and limitations (MIT).
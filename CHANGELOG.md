# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased][unreleased]
### Added
### Changed
### Deprecated
### Removed
### Fixed

## [2.26.0] - 2018-12-29
### Removed
- Removed the LuckyTV RSS feed
- Removed .htaccess file before switch to nginx server

## [2.25.2] - 2018-07-06
### Fixed
- Code style fixes

## [2.25.1] - 2018-07-06
### Changed
- Re-enabled 'unsafe-inline' and 'unsafe-eval' after problems with blocked content.

## [2.25.0] - 2018-05-18
### Changed
- Removed or changed inline styles and scripts in order to disable 'unsafe-inline' and 'unsafe-eval' in the CSP header.

## [2.24.3] - 2017-10-09
### Changed
- Updated all Composer dependencies
- Updated all Yarn dependencies
### Fixed
- TravisCI should never run "composer update", just install them
- Require PHP >7.0 and <7.1 because of server requirements

## [2.24.2] - 2017-10-03
### Changed
- Updated all Composer dependencies

## [2.24.1] - 2017-10-02
### Fixed
- Fixed tests on TravisCI
- Fixed lowest allowable Composer dependencies

## [2.24.0] - 2017-10-02
### Changed
- Updated all Composer dependencies
- Updated all Yarn dependencies
- Compiled new assets
### Fixed
- Extended readme on compiling assets and running tests

## [2.23.0] - 2017-09-08
### Added
- Added a manifest.json file for PWA features
### Changed
- Updated to Laravel 5.5
- Updated other Composer dependencies where possible
- Travis CI now tests PHP 7.1 and 7.2

## [2.22.0] - 2017-05-13
### Added
- Added BladeServiceProvider for custom Blade directives
- Added custom helpers file in /resources/helpers.php
### Changed
- Update Flysystem's Dropbox adapter, now using Dropbox API v2
- Updated Composer dependencies
### Fixed
- Escape request input to prevent XSS
- Check if a last.fm image exists before displaying it

## [2.21.1] - 2017-03-17
### Changed
- Improved page with last.fm statistics
- Updated Composer dependencies

## [2.21.0] - 2017-03-13
### Added
- Added page with last.fm statistics using [barryvanveen/lastfm](https://github.com/barryvanveen/lastfm)
### Changed
- Updated Composer dependencies

## [2.20.1] - 2017-02-11
### Added
- Add missing critical CSS

## [2.20.0] - 2017-02-11
### Added
- Added yaml and json syntax highlighting to prismjs
### Changed
- Updated to Laravel 5.4
- Updated other composer and npm packages

## [2.19.0] - 2017-01-02
### Added
- Removed bepsvpt/secure-headers 
### Changed
- Updated composer dependencies
- Ran php-cs-fixer after update
### Removed
- Removed bepsvpt/laravel-security-header

## [2.18.0] - 2016-12-17	
### Added
- Added configuration to enable secure session cookies
### Changed
- Changed php-cs-fixer and styleci for ordering use statements alphabetically
- Updated composer dependencies
- Updated npm dependencies
- Added Yarn lock file, removed npm shrinkwrap lock file
- Updated assets

## [2.17.1] - 2016-11-25	
### Changed
- Updated composer dependencies
- Updated npm dependencies
- Changed generating the critical path CSS after update of gulp plugin
### Fixed
- Fixed error on missing dates in LuckyTV RSS feed

## [2.17.0] - 2016-11-25	
### Added
- Added security headers
### Fixed
- Updated composer dependencies
- Fixed 404 errors from critical CSS
### Removed
- Removed PHP 5.6 checks from Travis CI configuration

## [2.16.3] - 2016-11-11
### Fixed
- Updated composer dependencies

## [2.16.2] - 2016-11-01
### Changed
- Defer loading of the Glide server
### Fixed
- Fixed type hinting in GlideServiceProvider
- Updated composer and npm dependencies

## [2.16.1] - 2016-10-23
### Changed
- The hash/fingerprint field is now required for new comments
- Reduced size of h2 headings

## [2.16.0] - 2016-10-23
### Changed
- Updated dependencies
- Added readme badges

## [2.15.0] - 2016-10-17
### Added
- Added a npm shrinkwrap file
### Changed
- Updated composer dependencies
- Migrated dependencies from bower to npm
- Applied autosize javascript functionality to all textareas, instead of only those in the admin section
- Updated npm dependencies
### Removed
- Removed bower.json and bower dependencies after switch to npm

## [2.14.4] - 2016-10-05
### Fixed
- Fixed problem with Google Tag Manager not working on production environment

## [2.14.3] - 2016-10-03
### Fixed
- Fixed conflicting styles of comments and syntax highlighted code

## [2.14.2] - 2016-10-03
### Changed
- Updated Composer dependencies, Bower dependencies and NPM packages
- Recompiled CSS and JS

## [2.14.1] - 2016-09-23
### Added
- Added Travis CI integration 
- Added StyleCI integration

## [2.14.0] - 2016-09-20
### Changed
- Updated laravel/framework to 5.3.9
- Updated various other packages
### Fixed
- Fixed LuckyTV Rss feed to work with new LuckyTV website
- Fixed tests and exception handling after updating dependencies
### Removed
- Removed laravelrus/localized-carbon

## [2.13.1] - 2016-07-26
### Fixed
- Fixed double usage of ValidatesRequests trait

## [2.13.0] - 2016-07-26
### Added
- Added comments to blogs

## [2.12.1] - 2016-07-21
### Fixed
- Fixed problem with unreported exceptions

## [2.12.0] - 2016-07-14
### Added
- Added configuration for LinkedIn and GitHub profile links
### Changed
- Changed internal parameter in BlogPresenter from $resource to $wrappedObject
### Removed
- Removed ExceptionMailer and related configuration
### Fixed
- Fixed problem with validating form input and displaying this to the user

## [2.11.5] - 2016-06-28
### Added
- Added spatie/googletagmanager for managing GTM's DataLayer variables
### Removed
- Removed errorcode in Javascript variables

## [2.11.4] - 2016-06-25
### Removed
- Removed old references to initOutgoingLinkListeners 

## [2.11.3] - 2016-06-25
### Changed
- Updated outdated npm packages
- Updated outdated bower packages
### Removed
- Removed Javascript function to track outbound links, this is now done by Google Tag Manager 

## [2.11.2] - 2016-06-25
### Changed
- Updated eusonlito/laravel-meta for better meta tags
### Fixed
- Prevent duplicate page titles and meta descriptions
- Fixed link to sitemap

## [2.11.1] - 2016-06-16
### Added
- Added character counter for blog description field in admin panel
### Changed
- Changed some translations for page titles and meta descriptions
- Changed heading on homepage
### Fixed
- Fixed HTML that did not pass validation 

## [2.11.0] - 2016-06-14
### Added
- Added HTTP errorcodes to javascript variables available in DOM
- Added integration with Bugsnag for exception tracking
### Removed
- Removed ExceptionMailer usage for tracking exceptions due to Bugsnag integration

## [2.10.3] - 2016-06-13
### Added
- Added Google Tag Manager code and related configuration
### Removed
- Removed Google Analytics code and related configuration
### Fixed
- Fixed missing check for variable existence in header.blade.php

## [2.10.2] - 2016-06-07
### Fixed
- Fixed problem with loading file /dist/js/gameoflife.js

## [2.10.1] - 2016-06-06
### Added
- Added ability to switch between log files in admin panel
- Added gameoflife script
### Changed
- Switched to daily log files

## [2.10.0] - 2016-06-04
### Changed
- Mail is now sent through Mailgun 
### Fixed
- Fixed dates in this changelog, many releases were wrongfully set to 2015 instead of 2016  

## [2.9.8] - 2016-02-23
### Fixed
- Sitemap now displays all published blogposts

## [2.9.7] - 2016-02-19
### Changed
- Changed .gitignore
- Updated bower components
### Fixed
- Fixed multiple codestyle issues
- Fixed environment configuration examples
- Fixed gulpfile

## [2.9.6] - 2016-02-15
### Fixed
- Required symfony/css-selector to fix LuckyTV RSS feed

## [2.9.5] - 2016-02-15
### Fixed
- Required symfony/dom-crawler to fix LuckyTV RSS feed, again

## [2.9.4] - 2016-02-15
### Fixed
- Required symfony/dom-crawler to fix LuckyTV RSS feed
- Fixed last environment configuration using the config()-method

## [2.9.3] - 2016-02-14
### Fixed
- Fixed typo in list of service providers

## [2.9.2] - 2016-02-14
### Changed
- Updated Laravel Framework to version 5.2.15
- Changed environment configuration to only use the config()-method

## [2.9.1] - 2016-02-08
### Changed
- Changed date format blog to English format
- Redirect all traffic to https
### Removed
- Removed datetimepicker Javascript plugin

## [2.9.0] - 2016-02-05
### Added
- Added fallback for loading CSS on browsers without Javascript support
- Added gulp-clean to remove temporary files created by critical
### Changed
- Webfont is now loaded asynchronously 
- Inlined lazyload.js in main template instead of loading it from the AssetComposer
- Updated critical.css

## [2.8.1] - 2016-02-01
### Added
- Added Expire header for favicon
### Fixed
- Fixed opening links with middle-clicks

## [2.8.0] - 2016-01-26
### Added
- Added inlined critical path CSS
### Changed
- Load screen.css after page load using lazyloading
### Fixed
- Fixed public_path() in tests

## [2.7.6] - 2016-01-23
### Changed
- Load jQuery from CDN

## [2.7.5] - 2016-01-23
### Changed
- Changed lazyloading for JS files
- Changed RSS icon and moved it to the footer

## [2.7.4] - 2016-01-22
### Added
- Added cache control headers for fonts
### Changed
- Changed font file names for cache busting

## [2.7.3] - 2016-01-22
### Changed
- Changed lazyloading to run after loading the page

## [2.7.2] - 2016-01-19
### Changed
- Include jQuery in main.js, do not load it from CDN

## [2.7.1] - 2016-01-19
### Fixed
- Fixed position of lazyload.js script 
- Fixed Prism highlighting on blog

## [2.7.0] - 2016-01-19
### Added
- Added lazyloading for JS files
### Changed
- Updated to Bootstrap 3.3.6 and corresponding version of Bootswatch Readable
- Split JS in main.js and admin.js 
### Removed
- Removed image column from blogs table
### Fixed
- Fixed bootstrap-datetimepicker problem with locale

## [2.6.2] - 2016-01-12
### Fixed
- Fixed references to js files in template

## [2.6.1] - 2016-01-12
### Changed
- Minified css with gulp-cssnano instead of gulp-sass
### Fixed
- Fixed htaccess expire and cache-control headers
- Fixed references to js files in AssetComposer

## [2.6.0] - 2016-01-12
### Added
- Added a Bing Webmaster Tools verification file
- Added sourcemaps for css files
- Added AssetComposer to create file hashes for cachebusting
- Added Cache-Control headers for css and js
### Changed
- Exception's email recipient now comes from environment configuration
- Changed translations for page titles
- Minified css files
- Moved all assets (css/js/fonts) to /public_html/dist directory

## [2.5.1] - 2016-01-04
### Fixed
- Fixed htaccess redirects from Dutch to English urls

## [2.5.0] - 2015-12-28
### Added
- Added translations for all static texts
- Added redirects to htaccess for old Dutch urls

### Changed
- Changed the locale of the application to English
- Changed all existing translations to the English language
- Changed urls for /over-mij and /over-mij/boeken-die-ik-gelezen-heb to English
- Updated version of gulp-include 

## [2.4.0] - 2015-12-06
### Added
- Added pagination to the blog

### Changed
- Improved .gitignore file

## [2.3.1] - 2015-11-25
### Added
- Added MIT licence

### Changed
- Images in the LuckyTV RSS feed now link to the video on the LuckyTV website

### Removed
- Removed unused Barryvanveen\Logs\Logger

### Fixed
- Fixed date notation of the last update at the end of a text page

## [2.3.0] - 2015-11-18
### Added
- Added GA parameters to urls in blog rss feed 
- Added functional, integration and unit tests with PHPUnit
- Added php-cs-fixer to dev-dependecies of Composer
 
### Changed
- Updated to Laravel 5.1.11
- Changed example configuration files 
 
### Fixed
- Fixed image in LuckyTV rss feed item description 

## [2.2.2] - 2015-09-19
### Added
- Added Javascript function for tracking clicks on outbound links in Google Analytics
 
### Changed
- Added image to LuckyTV rss feed items
- Rewritten all rss dates to use Carbons RFC-2822 format
 
### Fixed
- Fixed css by adding padding to bottom of admin pages 

## [2.2.1] - 2015-09-07
### Added
- Added schema.org microdata to blog posts
- Added this changelog

### Fixed
- Added glyphicon font files to /public_html/fonts 

## Older versions
This changelog was introduced in version 2.2.1
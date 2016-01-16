# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased][unreleased]
### Added
### Changed
### Deprecated
### Removed
- Removed image column from blogs table
### Fixed
- Fixed bootstrap-datetimepicker problem with lo

## [2.6.2] - 2015-01-12
### Fixed
- Fixed references to js files in template

## [2.6.1] - 2015-01-12
### Changed
- Minified css with gulp-cssnano instead of gulp-sass
### Fixed
- Fixed htaccess expire and cache-control headers
- Fixed references to js files in AssetComposer

## [2.6.0] - 2015-01-12
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

## [2.5.1] - 2015-01-04
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
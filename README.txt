CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Maintainers

INTRODUCTION
------------

The Email Parser module provides an extensible module to parse Airline emails
for data such as Passenger's Name and Record locator. Currently American
Airlines is the provided custom parser.

 * Any module that implements the Airline annotation in their
   src/Plugin/email_parser/Airline folder automatically loads into the list of
   Specifications on the page at /email_parser/extract.

REQUIREMENTS
------------

 * Requires https://github.com/vaibhavpandeyvpz/phemail. This is in our
   composer.json but is not currently on packagist, so manually needed.

INSTALLATION
------------

 * Run `composer require vaibhavpandeyvpz/phemail` to get the required library.

 * Install as you would normally install a contributed Drupal module. Visit
   https://www.drupal.org/documentation/install/modules-themes/modules-7
   for further information.

CONFIGURATION
-------------

 * Visit /email_parser/extract, upload the .EML file in the "Email File" field.

 * Select one of the specifications (plugins); the one provided is American
   Airlines.

 * Click Save, and the parsed details will appear on the page.

MAINTAINERS
-----------

Current maintainers:
 * Steven Linn (stevenlafl) - https://www.drupal.org/user/2236078

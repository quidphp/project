# QuidPHP/Project
[![Release](https://img.shields.io/github/v/release/quidphp/project)](https://packagist.org/packages/quidphp/project)
[![License](https://img.shields.io/github/license/quidphp/project)](https://github.com/quidphp/project/blob/master/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/quidphp/project)](https://www.php.net)
[![Style CI](https://styleci.io/repos/203834987/shield)](https://styleci.io)
[![Code Size](https://img.shields.io/github/languages/code-size/quidphp/project)](https://github.com/quidphp/project)

## About
This repository contains a sample project built on top of the QuidPHP framework. It also offers a script to run the full QuidPHP test suite.

## License
**QuidPHP/Project** is available as an open-source software under the [MIT license](LICENSE).

## Installation
**QuidPHP/Project** can be easily installed with [Composer](https://getcomposer.org). It is available on [Packagist](https://packagist.org/packages/quidphp/project).
``` bash
$ composer create-project quidphp/project
```

Once this is complete, simply follow these steps:
1. Make sure the [storage](storage) and [public](public) folders are writable by your web server (including subdirectories).
2. Configure an Apache Virtual Host in order to have a domain pointing to the [public](public) document root.
3. Import [storage/sql/project.sql.zip](storage/sql/project.sql.zip) within a new Mysql/MariaDB database.
4. Update the scheme hosts and database parameters within the [env.php](env.php) file.
5. Not required, but you are encouraged to change the namespace of all PHP classes within the [private/php](private/php) folder. The default namespace is Project. You will also need to change the namespace of the Boot class within the [public/index.php](public/index.php) entry file.
6. From your web browser, enter the URL to the [public/index.php](public/index.php) entry file.

## Requirement
**QuidPHP/Project** requires the following:
- Apache server with mod_rewrite
- PHP 7.2+ with fileinfo, curl, openssl, posix, PDO and pdo_mysql
- Mysql or MariaDB database

The following PHP INI directives are also required:
- post_max_size must be at least 1MB
- post_max_size must be larger than upload_max_filesize
- memory_limit must be at least 128MB
- browscap needs to contain a valid path 

## Dependency
**QuidPHP/Project** has the following dependencies:
- [quidphp/base](https://github.com/quidphp/base) - Quid\Base - PHP library that provides a large set of low-level static methods
- [quidphp/main](https://github.com/quidphp/main) | Quid\Main - PHP library that provides a set of base objects and collections 
- [quidphp/orm](https://github.com/quidphp/orm) | Quid\Orm - PHP library that provides database access and a comprehensive Object-Relational Mapper
- [quidphp/routing](https://github.com/quidphp/routing) | Quid\Routing - PHP library that provides a simple route matching and triggering procedure
- [quidphp/core](https://github.com/quidphp/core) | PHP library that provides an extendable platform to create dynamic applications
- [verot/class.upload.php](https://github.com/verot/class.upload.php) | Verot\Upload - A popular PHP class used for resizing images
- [phpmailer/phpmailer](https://github.com/phpmailer/phpmailer) | PHPMailer\PHPMailer - The classic email sending library for PHP
- [tedivm/jshrink](https://github.com/tedious/JShrink) | JShrink - Javascript Minifier built in PHP
- [scssphp/scssphp](https://github.com/scssphp/scssphp) | ScssPhp\ScssPhp - SCSS compiler written in PHP

All dependencies will be resolved by using the [Composer](https://getcomposer.org) installation process.

## Overview
**QuidPHP/Project** contains 19 files. Here is an overview:
- [env.php](env.php) | Declare environment data for the application
- [private/js/app/app.js](private/js/app/app.js) | Main javaScript file for the app
- [private/php/Boot.php](private/php/Boot.php) | Class for booting the application
- [private/php/Session.php](private/php/Session.php) | Class for managing the session
- [private/php/App/Error.php](private/php/App/Error.php) | Class for the error route of the app
- [private/php/App/Home.php](private/php/App/Home.php) | Class for the home route of the app
- [private/php/App/Robots.php](private/php/App/Robots.php) | Class for the robots.txt route of the app
- [private/php/App/Sitemap.php](private/php/App/Sitemap.php) | Class for the automated sitemap.xml route of the app
- [private/php/Row/User.php](private/php/Row/User.php) | Class for a row of the user table
- [private/scss/app/app.scss](private/scss/app/app.scss) | Main scss stylesheet for the app
- [private/scss/app/include.scss](private/scss/app/include.scss) | Scss stylesheet for declaring variables and mixins
- [private/scss/app/style.scss](private/scss/app/style.scss) | Scss stylesheet for basic styles
- [public/.htaccess](public/.htaccess) | Simple apache directive file, requires mod_rewrite
- [public/favicon.ico](public/favicon.ico) | Generic favicon (16x16)
- [public/index.php](public/index.php) | Index file for booting the application
- [public/testsuite.php](public/testsuite.php) | File for booting the QuidPHP testsuite
- [storage/sql/project.sql.zip](storage/sql/project.sql.zip) | Minimal database structure required
- [storage/sql/test.sql.zip](storage/sql/test.sql.zip) | Sql database required for the QuidPHP testsuite
- [testsuite/Boot.php](testsuite/Boot.php) | class for booting the testsuite

## Test suite
The QuidPHP test suite contains about 14000 assertions which can thoroughly test a setup. In order to run the test suite, follow the Installation steps and then do the following:
1. Import [storage/sql/test.sql.zip](storage/sql/test.sql.zip) within a new Mysql/MariaDB database.
2. Copy your database connection parameters in [testsuite/Boot.php](testsuite/Boot.php).
3. Adjust the scheme host environment data within the [public/testsuite.php](public/testsuite.php) entry file.
4. From your web browser, enter the URL to the [public/testsuite.php](public/testsuite.php) entry file.
5. Please delete the test suite files once the run has been successful.
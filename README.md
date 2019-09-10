# QuidPHP/Project
[![Release](https://img.shields.io/github/v/release/quidsrc/project)](https://packagist.org/packages/quidsrc/project)
[![License](https://img.shields.io/github/license/quidsrc/project)](https://github.com/quidsrc/project/blob/master/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/quidsrc/project)](https://www.php.net)
[![Style CI](https://styleci.io/repos/203834987/shield)](https://styleci.io)
[![Code Size](https://img.shields.io/github/languages/code-size/quidsrc/project)](https://github.com/quidsrc/project)

## About
This repository contains a sample project built on top of the QuidPHP framework. It also offers a script to run the full QuidPHP test suite.

## License
**QuidPHP/Project** is available as an open-source software under the [MIT license](LICENSE).

## Installation
**QuidPHP/Project** can be easily installed with [Composer](https://getcomposer.org). It is available on [Packagist](https://packagist.org/packages/quidsrc/project).
``` bash
$ composer create-project quidsrc/project
```

Once this is complete, simply follow these steps:
1. Make sure the [storage](storage) and [public](public) folders are writable by your web server (including subdirectories).
2. Configure an Apache Virtual Host in order to have a domain pointing to the [public](public) document root.
3. Import [storage/sql/project.sql.zip](storage/sql/project.sql.zip) within a new Mysql/MariaDB database.
4. Update the scheme hosts and database parameters within the [env.php](env.php) file.
5. Not required, but you are encouraged to change the namespace of all PHP classes within the [src](src) folder. The default namespace is Project. If you do, you will also need to change the namespace of the Boot class within the [public/index.php](public/index.php) entry file.
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
- [quidsrc/base](https://github.com/quidsrc/base) - Quid\Base - PHP library that provides a large set of low-level static methods
- [quidsrc/main](https://github.com/quidsrc/main) | Quid\Main - PHP library that provides a set of base objects and collections 
- [quidsrc/orm](https://github.com/quidsrc/orm) | Quid\Orm - PHP library that provides database access and a comprehensive Object-Relational Mapper
- [quidsrc/routing](https://github.com/quidsrc/routing) | Quid\Routing - PHP library that provides a simple route matching and triggering procedure
- [quidsrc/core](https://github.com/quidsrc/core) | PHP library that provides an extendable platform to create dynamic applications
- [verot/class.upload.php](https://github.com/verot/class.upload.php) | Verot\Upload - A popular PHP class used for resizing images
- [phpmailer/phpmailer](https://github.com/phpmailer/phpmailer) | PHPMailer\PHPMailer - The classic email sending library for PHP
- [tedivm/jshrink](https://github.com/tedious/JShrink) | JShrink - Javascript Minifier built in PHP
- [scsssrc/scssphp](https://github.com/scsssrc/scssphp) | ScssPhp\ScssPhp - SCSS compiler written in PHP

All dependencies will be resolved by using the [Composer](https://getcomposer.org) installation process.

## Overview
**QuidPHP/Project** contains 19 files. Here is an overview:
- [env.php](env.php) | Declare environment data for the application
- [testsuite.php](testsuite.php) | class for booting the testsuite (can be deleted)
- [js/app/app.js](js/app/app.js) | Main javaScript file for the app
- [public/.htaccess](public/.htaccess) | Simple apache directive file, requires mod_rewrite
- [public/favicon.ico](public/favicon.ico) | Generic favicon (16x16)
- [public/index.php](public/index.php) | Index file for booting the application
- [public/testsuite.php](public/testsuite.php) | File for booting the QuidPHP testsuite (can be deleted)
- [scss/app/app.scss](scss/app/app.scss) | Main scss stylesheet for the app
- [scss/app/include.scss](scss/app/include.scss) | Scss stylesheet for declaring variables and mixins
- [scss/app/style.scss](scss/app/style.scss) | Scss stylesheet for basic styles
- [src/Boot.php](src/Boot.php) | Class for booting the application
- [src/Session.php](src/Session.php) | Class for managing the session
- [src/App/Error.php](src/App/Error.php) | Class for the error route of the app
- [src/App/Home.php](src/App/Home.php) | Class for the home route of the app
- [src/App/Robots.php](src/App/Robots.php) | Class for the robots.txt route of the app
- [src/App/Sitemap.php](src/App/Sitemap.php) | Class for the automated sitemap.xml route of the app
- [src/Row/User.php](src/Row/User.php) | Class for a row of the user table
- [storage/sql/project.sql.zip](storage/sql/project.sql.zip) | Minimal database structure required
- [storage/sql/test.sql.zip](storage/sql/test.sql.zip) | Sql database required for the QuidPHP testsuite (can be deleted)

## Test suite
The QuidPHP test suite contains about 14000 assertions which can thoroughly test a setup. In order to run the test suite, follow the Installation steps and then do the following:
1. Import [storage/sql/test.sql.zip](storage/sql/test.sql.zip) within a new Mysql/MariaDB database.
2. Update the scheme hosts and database parameters within the [env.php](env.php) file. Note that will now be booting assert, not app.
3. From your web browser, enter the URL to the [public/testsuite.php](public/testsuite.php) entry file.
4. Please delete the test suite files once the run has been successful.

### Known issue
- On some setup, you will need to add your domain to the system hosts file. This is due with assertions involving the curl library.
# QuidPHP/Project
[![Release](https://img.shields.io/github/v/release/quidphp/project)](https://packagist.org/packages/quidphp/project)
[![License](https://img.shields.io/github/license/quidphp/project)](https://github.com/quidphp/project/blob/master/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/quidphp/project)](https://www.php.net)
[![Style CI](https://styleci.io/repos/203834987/shield)](https://styleci.io)
[![Code Size](https://img.shields.io/github/languages/code-size/quidphp/project)](https://github.com/quidphp/project)

## About
LOREM IPSUM

## License
**QuidPHP/Project** is available as an open-source software under the [MIT license](LICENSE).

## Installation
**QuidPHP/Project** can be easily installed with [Composer](https://getcomposer.org). It is available on [Packagist](https://packagist.org/packages/quidphp/project).
``` bash
$ composer create-project quidphp/project
```

## Requirement
**QuidPHP/Project** requires the following:
- Apache with mod_rewrite
- PHP 7.2+ with fileinfo, curl, openssl, posix, PDO and pdo_mysql
- Mysql or MariaDB database

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
- [private/sql/project.sql.zip](private/sql/project.sql.zip) | Minimal database structure required
- [public/.htaccess](public/.htaccess) | Simple apache directive file, requires mod_rewrite
- [public/favicon.ico](public/favicon.ico) | Generic favicon (16x16)
- [public/index.php](public/index.php) | Index file for booting the application
- [public/testsuite.php](public/testsuite.php) | File for booting the quidPHP testsuite
- [testsuite/Boot.php](testsuite/Boot.php) | Class for booting the quidPHP testsuite
- [testsuite/test.sql.zip](testsuite/test.sql.zip) | Sql database required for the quidPHP testsuite

## Test suite
- TODO

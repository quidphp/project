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

## Documentation
**QuidPHP/Project** documentation is being written. Once ready, it will be available at https://quidphp.github.io/project.

## Installation
**QuidPHP/Project** can be easily installed with [Composer](https://getcomposer.org). It is available on [Packagist](https://packagist.org/packages/quidphp/project).
``` bash
$ composer create-project quidphp/project --prefer-dist
```
On the prompt *Do you want to remove the existing VCS (.git, .svn..) history?*, enter Y.

Once this is complete, simply follow these steps:
1. Make sure the [storage](storage) and [public](public) folders are writable by your web server. For [storage](storage) also make sure all subdirectories are writable.
2. Configure an Apache Virtual Host in order to have a domain pointing to the [public](public) document root.
3. Import [sql/project.sql.zip](sql/project.sql.zip) within a new Mysql/MariaDB database.
4. Update the scheme hosts and database parameters within the [env.php](env.php) file.
5. Not required, but you are encouraged to change the namespace of all PHP classes within the [src](src) folder. The default namespace is Project. If you do, you will also need to change the namespace of the Boot class within the [public/index.php](public/index.php) entry file.
6. From your web browser, enter the URL to the [public/index.php](public/index.php) entry file.

## Requirement
**QuidPHP/Project** requires the following:
- PHP 7.3+ with these extensions:
    - curl
    - date
    - fileinfo
    - gd
    - iconv
    - json
    - mbstring
    - pcre
    - PDO
    - pdo_mysql
    - openssl
    - session
    - SimpleXML
    - Zend OPcache
    - zip
- The following PHP INI directives are also required:
    - *post_max_size* must be at least 1MB
    - *post_max_size* must be larger than *upload_max_filesize*
    - *memory_limit* must be at least 128MB
    - *browscap* needs to contain a valid path 
- Mysql or MariaDB database
- Apache or Nginx server
- Compatible with MacOs, Windows and Linux
    
## Dependency
**QuidPHP/Project** has the following dependencies:
- [quidphp/base](https://github.com/quidphp/base) - Quid\Base - PHP library that provides a set of low-level static methods
- [quidphp/main](https://github.com/quidphp/main) | Quid\Main - PHP library that provides a set of base objects and collections 
- [quidphp/orm](https://github.com/quidphp/orm) | Quid\Orm - PHP library that provides database access and a comprehensive Object-Relational Mapper
- [quidphp/routing](https://github.com/quidphp/routing) | Quid\Routing - PHP library that provides a simple route matching and triggering procedure
- [quidphp/core](https://github.com/quidphp/core) | PHP library that provides an extendable platform to create dynamic applications
- [verot/class.upload.php](https://github.com/verot/class.upload.php) | Verot\Upload - A popular PHP class used for resizing images
- [phpmailer/phpmailer](https://github.com/phpmailer/phpmailer) | PHPMailer\PHPMailer - The classic email sending library for PHP
- [tedivm/jshrink](https://github.com/tedious/JShrink) | JShrink - Javascript Minifier built in PHP
- [scsssrc/scssphp](https://github.com/scsssrc/scssphp) | ScssPhp\ScssPhp - SCSS compiler written in PHP

All dependencies will be resolved by using the [Composer](https://getcomposer.org) installation process.

## Overview
**QuidPHP/Project** contains 20 files. Here is an overview:
- [env.php](env.php) | Declare environment data for the application
- [test.php](test.php) | class for booting the testsuite (can be deleted)
- [docs/index.md](docs/index.md) | Contains the documentation in markdown format (work in progress)
- [js/app/app.js](js/app/app.js) | Main javaScript file for the app
- [public/.htaccess](public/.htaccess) | Simple apache directive file, requires mod_rewrite
- [public/favicon.ico](public/favicon.ico) | Generic favicon (16x16)
- [public/index.php](public/index.php) | Index file for booting the application
- [public/test.php](public/test.php) | File for booting the QuidPHP testsuite (can be deleted)
- [scss/app/app.scss](scss/app/app.scss) | Main scss stylesheet for the app
- [scss/app/include.scss](scss/app/include.scss) | Scss stylesheet for declaring variables and mixins
- [scss/app/style.scss](scss/app/style.scss) | Scss stylesheet for basic styles
- [sql/project.sql.zip](sql/project.sql.zip) | Minimal database structure required
- [sql/test.sql.zip](sql/test.sql.zip) | Sql database required for the QuidPHP testsuite (can be deleted)
- [src/Boot.php](src/Boot.php) | Class for booting the application
- [src/Session.php](src/Session.php) | Class for managing the session
- [src/App/Error.php](src/App/Error.php) | Class for the error route of the app
- [src/App/Home.php](src/App/Home.php) | Class for the home route of the app
- [src/App/Robots.php](src/App/Robots.php) | Class for the robots.txt route of the app
- [src/App/Sitemap.php](src/App/Sitemap.php) | Class for the automated sitemap.xml route of the app
- [src/Row/User.php](src/Row/User.php) | Class for a row of the user table
- [storage/public/media/lemur.jpg](storage/public/media/lemur.jpg) | Lemur photo took in Madagascar, this will be symlinked to *public/media/lemur.jpg*.

## Test suite
**QuidPHP/Project** test suite contains about 14000 assertions which can thoroughly test your setup. In order to run the test suite, follow the Installation steps and then do the following:
1. Import [sql/test.sql.zip](sql/test.sql.zip) within a new Mysql/MariaDB database.
2. Update the scheme hosts and database parameters within the [env.php](env.php) file. Note that will now be booting assert, not app.
3. From your web browser, enter the URL to the [public/test.php](public/test.php) entry file.
4. Please delete the test suite files once the run has been successful.

### Known issue
- On some setup, you may need to add your domain to the system hosts file. If not, some assertions involving curl may fail.
- On Windows, you will need to add *lower_case_table_names* = 2 in your database configuration file (my.cnf). The table and column names need to be stored in their natural case.
# QuidPHP/Project
[![Release](https://img.shields.io/github/v/release/quidphp/project)](https://packagist.org/packages/quidphp/project)
[![License](https://img.shields.io/github/license/quidphp/project)](https://github.com/quidphp/project/blob/master/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/quidphp/project)](https://www.php.net)
[![Style CI](https://styleci.io/repos/203834987/shield)](https://styleci.io)
[![Code Size](https://img.shields.io/github/languages/code-size/quidphp/project)](https://github.com/quidphp/project)

## About
This repository contains a sample application project built on top of the QuidPHP frameword. This application is using LemurCms for content management. It also offers a way to run the full QuidPHP test suite.

## License
**QuidPHP/Project** is available as an open-source software under the [MIT license](LICENSE).

## Documentation
**QuidPHP/Project** documentation is being written. Once ready, it will be available at https://quidphp.github.io/project.

## Installation
**QuidPHP/Project** can be easily installed with [Composer](https://getcomposer.org). It is available on [Packagist](https://packagist.org/packages/quidphp/project).
``` bash
$ composer create-project quidphp/project --prefer-dist
```

Once this is complete, simply follow these steps:
1. Make sure the [storage](storage) and [public](public) folders are writable by your web server. For [storage](storage) also make sure all subdirectories are writable.
2. Configure an Apache Virtual Host or Nginx Server Block in order to have a domain pointing to the [public](public) folder document root.
3. Import [sql/project.sql.zip](sql/project.sql.zip) within a new Mysql/MariaDB database.
4. Duplicate the [env-default.php](env-default.php) file and rename it to **env.php**.
5. Update the scheme hosts within the **env.php** file. You will need to set a different host (domain or subdomain) for the application and the CMS.
6. Update the database parameters within the **env.php** file.
7. Not required, but you are encouraged to change the namespace of all PHP classes within the [src](src) folder. The default namespace is Project.

## Booting
There are two ways to boot the application or CMS.

### HTTP
From your web browser, enter the URL to the [public/index.php](public/index.php) entry file. The host used will determine if the application or CMS is used.

### CLI
Open the project folder in the application. The entry should be in the following format: **php quid [path][:envType]**. If the *envType* is not specified, the system will use the *cliEnvType* value within the **env.php** file. Exemple:
``` bash
$ php quid /fr/my-url
$ php quid /:dev/cms
$ php quid /:dev/assert
```

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
    - openssl
    - session
    - SimpleXML
    - Zend OPcache
    - zip
    - PDO
    - pdo_mysql
- The following PHP INI directives are also required:
    - *post_max_size* must be at least 1MB
    - *post_max_size* must be larger than *upload_max_filesize*
    - *memory_limit* must be at least 128MB
    - *browscap* needs to contain a valid path 
- Mysql or MariaDB database
- Apache or Nginx server
- Compatible with MacOs, Windows and Linux
- Minimal browser: Internet Explorer 11
    
## Dependency
**QuidPHP/Project** has the following dependencies:
- [quidphp/base](https://github.com/quidphp/base) - Quid\Base - PHP library that provides a set of low-level static methods
- [quidphp/main](https://github.com/quidphp/main) - Quid\Main - PHP library that provides a set of base objects and collections 
- [quidphp/orm](https://github.com/quidphp/orm) - Quid\Orm - PHP library that provides database access and a comprehensive Object-Relational Mapper
- [quidphp/routing](https://github.com/quidphp/routing) - Quid\Routing - PHP library that provides a simple route matching and triggering procedure
- [quidphp/core](https://github.com/quidphp/core) - Quid\Core - PHP library that provides an extendable platform to create dynamic applications
- [quidphp/front](https://github.com/quidphp/front) - Quid\Front - Lemur JavaScript library and Scss base stylesheets.
- [quidphp/lemur](https://github.com/quidphp/lemur) - Quid\Lemur - LemurCMS, a content management system built on top of the QuidPHP framework
- [verot/class.upload.php](https://github.com/verot/class.upload.php) - Verot\Upload - A popular PHP class used for resizing images
- [phpmailer/phpmailer](https://github.com/phpmailer/phpmailer) - PHPMailer\PHPMailer - The classic email sending library for PHP
- [tedivm/jshrink](https://github.com/tedious/JShrink) - JShrink - Javascript Minifier built in PHP
- [scssphp/scssphp](https://github.com/scssphp/scssphp) - ScssPhp\ScssPhp - SCSS compiler written in PHP

All dependencies will be resolved by using the [Composer](https://getcomposer.org) installation process.

## Overview
**QuidPHP/Project** contains 24 files. Here is an overview:
- [.gitignore](.gitignore) - Standard .gitignore file for the project
- [composer.json](composer.json) - File declaring all Composer PHP dependencies
- [env-default.php](env-default.php) - Declare environment data for the application, copy this file and rename to env.php
- [LICENSE](LICENSE) - MIT License file for the repository
- [quid.php](quid.php) - File for booting the application and Cms via CLI
- [README.md](README.md) - This readme file in markdown format
- [css/app/_include.scss](scss/app/_include.scss) - Scss stylesheet for declaring variables and mixins
- [css/app/app.scss](scss/app/app.scss) - Main scss stylesheet for the app
- [docs/index.md](docs/index.md) - Contains the documentation in markdown format (work in progress)
- [js/app/app.js](js/app/app.js) - Main JavaScript file for the app
- [public/.htaccess](public/.htaccess) - Simple apache directive file, requires mod_rewrite
- [public/index.php](public/index.php) - Index file for booting the application and Cms via an HTTP request
- [sql/project.sql.zip](sql/project.sql.zip) - Minimal database structure required
- [sql/test.sql.zip](sql/test.sql.zip) - Sql database required for the QuidPHP testsuite (can be deleted)
- [src/Boot.php](src/Boot.php) - Class for booting the application and CMS
- [src/Route.php](src/Route.php) - Abstract class for a route, all routes will extend this class
- [src/Row.php](src/Row.php) - Abstract class for a row, all rows will extend this class
- [src/Session.php](src/Session.php) - Class for managing the session
- [src/App/Error.php](src/App/Error.php) - Class for the error route of the app
- [src/App/Home.php](src/App/Home.php) - Class for the home route of the app
- [src/App/Robots.php](src/App/Robots.php) - Class for the robots.txt route of the app
- [src/App/Sitemap.php](src/App/Sitemap.php) - Class for the automated sitemap.xml route of the app
- [src/Row/User.php](src/Row/User.php) - Class for a row of the user table
- [storage/public/favicon.ico](storage/public/media/lemur.jpg) - Generic favicon (16x16), this will be symlinked to *public/favicon.ico*.

## Test suite
**QuidPHP/Project** test suite contains about 15000 assertions which can thoroughly test your setup. In order to run the test suite, follow the Installation steps and then do the following:
1. Import [sql/test.sql.zip](sql/test.sql.zip) within a new Mysql/MariaDB database.
2. Update the database parameters within the **env.php** file (look at @assert).
3. Update the scheme hosts within the **env.php** file (dev/assert or prod/assert).
4. From your web browser, enter the URL to the [public/test.php](public/test.php) entry file.

### Known issues
- On some setup, you may need to add your domain to the system hosts file. If not, some assertions involving curl may fail.
- On Windows, you will need to add *lower_case_table_names* = 2 in your database configuration file (my.cnf). The table and column names need to be stored in their natural case.
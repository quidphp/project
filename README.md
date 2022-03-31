# QuidPHP/Project
[![Release](https://img.shields.io/github/v/release/quidphp/project)](https://packagist.org/packages/quidphp/project)
[![License](https://img.shields.io/github/license/quidphp/project)](https://github.com/quidphp/project/blob/master/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/quidphp/project)](https://www.php.net)
[![Style CI](https://styleci.io/repos/203834987/shield)](https://styleci.io)
[![Code Size](https://img.shields.io/github/languages/code-size/quidphp/project)](https://github.com/quidphp/project)

## About
**QuidPHP/Project** repository contains a sample application project built on top of the QuidPHP frameword. This application is using LemurCms for content management.

## License
**QuidPHP/Project** is available as an open-source software under the [MIT license](LICENSE).

## Documentation
**QuidPHP/Project** documentation is being written. Once ready, it will be available at [QuidPHP/Docs](https://github.com/quidphp/docs).

## Installation
**QuidPHP/Project** can be easily installed with [Composer](https://getcomposer.org). It is available on [Packagist](https://packagist.org/packages/quidphp/project).
``` bash
$ composer create-project quidphp/project --prefer-dist
```

## Requirement
**QuidPHP/Project** requires the following:
- PHP 7.4, 8.0 or 8.1 with these extensions:
    - ctype
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
    - zip
    - PDO
    - pdo_mysql
- The following PHP INI directives are also required:
    - *post_max_size* must be at least 1MB
    - *post_max_size* must be larger than *upload_max_filesize*
    - *memory_limit* must be at least 128MB
- Mysql (>= 8.0) or MariaDB (>= 10.5) database
- Apache or Nginx server
    - Running on MacOs, Windows or Linux
- Minimal browser: Internet Explorer 11
    
## Dependency
**QuidPHP/Project** has the following dependencies:
- [quidphp/base](https://github.com/quidphp/base) - Quid\Base - PHP library that provides a set of low-level static methods
- [quidphp/main](https://github.com/quidphp/main) - Quid\Main - PHP library that provides a set of base objects and collections 
- [quidphp/orm](https://github.com/quidphp/orm) - Quid\Orm - PHP library that provides database access and a comprehensive ORM
- [quidphp/routing](https://github.com/quidphp/routing) - Quid\Routing - PHP library that provides a route matching and triggering procedure
- [quidphp/core](https://github.com/quidphp/core) - Quid\Core - PHP library that provides an extendable platform to create dynamic applications
- [quidphp/front](https://github.com/quidphp/front) - Quid\Front - QuidPHP JavaScript and CSS front-end assets
- [quidphp/lemur](https://github.com/quidphp/lemur) - Quid\Lemur - LemurCMS, a content management system built on top of the QuidPHP framework
- [verot/class.upload.php](https://github.com/verot/class.upload.php) - Verot\Upload - A popular PHP class used for resizing images
- [phpmailer/phpmailer](https://github.com/phpmailer/phpmailer) - PHPMailer\PHPMailer - The classic email sending library for PHP
- [tedivm/jshrink](https://github.com/tedious/JShrink) - JShrink - Javascript Minifier built in PHP
- [scssphp/scssphp](https://github.com/scssphp/scssphp) - ScssPhp\ScssPhp - SCSS compiler written in PHP
- [tinymce/tinymce](https://github.com/tinymce/tinymce) - Tinymce - The world's #1 JavaScript library for rich text editing

All dependencies will be resolved by using the [Composer](https://getcomposer.org) installation process.

## Setup
Once the installation is complete, simply follow these steps:
1. Make sure the [storage](storage) and [public](public) folders are writable by your web server. For [storage](storage) also make sure all subdirectories are writable.
2. Configure an Apache Virtual Host or Nginx Server Block in order to have a domain pointing to the [public](public) folder document root.
3. Import [db.sql](db.sql) within a new Mysql/MariaDB database.
4. Duplicate the [env-default.php](env-default.php) file and rename it to **env.php**.
5. Update the scheme hosts within the **env.php** file. You will need to set a different host (domain or subdomain) for the application and the CMS.
6. Update the database parameters within the **env.php** file.
7. Not required, but you are encouraged to change the namespace of all PHP classes within the [src](src) folder. The default namespace is Project.

## Booting
There are two ways to boot the application or CMS.

### HTTP
From your web browser, enter the URL to the [public/index.php](public/index.php) entry file. The host used will determine if the application or CMS is booted.

### CLI
Open the project folder in the Command Line. Then submit a command that should be in the following format: **php quid [path][:envType]**.

The *envType* determines if the application or CMS needs to be booted (and also in which environment). If the *envType* is not specified, the system will fallback to the *cliEnvType* value within the **env.php** file. Exemple:
``` bash
$ php quid /en/my-url
$ php quid /en/my-url:dev/cms
$ php quid /:dev/assert
```

## Credentials
Once you open the CMS within your browser, you will need to login. The default user:
- Username: **admin** 
- Password: **changeme123**

Once you are logged in, you will be able to change the password for the user and create new users.

## Overview
**QuidPHP/Project** contains 19 files. Here is an overview:
- [.gitignore](.gitignore) - Standard .gitignore file for the project
- [composer.json](composer.json) - File declaring all Composer PHP dependencies
- [env-default.php](env-default.php) - Declare environment data for the application, copy this file and rename to env.php
- [LICENSE](LICENSE) - MIT License file for the repository
- [quid](quid) - File for booting the application and Cms via CLI
- [README.md](README.md) - This readme file in markdown format
- [db.sql](db.sql) - Minimal database structure required
- [storage/public/favicon.ico](storage/public/media/lemur.jpg) - Generic favicon (16x16), this will be symlinked to *public/favicon.ico*.
- [css/app/_include.scss](scss/app/_include.scss) - Scss stylesheet for declaring variables and mixins
- [css/app/app.scss](scss/app/app.scss) - Main scss stylesheet for the app
- [js/app/app.js](js/app/app.js) - Main JavaScript file for the app
- [public/.htaccess](public/.htaccess) - Simple apache directive file, requires mod_rewrite
- [public/index.php](public/index.php) - Index file for booting the application and Cms via an HTTP request
- [src/Boot.php](src/Boot.php) - Class for booting the application and CMS
- [src/Route.php](src/Route.php) - Abstract class for a route, all routes will extend this class
- [src/Row.php](src/Row.php) - Abstract class for a row, all rows will extend this class
- [src/App/Error.php](src/App/Error.php) - Class for the error route of the app
- [src/App/Home.php](src/App/Home.php) - Class for the home route of the app
- [src/Row/User.php](src/Row/User.php) - Class for a row of the user table

## Testing
**QuidPHP** testsuite can be run by creating a new [QuidPHP/Assert](https://github.com/quidphp/assert) project.
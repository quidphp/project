<?php
declare(strict_types=1);
// declare environment data for the application, copy this file and rename to env.php

return [
    'cliEnvType'=>'dev/app',

    'schemeHost'=>[
        'dev/app'=>'http://project.test',
        'prod/app'=>'https://project.com',
        'dev/cms'=>'http://cms.project.test',
        'prod/cms'=>'https://cms.project.com',
        'dev/assert'=>'http://assert-project.test',
        'prod/assert'=>'https://assert-project.com',
    ],

    'path'=>[
        'public'=>__DIR__.'/public',
        'src'=>__DIR__.'/src',
        'js'=>__DIR__.'/js',
        'css'=>__DIR__.'/css',
        'storage'=>__DIR__.'/storage',
        'vendor'=>__DIR__.'/vendor',
        'boot'=>__DIR__.'/src/Boot.php'
    ],

    '@dev'=>[
        'db'=>['mysql:host=localhost;port=3306;dbname=project','root','']],

    '@prod'=>[
        'db'=>['mysql:host=localhost;port=3306;dbname=project','','']],

    '@assert'=>[
        'db'=>['mysql:host=localhost;port=3306;dbname=projectTest','root','']]
];
?>
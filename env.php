<?php
declare(strict_types=1);
// declare environment data for the application

return [
    'schemeHost'=>[
        'dev/app'=>'http://project.dev',
        'prod/app'=>'https://project.com'
    ],

    'path'=>[
        'private'=>__DIR__.'/private',
        'storage'=>__DIR__.'/storage',
        'vendor'=>__DIR__.'/vendor'
    ],

    '@dev'=>[
        'db'=>['mysql:host=localhost;dbname=project','','']],

    '@prod'=>[
        'db'=>['mysql:host=localhost;dbname=project','','']]
];
?>
<?php
declare(strict_types=1);
// declare environment data for the application

return [
    'schemeHost'=>[
        'dev/app'=>'http://project.dev',
        'prod/app'=>'https://project.com'
    ],

    'path'=>[
        'src'=>__DIR__.'/src',
        'js'=>__DIR__.'/js',
        'scss'=>__DIR__.'/scss',
        'storage'=>__DIR__.'/storage',
        'vendor'=>__DIR__.'/vendor'
    ],

    '@dev'=>[
        'db'=>['mysql:host=localhost;dbname=project','','']],

    '@prod'=>[
        'db'=>['mysql:host=localhost;dbname=project','','']],
    
    '@assert'=>[
        'db'=>['mysql:host=localhost;dbname=testsuite','','']]
];
?>
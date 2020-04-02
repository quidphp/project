<?php
declare(strict_types=1);

(function(?string $scheme,?string $host,?string $uri):void {
    http_response_code(500);

    if(!empty($scheme) && !empty($host) && !empty($uri))
    {
        $config = require dirname(__DIR__).'/env.php';
        $schemeHost = $scheme.'://'.$host;
        $envType = array_search($schemeHost,$config['schemeHost'],true);
    }

    if(!empty($envType))
    $env = explode('/',$envType)[0] ?? null;

    if(!empty($env))
    {
        $vendor = $config['@'.$env]['path']['vendor'] ?? $config['path']['vendor'] ?? null;
        $boot = $config['@'.$env]['path']['boot'] ?? $config['path']['boot'] ?? null;
    }

    if(!empty($vendor) && !empty($boot))
    {
        require_once $vendor.'/autoload.php';
        (require $boot)($config);
    }

    return;
})($_SERVER['REQUEST_SCHEME'],$_SERVER['SERVER_NAME'],$_SERVER['REQUEST_URI']);
?>
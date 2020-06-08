<?php
declare(strict_types=1);
// index file for booting the application and Cms via an HTTP request

(function(?string $scheme,?string $host,?string $uri):void {
    http_response_code(500);

    if(!empty($scheme) && !empty($host) && !empty($uri))
    {
        $config = require dirname(__DIR__).'/env.php';
        $schemeHost = $scheme.'://'.$host;
        $envType = array_search($schemeHost,$config['schemeHost'],true);
    }

    if(!empty($envType))
    {
        $xEnvType = explode('/',$envType);
        if(count($xEnvType) === 2)[$env,$type] = $xEnvType;
    }

    if(!empty($env) && !empty($type) && !empty($config['schemeHost'][$envType]))
    {
        $vendor = $config['@'.$type]['path']['vendor'] ?? $config['@'.$env]['path']['vendor'] ?? $config['path']['vendor'] ?? null;
        $boot = $config['@'.$type]['path']['boot'] ?? $config['@'.$env]['path']['boot'] ?? $config['path']['boot'] ?? null;
    }

    if(!empty($vendor) && !empty($boot))
    {
        $boot = str_replace('[vendor]',$vendor,$boot);
        require_once $vendor.'/autoload.php';
        (require $boot)($config);
    }

    return;
})($_SERVER['REQUEST_SCHEME'],$_SERVER['SERVER_NAME'] ?: $_SERVER['HTTP_HOST'],$_SERVER['REQUEST_URI']);
?>
<?php
declare(strict_types=1);
// index file for booting the application and Cms via an HTTP request

(function() {
    http_response_code(500);
    $config = require dirname(__DIR__).'/env.php';
    $scheme = $_SERVER['REQUEST_SCHEME'] ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')? 'https':'http');
    $schemeHost = $scheme.'://'.($_SERVER['SERVER_NAME'] ?: $_SERVER['HTTP_HOST']);
    $envType = array_search($schemeHost,$config['schemeHost'],true);

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
})();
?>
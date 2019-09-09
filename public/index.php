<?php
declare(strict_types=1);

// index
// index file for booting the application
(function() {
    if(!empty($_SERVER['REQUEST_SCHEME']) && !empty($_SERVER['HTTP_HOST']) && !empty($_SERVER['REQUEST_URI']))
    {
        $config = require dirname(__DIR__).'/env.php';
        $config['path']['public'] = __DIR__;

        if(!empty($config['path']['vendor']))
        {
            require_once $config['path']['vendor'].'/autoload.php';

            require $config['path']['private'].'/php/Boot.php';
            Project\Boot::start($config);
        }
    }
})();
?>
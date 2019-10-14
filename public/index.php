<?php
declare(strict_types=1);

(function() {
    if(!empty($_SERVER['REQUEST_SCHEME']) && !empty($_SERVER['SERVER_NAME']) && !empty($_SERVER['REQUEST_URI']))
    {
        $config = require dirname(__DIR__).'/env.php';

        if(!empty($config['path']['vendor']))
        {
            require_once $config['path']['vendor'].'/autoload.php';
            $boot = require $config['path']['boot'];
            $boot($config);
        }
    }
})();
?>
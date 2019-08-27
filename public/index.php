<?php
declare(strict_types=1);

(function() {
	if(!empty($_SERVER['REQUEST_URI']) && !empty($_SERVER['HTTP_HOST']))
	{
		$config['host']['dev/app'] = 'project.dev';
		$config['host']['dev/cms'] = 'cms.project.dev';
		$config['scheme']['dev/app'] = false;
		$config['scheme']['dev/cms'] = false;

		$config['host']['prod/app'] = 'project.com';
		$config['host']['prod/cms'] = 'cms.project.com';
		$config['scheme']['prod/app'] = true;
		$config['scheme']['prod/cms'] = true;

		$config['path']['vendor'] = realpath('../vendor');
		$config['path']['storage'] = dirname(__DIR__).'/storage';
		$config['path']['private'] = realpath('../private');
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
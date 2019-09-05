<?php
declare(strict_types=1);

(function() {
	if(!empty($_SERVER['REQUEST_URI']) && !empty($_SERVER['HTTP_HOST']))
	{
		$config['host']['dev/assert'] = 'example.dev';
		$config['scheme']['dev/assert'] = false;

		$config['path']['storage'] = dirname(__DIR__).'/storage';
		$config['path']['testsuite'] = realpath('../testsuite');
		$config['path']['private'] = realpath('../private');
		$config['path']['vendor'] = realpath('../vendor');
		$config['path']['public'] = __DIR__;

		$config['assert']['target'] = true;
		$config['assert']['overview'] = true;

		if(!empty($config['path']['vendor']))
		{
			require_once $config['path']['vendor'].'/autoload.php';
			
			require $config['path']['testsuite']."/Boot.php";
			Quid\TestSuite\Boot::start($config);
		}
	}
})();
?>
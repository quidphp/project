<?php
declare(strict_types=1);

/*
 * This file is part of the QuidPHP package.
 * Website: https://quidphp.com
 * License: https://github.com/quidphp/test/blob/master/LICENSE
 */

(function() {
	if(!empty($_SERVER['REQUEST_URI']) && !empty($_SERVER['HTTP_HOST']))
	{
		$config['host']['dev/assert'] = 'assert5.ol';
		$config['scheme']['dev/assert'] = false;

		$config['path']['storage'] = dirname(__DIR__).'/storage';
		$config['path']['private'] = realpath('../private');
		$config['path']['vendor'] = realpath('../vendor');
		$config['path']['public'] = __DIR__;

		$config['assert']['target'] = true;
		$config['assert']['overview'] = true;


		if(!empty($config['path']['vendor']))
		{
			require_once $config['path']['vendor'].'/autoload.php';
			Quid\Test\Boot::start($config);
		}
	}
})();
?>
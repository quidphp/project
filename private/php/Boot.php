<?php
declare(strict_types=1);
namespace Project;
use Quid\Core;

// boot
class Boot extends Core\Boot
{
	// config
	public static $config = [
		'version'=>['app'=>'1.0'],
		'lang'=>['en'],
		'@dev'=>[
			'db'=>['mysql:host=localhost;dbname=project','','']],
		'@prod'=>[
			'db'=>['mysql:host=localhost;dbname=project','','']]
	];


	// onReady
	protected function onReady():Core\Boot
	{
		return $this;
	}
}
?>
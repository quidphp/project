<?php
declare(strict_types=1);
namespace Project;
use Quid\Core;

// boot
class Boot extends Core\Boot 
{
	// config
	public static $config = array(
		'version'=>array('app'=>'1.0'),
		'lang'=>array('en'),
		'@dev'=>array(
			'db'=>array('mysql:host=localhost;dbname=project','','')),
		'@prod'=>array(
			'db'=>array('mysql:host=localhost;dbname=project','',''))
	);
	
	
	// onReady
	protected function onReady():Core\Boot 
	{
		return $this;
	}
}
?>
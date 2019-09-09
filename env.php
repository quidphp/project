<?php
// declare environment data for the application
return array(
	'schemeHost'=>array(
		'dev/app'=>'http://project.dev',
		'prod/app'=>'https://project.com'
	),
	
	'path'=>array(
		'private'=>__DIR__."/private",
		'public'=>__DIR__."/public",
		'storage'=>__DIR__."/storage",
		'vendor'=>__DIR__."/vendor"
	),
	
	'@dev'=>[
		'db'=>['mysql:host=localhost;dbname=project','','']],
		
	'@prod'=>[
		'db'=>['mysql:host=localhost;dbname=project','','']]
);
?>
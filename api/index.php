<?php
	require_once "vendor/autoload.php";

	use \Slim\App;
	
	$autoload = array(
					'config/*.php',
					'module/helper/*.php',
					'module/core/*.php',
					'module/controller/*.php',
					'module/middleware/*.php',
					'route/*.php'
	);

	$config = [
		"templates.path" 	=> "views",
		"cookies.lifetime"	=> "5256000 minutes",
		"cookie.encrypt" 	=> true,
		'settings' => [
			'displayErrorDetails' => true,
			'determineRouteBeforeAppMiddleware' => true
		]
	];

	$c = new \Slim\Container($config);
	$app = new App( $c );
	foreach ($autoload as $link) {
		foreach (glob($link) as $autoloadFile) {
			require_once $autoloadFile;
		}
	}
	$app->run();
?>
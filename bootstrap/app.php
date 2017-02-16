<?php
require( __DIR__ . '/../vendor/autoload.php' );


session_start();

$settings = require( 'settings.php' );

$app = new Slim\App( $settings );

require( 'dependencies.php' );
require( 'routes.php' );

$app->run();
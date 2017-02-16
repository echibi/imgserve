<?php

return [
	'settings' => [
		'displayErrorDetails'    => true, // set to false in production
		'addContentLengthHeader' => false, // Allow the web server to send the content-length header

		// Database
		'db'                     => [
			'host'   => '127.0.0.1',
			'user'   => 'root',
			'pass'   => '',
			'dbname' => 'imgserve'
		],

		// Monolog settings
		'logger'                 => [
			'name'      => 'imgserve',
			'path'      => __DIR__ . '/../logs/imgserve.log',
			'level'     => \Monolog\Logger::DEBUG,
			'max_files' => 60
		],
		'images'                 => [
			'driver' => 'gd',
			'dir'    => __DIR__ . '/../public/img'
		],
		'cache'                  => [
			'type'    => 'files',
			'dir'     => __DIR__ . '/../cache',
			'expires' => 60 * 60 * 24
		]
	],
];


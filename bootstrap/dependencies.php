<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 14/02/17
 */
use Interop\Container\ContainerInterface;

$c = $app->getContainer();

/**
 * @param ContainerInterface $c
 *
 * @return bool|\Pixie\QueryBuilder\QueryBuilderHandler
 */
$c['db'] = function ( ContainerInterface $c ) {
	$db = $c['settings']['db'];
	$qb = false;

	try {
		$config = array(
			'driver'    => 'mysql', // Db driver
			'host'      => $db['host'],
			'database'  => $db['dbname'],
			'username'  => $db['user'],
			'password'  => $db['pass'],
			'charset'   => 'utf8mb4', // Optional
			'collation' => 'utf8_swedish_ci', // Optional
		);
		// QB is the new alias for accessing the DB
		$connection = new \Pixie\Connection( 'mysql', $config );
		$qb         = new \Pixie\QueryBuilder\QueryBuilderHandler( $connection );

	} catch ( PDOException $e ) {
		$c->get( 'logger' )->alert( 'Database connection failed: ' . $e->getMessage() );
	}

	return $qb;
};

/**
 * @param ContainerInterface $c
 *
 * @return \Monolog\Logger
 */
$c['logger'] = function ( ContainerInterface $c ) {
	$settings = $c->get( 'settings' )['logger'];
	$logger   = new Monolog\Logger( $settings['name'] );

	$logger->pushProcessor( new Monolog\Processor\UidProcessor() );
	$logger->pushHandler( new \Monolog\Handler\RotatingFileHandler( $settings['path'], $settings['max_files'], $settings['level'] ) );

	// $logger->pushHandler( new Monolog\Handler\StreamHandler( $settings['path'], $settings['level'] ) );

	return $logger;
};

/**
 * @param ContainerInterface $c
 *
 * @return \phpFastCache\Cache\ExtendedCacheItemPoolInterface
 * @throws \phpFastCache\Exceptions\phpFastCacheDriverCheckException
 */
$c['cache'] = function ( ContainerInterface $c ) {
	$settings = $c->get( 'settings' )['cache'];
	// Setup File Path on your config files
	\phpFastCache\CacheManager::setup( array(
		"path" => $settings['dir'],
	) );

	return \phpFastCache\CacheManager::getInstance( $settings['type'] );
};

/**
 * @param ContainerInterface $c
 *
 * @return \Intervention\Image\ImageManager
 */
$c['image'] = function ( ContainerInterface $c ) {
	$settings = $c->get( 'settings' )['images'];

	return new \Intervention\Image\ImageManager( array(
		'driver' => $settings['driver']
	) );
};

/**
 * @param ContainerInterface $c
 *
 * @return \App\Models\ImageModel
 */
$c['ImageModel'] = function ( ContainerInterface $c ) {
	return new \App\Models\ImageModel( $c );
};
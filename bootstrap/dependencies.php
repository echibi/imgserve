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
$container['db'] = function ( ContainerInterface $c ) {
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
<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 16/02/17
 */

namespace App\Controllers;


use Interop\Container\ContainerInterface;
use Monolog\Logger;

class Controller {
	/**
	 * @var ContainerInterface
	 */
	public $app;

	/**
	 * @var Logger
	 */
	public $logger;

	/**
	 * @param ContainerInterface $c
	 */
	public function __construct( ContainerInterface $c ) {
		$this->app    = $c;
		$this->logger = $c->get( 'logger' );
	}
}
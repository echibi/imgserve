<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 16/02/17
 */

namespace App\Controllers;


use Interop\Container\ContainerInterface;

class Controller {
	/**
	 * @var ContainerInterface
	 */
	public $app;

	/**
	 * @param ContainerInterface $c
	 */
	public function __construct( ContainerInterface $c ) {
		$this->app = $c;
	}
}
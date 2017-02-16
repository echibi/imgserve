<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 16/02/17
 */

namespace App\Models;


use Interop\Container\ContainerInterface;
use Pixie\QueryBuilder\QueryBuilderHandler;

class Model {
	/**
	 * @var ContainerInterface
	 */
	public $app;
	/**
	 * @var QueryBuilderHandler
	 */
	public $db;

	public function __construct( ContainerInterface $c ) {
		$this->app = $c;
		$this->db  = $c->get( 'db' );
	}
}